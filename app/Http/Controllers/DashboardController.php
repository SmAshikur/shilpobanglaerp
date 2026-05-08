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
use App\Models\SectionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }
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
        $services = Service::latest()->paginate(10);
        return view('dashboard.services.index', compact('services'));
    }

    public function servicesCreate()
    {
        return view('dashboard.services.create');
    }

    public function serviceStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'image_file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        Service::create($validated);

        return back()->with('success', 'Service added successfully!');
    }

    public function serviceShow(Service $service)
    {
        $service->load('extraDetails');
        return view('dashboard.services.show', compact('service'));
    }

    public function serviceDestroy(Service $service)
    {
        if ($service->image) Storage::disk('public')->delete($service->image);
        $service->delete();
        return back()->with('success', 'Service deleted successfully!');
    }

    public function serviceEdit(Service $service)
    {
        return view('dashboard.services.edit', compact('service'));
    }

    public function serviceUpdate(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'image_file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            if ($service->image) Storage::disk('public')->delete($service->image);
            $validated['image'] = $request->file('image_file')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $service->update($validated);

        return redirect()->route('dashboard.services')->with('success', 'Service updated successfully!');
    }
    
    public function team()
    {
        $team = TeamMember::latest()->paginate(10);
        return view('dashboard.team.index', compact('team'));
    }

    public function teamCreate()
    {
        return view('dashboard.team.create');
    }

    public function teamStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('team', 'public');
        }

        TeamMember::create([
            'name' => $request->name,
            'position' => $request->position,
            'bio' => $request->bio,
            'image' => $imagePath,
            'facebook_url' => $request->facebook_url,
            'linkedin_url' => $request->linkedin_url,
            'twitter_url' => $request->twitter_url,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Team member added successfully.');
    }

    public function teamShow(TeamMember $member)
    {
        $member->load('extraDetails');
        return view('dashboard.team.show', compact('member'));
    }

    public function teamDestroy(TeamMember $member)
    {
        if ($member->image) Storage::disk('public')->delete($member->image);
        $member->delete();
        return back()->with('success', 'Team member removed successfully!');
    }

    public function teamEdit(TeamMember $member)
    {
        return view('dashboard.team.edit', compact('member'));
    }

    public function teamUpdate(Request $request, TeamMember $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ]);

        $data = $request->except(['_token', '_method', 'image_file']);

        if ($request->hasFile('image_file')) {
            if ($member->image) Storage::disk('public')->delete($member->image);
            $data['image'] = $request->file('image_file')->store('team', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        $member->update($data);

        return redirect()->route('dashboard.team')->with('success', 'Team member updated successfully.');
    }

    public function profile()
    {
        if (auth()->user()->role === 'employee') {
            return redirect()->route('employee.profile');
        }
        $profile = ProfileInfo::first();
        return view('dashboard.profile', compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        if (auth()->user()->role === 'employee') {
            return redirect()->route('employee.profile');
        }
        $profile = ProfileInfo::first();
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'footer_description' => 'nullable|string',
            'logo_file' => 'nullable|image|max:2048',
            
            // User Security
            'name' => 'nullable|string|max:255',
            'user_email' => 'nullable|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8',

            // SMTP
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_from_address' => 'nullable|email',
        ]);

        if ($request->hasFile('logo_file')) {
            if ($profile->logo) Storage::disk('public')->delete($profile->logo);
            $validated['logo'] = $request->file('logo_file')->store('brand', 'public');
        }

        $profile->update($validated);

        // Update User Security & Profile Image
        $user = auth()->user();
        if ($request->filled('name')) $user->name = $request->name;
        if ($request->filled('user_email')) $user->email = $request->user_email;
        if ($request->filled('password')) $user->password = Hash::make($request->password);
        
        if ($request->hasFile('profile_image_file')) {
            if ($user->profile_image) Storage::disk('public')->delete($user->profile_image);
            $user->profile_image = $request->file('profile_image_file')->store('profiles', 'public');
        }

        $user->save();

        // Update SMTP (.env)
        if ($request->filled('mail_host')) {
            $this->updateDotEnv('MAIL_HOST', $request->mail_host);
            $this->updateDotEnv('MAIL_PORT', $request->mail_port);
            $this->updateDotEnv('MAIL_ENCRYPTION', $request->mail_encryption);
            $this->updateDotEnv('MAIL_USERNAME', $request->mail_username);
            $this->updateDotEnv('MAIL_PASSWORD', $request->mail_password);
            $this->updateDotEnv('MAIL_FROM_ADDRESS', $request->mail_from_address);
        }

        return back()->with('success', 'Configuration updated successfully!');
    }

    private function updateDotEnv($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $content = file_get_contents($path);
            
            // Regex to find and replace or append the key
            if (preg_match("/^{$key}=(.*)$/m", $content)) {
                $content = preg_replace("/^{$key}=(.*)$/m", "{$key}=\"{$value}\"", $content);
            } else {
                $content .= "\n{$key}=\"{$value}\"";
            }
            
            file_put_contents($path, $content);
        }
    }

    public function reviews()
    {
        $reviews = Review::latest()->paginate(10);
        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function reviewsCreate()
    {
        return view('dashboard.reviews.create');
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

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        Review::create($validated);

        return back()->with('success', 'Review added successfully!');
    }

    public function reviewDestroy(Review $review)
    {
        if ($review->client_image) Storage::disk('public')->delete($review->client_image);
        $review->delete();
        return back()->with('success', 'Review removed successfully!');
    }

    public function reviewEdit(Review $review)
    {
        return view('dashboard.reviews.edit', compact('review'));
    }

    public function reviewUpdate(Request $request, Review $review)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image_file' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image_file')) {
            if ($review->client_image) Storage::disk('public')->delete($review->client_image);
            $validated['client_image'] = $request->file('image_file')->store('reviews', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $review->update($validated);

        return redirect()->route('dashboard.reviews')->with('success', 'Review updated successfully!');
    }

    public function portfolio()
    {
        $portfolios = Portfolio::latest()->with('service')->paginate(10);
        $services = Service::all();
        return view('dashboard.portfolio.index', compact('portfolios', 'services'));
    }

    public function portfolioCreate()
    {
        $services = Service::all();
        return view('dashboard.portfolio.create', compact('services'));
    }

    public function portfolioStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'project_url' => 'nullable|url',
            'client_name' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('portfolio', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        Portfolio::create($validated);

        return back()->with('success', 'Project added to portfolio!');
    }

    public function portfolioShow(Portfolio $project)
    {
        $project->load(['service', 'extraDetails']);
        return view('dashboard.portfolio.show', compact('project'));
    }

    public function portfolioDestroy(Portfolio $project)
    {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return back()->with('success', 'Project removed from portfolio!');
    }

    public function portfolioEdit(Portfolio $project)
    {
        $services = Service::all();
        return view('dashboard.portfolio.edit', compact('project', 'services'));
    }

    public function portfolioUpdate(Request $request, Portfolio $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'project_url' => 'nullable|url',
            'client_name' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image_file')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $validated['image'] = $request->file('image_file')->store('portfolio', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $project->update($validated);

        return redirect()->route('dashboard.portfolio')->with('success', 'Project updated successfully!');
    }

    public function events()
    {
        $events = Event::latest()->paginate(10);
        return view('dashboard.events.index', compact('events'));
    }

    public function eventsCreate()
    {
        return view('dashboard.events.create');
    }

    public function eventsShow(Event $event)
    {
        $event->load('media');
        return view('dashboard.events.show', compact('event'));
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

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        Event::create($validated);

        return back()->with('success', 'Event created! You can now add media into it.');
    }

    public function eventEdit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    public function eventUpdate(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'thumbnail_file' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            if ($event->thumbnail) Storage::disk('public')->delete($event->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail_file')->store('events', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $event->update($validated);

        return redirect()->route('dashboard.events')->with('success', 'Event updated successfully!');
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

    public function sectionSettings($key)
    {
        $setting = SectionSetting::firstOrCreate(
            ['key' => $key],
            ['title' => ucfirst($key), 'description' => '', 'is_visible' => true]
        );
        $profile = ProfileInfo::first();
        return view('dashboard.section_settings', compact('setting', 'profile'));
    }

    public function sectionSettingsUpdate(Request $request, $key)
    {
        $setting = SectionSetting::firstOrCreate(
            ['key' => $key],
            ['title' => ucfirst($key), 'description' => '', 'is_visible' => true]
        );
        
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'google_map_url' => 'nullable|string',
        ]);

        $setting->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_visible' => $request->has('is_visible'),
        ]);

        // Handle Section-Specific Content
        $profile = ProfileInfo::first();
        
        if ($key === 'hero') {
            $profile->update([
                'hero_title' => $request->title, // Synchronize with setting title
                'hero_subtitle' => $request->hero_subtitle,
            ]);
            if ($request->hasFile('hero_bg_file')) {
                $path = $request->file('hero_bg_file')->store('hero', 'public');
                $profile->update(['hero_bg' => $path]);
            }
        } elseif ($key === 'about') {
            $profile->update([
                'about_text' => $request->about_text,
                'mission_statement' => $request->mission_statement,
                'vision_statement' => $request->vision_statement,
            ]);
            if ($request->hasFile('about_image_file')) {
                $path = $request->file('about_image_file')->store('about', 'public');
                $profile->update(['about_image' => $path]);
            }
        } elseif ($key === 'stats') {
            $profile->update([
                'stat_clients' => $request->stat_clients,
                'stat_projects' => $request->stat_projects,
                'stat_hours' => $request->stat_hours,
                'stat_workers' => $request->stat_workers,
            ]);
        } elseif ($key === 'header') {
            $profile->update([
                'topbar_address' => $request->topbar_address,
                'topbar_phone' => $request->topbar_phone,
                'show_topbar_contact' => $request->has('show_topbar_contact'),
                'show_topbar_social' => $request->has('show_topbar_social'),
            ]);
        } elseif ($key === 'contact') {
            $profile->update([
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'google_map_url' => $request->google_map_url,
            ]);
        }


        return back()->with('success', ucfirst($key) . ' section content updated!');
    }

    public function extraDetailStore(Request $request)
    {
        $request->validate([
            'detailable_id' => 'required|integer',
            'detailable_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $modelClass = "App\\Models\\" . $request->detailable_type;
        $model = $modelClass::findOrFail($request->detailable_id);

        $model->extraDetails()->create([
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $model->extraDetails()->count() + 1
        ]);

        return back()->with('success', 'Detail added successfully!');
    }

    public function extraDetailUpdate(Request $request, \App\Models\ExtraDetail $detail)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $detail->update($request->only('title', 'description'));

        return back()->with('success', 'Detail updated successfully!');
    }

    public function extraDetailDestroy(\App\Models\ExtraDetail $detail)
    {
        $detail->delete();
        return back()->with('success', 'Detail removed successfully!');
    }
}
