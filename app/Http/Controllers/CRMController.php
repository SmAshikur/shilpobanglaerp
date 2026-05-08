<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Activity;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CRMController extends Controller
{
    // Leads & Contacts
    public function leads()
    {
        $leads = Lead::with(['company', 'assignedTo'])->latest()->paginate(10);
        return view('dashboard.erp.crm.leads', compact('leads'));
    }

    // Sales Pipeline (Kanban View Logic)
    public function pipeline()
    {
        $stages = ['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'];
        $leads = Lead::all()->groupBy('stage');
        return view('dashboard.erp.crm.pipeline', compact('stages', 'leads'));
    }

    // Activity Log
    public function activities()
    {
        $activities = Activity::with(['lead', 'performedBy'])->latest()->paginate(20);
        return view('dashboard.erp.crm.activities', compact('activities'));
    }

    // Invoices & Payments
    public function invoices()
    {
        $invoices = Invoice::with('client')->latest()->paginate(10);
        return view('dashboard.erp.crm.invoices', compact('invoices'));
    }

    public function invoiceCreate()
    {
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        $nextInvoiceNumber = 'INV-' . strtoupper(str_random(6)); // Basic random ID
        return view('dashboard.erp.crm.invoice-create', compact('clients', 'nextInvoiceNumber'));
    }

    public function invoiceStore(Request $request)
    {
        $request->validate([
            'client_id'      => 'required|exists:clients,id',
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'invoice_date'   => 'required|date',
            'due_date'       => 'nullable|date',
            'items'          => 'required|array|min:1',
            'items.*.desc'   => 'required|string',
            'items.*.qty'    => 'required|integer|min:1',
            'items.*.price'  => 'required|numeric|min:0',
            'status'         => 'required|in:draft,unpaid,paid,overdue',
        ]);

        DB::transaction(function () use ($request) {
            $subTotal = 0;
            foreach ($request->items as $item) {
                $subTotal += $item['qty'] * $item['price'];
            }

            $tax = $subTotal * 0.10; // 10% tax for example
            $total = $subTotal + $tax;

            $invoice = Invoice::create([
                'client_id'      => $request->client_id,
                'invoice_number' => $request->invoice_number,
                'invoice_date'   => $request->invoice_date,
                'due_date'       => $request->due_date,
                'sub_total'      => $subTotal,
                'tax'            => $tax,
                'total_amount'   => $total,
                'status'         => $request->status ?? 'draft', // 'draft' or 'unpaid'
            ]);

            foreach ($request->items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'description'=> $item['desc'],
                    'quantity'   => $item['qty'],
                    'unit_price' => $item['price'],
                    'total'      => $item['qty'] * $item['price'],
                ]);
            }
        });

        return redirect()->route('dashboard.erp.invoices')->with('success', 'Invoice created successfully!');
    }

    public function invoiceEdit(Invoice $invoice)
    {
        $invoice->load('items');
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        return view('dashboard.erp.crm.invoice-edit', compact('invoice', 'clients'));
    }

    public function invoiceUpdate(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client_id'      => 'required|exists:clients,id',
            'invoice_date'   => 'required|date',
            'due_date'       => 'nullable|date',
            'items'          => 'required|array|min:1',
            'items.*.desc'   => 'required|string',
            'items.*.qty'    => 'required|integer|min:1',
            'items.*.price'  => 'required|numeric|min:0',
            'status'         => 'required|in:draft,unpaid,paid,overdue',
        ]);

        DB::transaction(function () use ($request, $invoice) {
            $subTotal = 0;
            foreach ($request->items as $item) {
                $subTotal += $item['qty'] * $item['price'];
            }

            $tax = $subTotal * 0.10;
            $total = $subTotal + $tax;

            $invoice->update([
                'client_id'      => $request->client_id,
                'invoice_date'   => $request->invoice_date,
                'due_date'       => $request->due_date,
                'sub_total'      => $subTotal,
                'tax'            => $tax,
                'total_amount'   => $total,
                'status'         => $request->status,
            ]);

            // Simple approach: delete items and recreate
            $invoice->items()->delete();
            foreach ($request->items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'description'=> $item['desc'],
                    'quantity'   => $item['qty'],
                    'unit_price' => $item['price'],
                    'total'      => $item['qty'] * $item['price'],
                ]);
            }
        });

        return redirect()->route('dashboard.erp.invoices')->with('success', 'Invoice updated successfully!');
    }

    public function invoiceDestroy(Invoice $invoice)
    {
        $invoice->delete();
        return back()->with('success', 'Invoice deleted!');
    }

    // Reports & Analytics
    public function reports()
    {
        $leadsByStage = Lead::select('stage', DB::raw('count(*) as total'))
                            ->groupBy('stage')
                            ->get();
        
        $revenue = Invoice::where('status', 'paid')->sum('total_amount');
        $pending = Invoice::where('status', '!=', 'paid')->sum('total_amount');

        return view('dashboard.erp.crm.reports', compact('leadsByStage', 'revenue', 'pending'));
    }

    // Store Lead
    public function leadStore(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:30',
            'source'     => 'nullable|string|max:255',
            'assigned_to'=> 'nullable|exists:employees,id',
            'stage'      => 'nullable|string|max:50',
        ]);

        Lead::create($request->all());
        return back()->with('success', 'Lead added successfully!');
    }

    public function leadEdit(Lead $lead)
    {
        $companies = Company::where('is_active', true)->orderBy('name')->get();
        $employees = Employee::where('is_active', true)->orderBy('name')->get();
        return view('dashboard.erp.crm.lead-edit', compact('lead', 'companies', 'employees'));
    }

    public function leadUpdate(Request $request, Lead $lead)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:30',
            'source'     => 'nullable|string|max:255',
            'assigned_to'=> 'nullable|exists:employees,id',
            'stage'      => 'required|string|max:50',
        ]);

        $lead->update($request->all());
        return redirect()->route('dashboard.erp.leads')->with('success', 'Lead updated successfully!');
    }

    public function leadDestroy(Lead $lead)
    {
        $lead->delete();
        return back()->with('success', 'Lead deleted successfully!');
    }

    public function leadUpdateStage(Request $request, Lead $lead)
    {
        $request->validate([
            'stage' => 'required|string|max:50',
        ]);

        $lead->update(['stage' => $request->stage]);
        return response()->json(['success' => true, 'message' => 'Stage updated!']);
    }

    public function leadConvertToClient(Lead $lead)
    {
        // Check if lead already converted (optional)
        
        // Create Client from Lead data
        Client::create([
            'name'       => $lead->name,
            'company_id' => $lead->company_id,
            'email'      => $lead->email,
            'phone'      => $lead->phone,
            'status'     => 'active', // Default status for converted leads
            'note'       => "Converted from Lead. Original Source: {$lead->source}",
        ]);

        // Update Lead stage to 'won'
        $lead->update(['stage' => 'won']);

        return redirect()->route('dashboard.erp.clients')->with('success', 'Lead successfully converted to Client!');
    }

    // ─── CLIENT CRUD ───────────────────────────────────────────
    public function clients(Request $request)
    {
        $query = Client::with('company');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%$q%")
                  ->orWhere('email', 'like', "%$q%")
                  ->orWhere('company_name', 'like', "%$q%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $clients   = $query->latest()->paginate(20)->withQueryString();
        $companies = Company::where('is_active', true)->orderBy('name')->get();

        return view('dashboard.erp.crm.clients', compact('clients', 'companies'));
    }

    public function clientCreate()
    {
        $companies = Company::where('is_active', true)->orderBy('name')->get();
        return view('dashboard.erp.crm.client-create', compact('companies'));
    }

    public function clientStore(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'company_id'   => 'required|exists:companies,id',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:30',
            'company_name' => 'nullable|string|max:255',
            'address'      => 'nullable|string',
            'industry'     => 'nullable|string|max:255',
            'website'      => 'nullable|url|max:255',
            'status'       => 'required|in:active,inactive,prospect',
            'note'         => 'nullable|string',
        ]);

        Client::create($request->all());
        return redirect()->route('dashboard.erp.clients')->with('success', 'Client added successfully!');
    }

    public function clientEdit(Client $client)
    {
        $companies = Company::where('is_active', true)->orderBy('name')->get();
        return view('dashboard.erp.crm.client-edit', compact('client', 'companies'));
    }

    public function clientUpdate(Request $request, Client $client)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'company_id'   => 'required|exists:companies,id',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:30',
            'company_name' => 'nullable|string|max:255',
            'address'      => 'nullable|string',
            'industry'     => 'nullable|string|max:255',
            'website'      => 'nullable|url|max:255',
            'status'       => 'required|in:active,inactive,prospect',
            'note'         => 'nullable|string',
        ]);

        $client->update($request->all());
        return redirect()->route('dashboard.erp.clients')->with('success', 'Client updated successfully!');
    }

    public function clientDestroy(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Client deleted!');
    }
}
