<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveType;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use App\Models\Client;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ERPController extends Controller
{
    // Organization
    public function companies()
    {
        $companies = Company::with('parent')->latest()->paginate(10);
        return view('dashboard.erp.companies.index', compact('companies'));
    }

    public function companyCreate()
    {
        $motherCompanies = Company::whereNull('parent_id')->get();
        return view('dashboard.erp.companies.create', compact('motherCompanies'));
    }

    public function companyStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'logo_file' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('logo_file');
        
        if ($request->filled('parent_id')) {
            $data['type'] = 'sister';
            $data['is_mother'] = false;
        } else {
            $data['type'] = 'mother';
            $data['is_mother'] = true;
        }
        
        if ($request->hasFile('logo_file')) {
            $data['logo'] = $request->file('logo_file')->store('companies', 'public');
        }

        Company::create($data);
        return redirect()->route('dashboard.erp.companies')->with('success', 'Company created successfully!');
    }

    public function companyEdit(Company $company)
    {
        $motherCompanies = Company::whereNull('parent_id')->where('id', '!=', $company->id)->get();
        return view('dashboard.erp.companies.edit', compact('company', 'motherCompanies'));
    }

    public function companyUpdate(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'logo_file' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['logo_file', '_token', '_method']);
        
        if ($company->is_mother) {
            $data['type'] = 'mother';
            $data['is_mother'] = true;
            $data['parent_id'] = null;
        } else {
            $data['type'] = $request->filled('parent_id') ? 'sister' : 'mother';
            $data['is_mother'] = !$request->filled('parent_id');
        }

        if ($request->hasFile('logo_file')) {
            // Delete old logo
            if ($company->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo_file')->store('companies', 'public');
        }

        $company->update($data);
        return redirect()->route('dashboard.erp.companies')->with('success', 'Company updated successfully!');
    }

    public function companyDestroy(Company $company)
    {
        if ($company->is_mother) {
            return back()->with('error', 'Mother company cannot be deleted!');
        }

        $company->delete();
        return redirect()->route('dashboard.erp.companies')->with('success', 'Company deleted successfully!');
    }

    public function companyToggleStatus(Company $company)
    {
        if ($company->is_mother) {
            return back()->with('error', 'Mother company must always be active!');
        }

        $company->update(['is_active' => !$company->is_active]);
        return back()->with('success', 'Company status updated!');
    }

    // HR Management - Employees
    public function employees()
    {
        $employees = Employee::with(['company', 'department', 'designation'])->latest()->paginate(10);
        return view('dashboard.erp.employees.index', compact('employees'));
    }

    public function employeeCreate()
    {
        $companies  = Company::all();
        $departments = Department::all();
        $designations = Designation::all();
        return view('dashboard.erp.employees.create', compact('companies', 'departments', 'designations'));
    }

    public function employeeStore(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email|unique:users,email',
        ]);

        $data = $request->except(['username', 'password']);

        // Auto-generate employee_id
        $lastEmp = Employee::withTrashed()->latest('id')->first();
        $nextNum = $lastEmp ? ($lastEmp->id + 1) : 1;
        $data['employee_id'] = 'EMP-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);

        // Create system user account
        if (!empty($request->email)) {
            $password = $request->password ?? Str::random(8);
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $password, // User model casts this via 'hashed'
                'role'     => 'employee',
            ]);
            $data['user_id'] = $user->id;
        }

        Employee::create($data);
        return redirect()->route('dashboard.erp.employees')->with('success', 'Employee created successfully!');
    }

    public function employeeEdit(Employee $employee)
    {
        $companies    = Company::all();
        $departments  = Department::where('company_id', $employee->company_id)->get();
        $designations = Designation::where('department_id', $employee->department_id)->get();
        return view('dashboard.erp.employees.edit', compact('employee', 'companies', 'departments', 'designations'));
    }

    public function employeeUpdate(Request $request, Employee $employee)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string|max:255',
        ]);

        $data = $request->except(['_token', '_method', 'email', 'password']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('employees', 'public');
        } else {
            unset($data['image']);
        }

        $employee->update($data);

        // Handle system user account update/creation
        if (!empty($request->email)) {
            if ($employee->user) {
                // Update existing account
                $userUpdate = ['name' => $request->name, 'email' => $request->email];
                if (!empty($request->password)) {
                    $userUpdate['password'] = $request->password; // User model casts via 'hashed'
                }
                $employee->user->update($userUpdate);
            } else {
                // Create new account
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => $request->password ?? Str::random(8),
                    'role'     => 'employee',
                ]);
                $employee->update(['user_id' => $user->id]);
            }
        }

        return redirect()->route('dashboard.erp.employees')->with('success', 'Employee updated!');
    }

    public function employeeDestroy(Employee $employee)
    {
        $employee->delete(); // soft delete
        return back()->with('success', 'Employee removed!');
    }

    public function employeeToggleStatus(Employee $employee)
    {
        $employee->update(['is_active' => !$employee->is_active]);
        return back()->with('success', 'Employee status updated!');
    }

    // HR - Dept & Desig
    public function departments()
    {
        $departments = Department::with('company')->latest()->get();
        $companies = Company::all();
        return view('dashboard.erp.hr.departments', compact('departments', 'companies'));
    }

    public function departmentStore(Request $request)
    {
        Department::create($request->all());
        return back()->with('success', 'Department added!');
    }

    public function departmentUpdate(Request $request, Department $department)
    {
        $department->update($request->all());
        return back()->with('success', 'Department updated!');
    }

    public function departmentDestroy(Department $department)
    {
        $department->delete();
        return back()->with('success', 'Department deleted!');
    }

    public function departmentToggleStatus(Department $department)
    {
        $department->update(['is_active' => !$department->is_active]);
        return back()->with('success', 'Department status updated!');
    }

    public function designations()
    {
        $designations = Designation::with(['company', 'department'])->latest()->get();
        $companies = Company::all();
        $departments = Department::all();
        return view('dashboard.erp.hr.designations', compact('designations', 'companies', 'departments'));
    }

    public function designationStore(Request $request)
    {
        Designation::create($request->all());
        return back()->with('success', 'Designation added!');
    }

    public function designationUpdate(Request $request, Designation $designation)
    {
        $designation->update($request->all());
        return back()->with('success', 'Designation updated!');
    }

    public function designationDestroy(Designation $designation)
    {
        $designation->delete();
        return back()->with('success', 'Designation deleted!');
    }

    public function designationToggleStatus(Designation $designation)
    {
        $designation->update(['is_active' => !$designation->is_active]);
        return back()->with('success', 'Designation status updated!');
    }

    // Attendance
    public function attendance(Request $request)
    {
        $employees = Employee::where('is_active', true)->orderBy('name')->get();

        $query = Attendance::with('employee');

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->latest('date')->paginate(25)->withQueryString();

        return view('dashboard.erp.attendance.index', compact('attendances', 'employees'));
    }

    public function attendanceStore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date'        => 'required|date',
            'check_in'    => 'nullable|date_format:H:i',
            'check_out'   => 'nullable|date_format:H:i',
            'status'      => 'required|in:present,absent,late,leave,half_day',
            'note'        => 'nullable|string|max:500',
        ]);

        // Prevent duplicate
        $exists = Attendance::where('employee_id', $request->employee_id)
                    ->whereDate('date', $request->date)->exists();
        if ($exists) {
            return back()->with('error', 'Attendance already exists for this employee on this date.');
        }

        $breakMins = 0;
        if ($request->check_in && $request->check_out) {
            // No manual break entry for now
        }

        Attendance::create([
            'employee_id'   => $request->employee_id,
            'date'          => $request->date,
            'check_in'      => $request->check_in ?: null,
            'check_out'     => $request->check_out ?: null,
            'status'        => $request->status,
            'note'          => $request->note,
            'break_minutes' => 0,
        ]);

        return back()->with('success', 'Attendance recorded successfully!');
    }

    public function attendanceUpdate(Request $request, Attendance $attendance)
    {
        $request->validate([
            'check_in'  => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status'    => 'required|in:present,absent,late,leave,half_day',
            'note'      => 'nullable|string|max:500',
        ]);

        $attendance->update([
            'check_in'  => $request->check_in ?: null,
            'check_out' => $request->check_out ?: null,
            'status'    => $request->status,
            'note'      => $request->note,
        ]);

        return back()->with('success', 'Attendance updated!');
    }

    public function attendanceDestroy(Attendance $attendance)
    {
        $attendance->delete();
        return back()->with('success', 'Record deleted!');
    }

    public function attendanceExportPdf(Request $request)
    {
        $query = Attendance::with('employee');
        if ($request->filled('employee_id')) $query->where('employee_id', $request->employee_id);
        if ($request->filled('date_from'))   $query->whereDate('date', '>=', $request->date_from);
        if ($request->filled('date_to'))     $query->whereDate('date', '<=', $request->date_to);
        if ($request->filled('status'))      $query->where('status', $request->status);

        $attendances = $query->latest('date')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.erp.attendance.pdf', compact('attendances'))
               ->setPaper('a4', 'landscape');

        return $pdf->download('attendance_' . now()->format('Y-m-d') . '.pdf');
    }

    public function attendanceExportExcel(Request $request)
    {
        $query = Attendance::with('employee');
        if ($request->filled('employee_id')) $query->where('employee_id', $request->employee_id);
        if ($request->filled('date_from'))   $query->whereDate('date', '>=', $request->date_from);
        if ($request->filled('date_to'))     $query->whereDate('date', '<=', $request->date_to);
        if ($request->filled('status'))      $query->where('status', $request->status);

        $attendances = $query->latest('date')->get();

        $filename = 'attendance_' . now()->format('Y-m-d') . '.csv';
        $headers  = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"$filename\""];

        $callback = function () use ($attendances) {
            $f = fopen('php://output', 'w');
            fputcsv($f, ['Employee', 'Date', 'Check In', 'Check Out', 'Break (min)', 'Net Hours', 'Status', 'Note']);
            foreach ($attendances as $a) {
                $net = '—';
                if ($a->check_in && $a->check_out) {
                    $mins = \Carbon\Carbon::parse($a->check_in)->diffInMinutes(\Carbon\Carbon::parse($a->check_out));
                    $netM = max(0, $mins - ($a->break_minutes ?? 0));
                    $net  = intdiv($netM, 60) . 'h ' . ($netM % 60) . 'm';
                }
                fputcsv($f, [
                    $a->employee->name ?? '—',
                    $a->date,
                    $a->check_in  ? \Carbon\Carbon::parse($a->check_in)->format('h:i A')  : '—',
                    $a->check_out ? \Carbon\Carbon::parse($a->check_out)->format('h:i A') : '—',
                    $a->break_minutes ?? 0,
                    $net,
                    ucfirst($a->status),
                    $a->note ?? '',
                ]);
            }
            fclose($f);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Leave
    public function leave()
    {
        $leaveRequests = LeaveRequest::with(['employee', 'leaveType'])->latest()->paginate(10);
        return view('dashboard.erp.leave.index', compact('leaveRequests'));
    }

    // Payroll
    public function payroll()
    {
        $payrolls = Payroll::with('employee')->latest()->paginate(10);
        return view('dashboard.erp.payroll.index', compact('payrolls'));
    }

    // CRM & Clients
    public function clients()
    {
        $clients = Client::with('company')->latest()->paginate(10);
        return view('dashboard.erp.crm.index', compact('clients'));
    }

    // Accounts
    public function accounts()
    {
        $accounts = Account::with('company')->latest()->get();
        return view('dashboard.erp.accounts.index', compact('accounts'));
    }
}
