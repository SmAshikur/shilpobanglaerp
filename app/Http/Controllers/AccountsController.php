<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectExpense;
use App\Models\Asset;
use App\Models\Subscription;
use App\Models\OutsourcingPayment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    // Project Costing
    public function projects()
    {
        $projects = Project::withCount(['expenses as total_expenses' => function($query) {
            $query->select(DB::raw('sum(amount)'));
        }])->latest()->paginate(10);
        return view('dashboard.erp.accounts.projects', compact('projects'));
    }

    // Asset Tracking
    public function assets()
    {
        $assets = Asset::latest()->get();
        return view('dashboard.erp.accounts.assets', compact('assets'));
    }

    // Software Subscriptions
    public function subscriptions()
    {
        $subscriptions = Subscription::latest()->get();
        return view('dashboard.erp.accounts.subscriptions', compact('subscriptions'));
    }

    // Platform Income & Financial Reports
    public function reports()
    {
        $monthlyIncome = Invoice::where('status', 'paid')
                            ->select(DB::raw('SUM(total_amount) as total'), DB::raw("strftime('%m', invoice_date) as month"))
                            ->groupBy('month')
                            ->get();
        
        $totalAssetsValue = Asset::sum('purchase_price');
        $monthlySubCost = Subscription::where('status', 'active')->sum('monthly_cost');

        return view('dashboard.erp.accounts.reports', compact('monthlyIncome', 'totalAssetsValue', 'monthlySubCost'));
    }

    // Outsourcing Payments
    public function outsourcing()
    {
        $payments = OutsourcingPayment::with('project')->latest()->paginate(10);
        return view('dashboard.erp.accounts.outsourcing', compact('payments'));
    }

    // Store Project
    public function projectStore(Request $request)
    {
        Project::create($request->all());
        return back()->with('success', 'Project added!');
    }
}
