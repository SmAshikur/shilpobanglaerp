<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Review;
use App\Models\Portfolio;
use App\Models\Event;
use App\Models\EventMedia;
use App\Models\ContactSubmission;
use App\Models\ProfileInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $contactCount = ContactSubmission::count();
        $serviceCount = Service::count();
        $teamCount = TeamMember::count();
        $reviewCount = Review::count();
        $portfolioCount = Portfolio::count();
        $eventCount = Event::count();
        $recentContacts = ContactSubmission::latest()->take(5)->get();
        
        return view('dashboard.index', compact('contactCount', 'serviceCount', 'teamCount', 'reviewCount', 'portfolioCount', 'eventCount', 'recentContacts'));
    }

    public function services()
    {
        $services = Service::latest()->get();
        return view('dashboard.services', compact('services'));
    }

    public function serviceStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('services', 'public');
        }

        Service::create($validated);

        return back()->with('success', 'Service added successfully!');
    }

    public function serviceDestroy(Service $service)
    {
        if ($service->image) Storage::disk('public')->delete($service->image);
        $service->delete();
        return back()->with('success', 'Service deleted successfully!');
    }
    
    public function team()
    {
        $team = TeamMember::latest()->get();
        return view('dashboard.team', compact('team'));
    }

    public function teamStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'image_file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('team', 'public');
        }

        TeamMember::create($validated);

        return back()->with('success', 'Team member added successfully!');
    }

    public function teamDestroy(TeamMember $member)
    {
        if ($member->image) Storage::disk('public')->delete($member->image);
        $member->delete();
        return back()->with('success', 'Team member removed successfully!');
    }

    public function profile()
    {
        $profile = ProfileInfo::first();
        return view('dashboard.profile', compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $profile = ProfileInfo::first();
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'about_text' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'logo_file' => 'nullable|image|max:2048',
            'about_image_file' => 'nullable|image|max:2048',
            'hero_bg_file' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('logo_file')) {
            if ($profile->logo) Storage::disk('public')->delete($profile->logo);
            $validated['logo'] = $request->file('logo_file')->store('brand', 'public');
        }

        if ($request->hasFile('about_image_file')) {
            if ($profile->about_image) Storage::disk('public')->delete($profile->about_image);
            $validated['about_image'] = $request->file('about_image_file')->store('brand', 'public');
        }

        if ($request->hasFile('hero_bg_file')) {
            if ($profile->hero_bg) Storage::disk('public')->delete($profile->hero_bg);
            $validated['hero_bg'] = $request->file('hero_bg_file')->store('brand', 'public');
        }

        $profile->update($validated);

        return back()->with('success', 'Profile and SEO settings updated!');
    }

    public function reviews()
    {
        $reviews = Review::latest()->get();
        return view('dashboard.reviews', compact('reviews'));
    }

    public function reviewStore(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image_file' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['client_image'] = $request->file('image_file')->store('reviews', 'public');
        }

        Review::create($validated);

        return back()->with('success', 'Review added successfully!');
    }

    public function reviewDestroy(Review $review)
    {
        if ($review->client_image) Storage::disk('public')->delete($review->client_image);
        $review->delete();
        return back()->with('success', 'Review removed successfully!');
    }

    public function portfolio()
    {
        $portfolios = Portfolio::latest()->with('service')->get();
        $services = Service::all();
        return view('dashboard.portfolio', compact('portfolios', 'services'));
    }

    public function portfolioStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'project_url' => 'nullable|url',
            'image_file' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('portfolio', 'public');
        }

        Portfolio::create($validated);

        return back()->with('success', 'Project added to portfolio!');
    }

    public function portfolioDestroy(Portfolio $project)
    {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return back()->with('success', 'Project removed from portfolio!');
    }

    public function events()
    {
        $events = Event::latest()->with('media')->get();
        return view('dashboard.events', compact('events'));
    }

    public function eventStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'thumbnail_file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail'] = $request->file('thumbnail_file')->store('events', 'public');
        }

        Event::create($validated);

        return back()->with('success', 'Event created! You can now add media into it.');
    }

    public function eventDestroy(Event $event)
    {
        if ($event->thumbnail) Storage::disk('public')->delete($event->thumbnail);
        $event->delete();
        return back()->with('success', 'Event and its media deleted!');
    }

    public function mediaStore(Request $request, Event $event)
    {
        $validated = $request->validate([
            'type' => 'required|in:image,youtube,video',
            'title' => 'nullable|string|max:255',
            'image_file' => 'required_if:type,image|image|max:4096',
            'video_file' => 'required_if:type,video|file|mimes:mp4,mov,avi|max:20000',
            'youtube_url' => 'required_if:type,youtube|url',
        ]);

        if ($request->type == 'image') {
            $validated['path'] = $request->file('image_file')->store('events/media', 'public');
        } elseif ($request->type == 'video') {
            $validated['path'] = $request->file('video_file')->store('events/media', 'public');
        } else {
            $validated['path'] = $request->youtube_url;
        }

        $event->media()->create([
            'type' => $request->type,
            'path' => $validated['path'],
            'title' => $request->title,
        ]);

        return back()->with('success', 'Media added to event!');
    }

    public function mediaDestroy(EventMedia $media)
    {
        if ($media->type != 'youtube') Storage::disk('public')->delete($media->path);
        $media->delete();
        return back()->with('success', 'Media removed!');
    }

    public function messages()
    {
        $messages = ContactSubmission::latest()->paginate(10);
        ContactSubmission::where('is_read', false)->update(['is_read' => true]);
        return view('dashboard.messages', compact('messages'));
    }

    public function settings()
    {
        $user = auth()->user();
        return view('dashboard.settings', compact('user'));
    }

    public function settingsUpdate(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Security settings updated!');
    }
}
