<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Activity;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Company;
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
        ]);

        Lead::create($request->all());
        return back()->with('success', 'Lead added successfully!');
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
