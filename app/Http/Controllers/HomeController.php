<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Review;
use App\Models\ProfileInfo;
use App\Models\Portfolio;
use App\Models\Event;
use App\Models\SectionSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = ProfileInfo::first();
        $sectionSettings = SectionSetting::all()->keyBy('key');
        
        $services = ($sectionSettings->get('services')?->is_visible ?? true) ? Service::where('is_active', true)->where('is_featured', true)->get() : collect();
        $team = ($sectionSettings->get('team')?->is_visible ?? true) ? TeamMember::where('is_active', true)->where('is_featured', true)->get() : collect();
        $reviews = ($sectionSettings->get('reviews')?->is_visible ?? true) ? Review::where('is_active', true)->where('is_featured', true)->get() : collect();
        $portfolios = ($sectionSettings->get('portfolio')?->is_visible ?? true) ? Portfolio::where('is_active', true)->where('is_featured', true)->with('service')->get() : collect();
        $events = ($sectionSettings->get('events')?->is_visible ?? true) ? Event::where('is_active', true)->where('is_featured', true)->with('media')->latest()->get() : collect();
        
        return view('welcome', compact('profile', 'services', 'team', 'reviews', 'portfolios', 'events', 'sectionSettings'));
    }

    public function about()
    {
        $profile = ProfileInfo::first();
        $services = Service::where('is_active', true)->get();
        $team = TeamMember::where('is_active', true)->get();
        return view('about', compact('profile', 'services', 'team'));
    }

    public function serviceDetails($id)
    {
        $profile = ProfileInfo::first();
        $service = Service::where('is_active', true)->findOrFail($id);
        $services = Service::where('is_active', true)->get(); // For footer links
        $otherServices = Service::where('is_active', true)->where('id', '!=', $id)->take(3)->get(); // For bottom cards
        return view('service-details', compact('profile', 'service', 'services', 'otherServices'));
    }

    public function teamDetails($id)
    {
        $profile = ProfileInfo::first();
        $member = TeamMember::where('is_active', true)->findOrFail($id);
        $services = Service::where('is_active', true)->get();
        $otherMembers = TeamMember::where('is_active', true)->where('id', '!=', $id)->take(4)->get();
        return view('team-details', compact('profile', 'member', 'services', 'otherMembers'));
    }

    public function portfolioDetails($id)
    {
        $profile = ProfileInfo::first();
        $project = Portfolio::where('is_active', true)->with('service')->findOrFail($id);
        $services = Service::where('is_active', true)->get();
        $relatedProjects = Portfolio::where('is_active', true)->where('service_id', $project->service_id)->where('id', '!=', $id)->take(3)->get();
        return view('portfolio-details', compact('profile', 'project', 'services', 'relatedProjects'));
    }

    public function eventDetails($id)
    {
        $profile = ProfileInfo::first();
        $event = Event::where('is_active', true)->with('media')->findOrFail($id);
        $services = Service::where('is_active', true)->get();
        $otherEvents = Event::where('is_active', true)->where('id', '!=', $id)->latest()->take(3)->get();
        return view('event-details', compact('profile', 'event', 'services', 'otherEvents'));
    }

    public function contact(Request $request)
    {
        $profile = ProfileInfo::first();
        $services = Service::where('is_active', true)->get();
        $portfolioId = $request->query('portfolio_id');
        $referenceProject = null;
        if ($portfolioId) {
            $referenceProject = Portfolio::find($portfolioId);
        }
        return view('contact', compact('profile', 'services', 'referenceProject'));
    }
}
