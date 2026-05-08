<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProductionTask;
use App\Models\Asset;
use App\Models\EquipmentLoan;
use App\Models\SocialPost;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgencyController extends Controller
{
    // Project & Production Tasks
    public function production()
    {
        $tasks = ProductionTask::with(['project', 'assignedTo'])->latest()->paginate(15);
        $projects = Project::all();
        $employees = Employee::all();
        return view('dashboard.erp.agency.production', compact('tasks', 'projects', 'employees'));
    }

    // Equipment & Inventory Tracking
    public function equipment()
    {
        $assets = Asset::all();
        $loans = EquipmentLoan::with(['asset', 'employee'])->latest()->get();
        $employees = Employee::all();
        return view('dashboard.erp.agency.equipment', compact('assets', 'loans', 'employees'));
    }

    // Social Media Scheduler
    public function scheduler()
    {
        $posts = SocialPost::with('project')->latest()->get();
        $projects = Project::all();
        return view('dashboard.erp.agency.scheduler', compact('posts', 'projects'));
    }

    // Store Production Task
    public function taskStore(Request $request)
    {
        ProductionTask::create($request->all());
        return back()->with('success', 'Production task assigned!');
    }

    // Store Equipment Loan
    public function loanStore(Request $request)
    {
        EquipmentLoan::create($request->all());
        return back()->with('success', 'Equipment loan recorded!');
    }

    // Store Social Post
    public function postStore(Request $request)
    {
        SocialPost::create($request->all());
        return back()->with('success', 'Post scheduled!');
    }
}
