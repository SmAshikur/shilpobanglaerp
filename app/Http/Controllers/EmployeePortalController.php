<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeePortalController extends Controller
{
    public function index()
    {
        $employee = Employee::where('user_id', auth()->id())->with(['company', 'department', 'designation'])->first();
        if (!$employee) {
            return redirect()->route('home')->with('error', 'You are not registered as an employee.');
        }

        $tasks = Task::where('employee_id', $employee->id)->latest()->get();
        $todayAttendance = Attendance::where('employee_id', $employee->id)
                            ->whereDate('date', Carbon::today())
                            ->first();

        return view('employee.dashboard', compact('employee', 'tasks', 'todayAttendance'));
    }

    public function attendance()
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        $attendances = Attendance::where('employee_id', $employee->id)->latest()->paginate(20);
        $todayAttendance = Attendance::where('employee_id', $employee->id)
                            ->whereDate('date', Carbon::today())
                            ->first();

        return view('employee.attendance', compact('employee', 'attendances', 'todayAttendance'));
    }

    public function profile()
    {
        $employee = Employee::where('user_id', auth()->id())->with(['company', 'department', 'designation'])->first();
        return view('employee.profile', compact('employee'));
    }

    public function checkIn()
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        
        Attendance::create([
            'employee_id' => $employee->id,
            'date' => Carbon::today(),
            'check_in' => Carbon::now()->toTimeString(),
            'status' => 'present'
        ]);

        return back()->with('success', 'Checked in successfully!');
    }

    public function checkOut()
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        $attendance = Attendance::where('employee_id', $employee->id)
                        ->whereDate('date', Carbon::today())
                        ->first();

        if ($attendance) {
            $attendance->update([
                'check_out' => Carbon::now()->toTimeString()
            ]);
        }

        return back()->with('success', 'Checked out successfully!');
    }

    public function breakStart()
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        $attendance = Attendance::where('employee_id', $employee->id)
                        ->whereDate('date', Carbon::today())
                        ->first();

        if ($attendance && !$attendance->break_start) {
            $attendance->update(['break_start' => Carbon::now()->toTimeString()]);
        }

        return back()->with('success', 'Break started!');
    }

    public function breakEnd()
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        $attendance = Attendance::where('employee_id', $employee->id)
                        ->whereDate('date', Carbon::today())
                        ->first();

        if ($attendance && $attendance->break_start && !$attendance->break_end) {
            $breakEnd = Carbon::now();
            $breakStart = Carbon::parse($attendance->break_start);
            $minutes = (int) $breakStart->diffInMinutes($breakEnd);

            $attendance->update([
                'break_end'     => $breakEnd->toTimeString(),
                'break_minutes' => $minutes,
            ]);
        }

        return back()->with('success', 'Break ended!');
    }

    public function updateTask(Request $request, Task $task)
    {
        $task->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Task status updated!');
    }

    public function profileUpdate(Request $request)
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        
        $request->validate([
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $employee->update($request->only(['phone', 'address']));

        if ($request->filled('password')) {
            $user = auth()->user();
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $user->save();
        }
        
        return back()->with('success', 'Profile updated!');
    }
}
