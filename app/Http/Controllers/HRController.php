<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Performance;
use App\Models\Job; // Wait, I need to use JobOpening model if I renamed it
use App\Models\Candidate;
use App\Models\Notice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HRController extends Controller
{
    // Employee Performance
    public function performance()
    {
        $performances = Performance::with('employee')->latest()->paginate(10);
        $employees = Employee::all();
        return view('dashboard.erp.hr.performance', compact('performances', 'employees'));
    }

    // Hiring / Recruitment
    public function recruitment()
    {
        // Assuming I renamed the model to JobOpening or just use DB
        $jobs = \DB::table('job_openings')->get();
        $candidates = Candidate::with('jobOpening')->latest()->get();
        return view('dashboard.erp.hr.recruitment', compact('jobs', 'candidates'));
    }

    // Notice Board
    public function notices()
    {
        $notices = Notice::latest()->paginate(10);
        return view('dashboard.erp.hr.notices', compact('notices'));
    }

    // Store Performance
    public function performanceStore(Request $request)
    {
        Performance::create($request->all());
        return back()->with('success', 'Performance record added!');
    }

    // Store Notice
    public function noticeStore(Request $request)
    {
        Notice::create($request->all());
        return back()->with('success', 'Notice published!');
    }
}
