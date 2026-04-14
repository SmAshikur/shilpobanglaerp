<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Review;
use App\Models\ProfileInfo;
use App\Models\Portfolio;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = ProfileInfo::first();
        $services = Service::where('is_active', true)->get();
        $team = TeamMember::where('is_active', true)->get();
        $reviews = Review::where('is_active', true)->get();
        $portfolios = Portfolio::where('is_active', true)->with('service')->get();
        $events = Event::where('is_active', true)->with('media')->latest()->get();
        
        return view('welcome', compact('profile', 'services', 'team', 'reviews', 'portfolios', 'events'));
    }
}
