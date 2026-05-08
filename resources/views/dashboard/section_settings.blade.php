@extends('layouts.dashboard')

@section('header', ucfirst($setting->key) . ' Section Settings')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-slate-800 dark:text-white">{{ ucfirst($setting->key) }} Configuration</h3>
                <p class="text-slate-500 dark:text-slate-400">Manage how the {{ $setting->key }} section appears on your landing page</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden">
        <form action="{{ route('dashboard.section-settings.update', $setting->key) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-10">
            @csrf
            
            <!-- Visibility Toggle -->
            <div class="flex items-center justify-between p-6 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-white/5">
                <div>
                    <h4 class="font-bold text-slate-800 dark:text-slate-100">Section Visibility</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Enable or disable this section entirely from the frontend</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_visible" value="1" {{ $setting->is_visible ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-14 h-7 bg-slate-200 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-600"></div>
                </label>
            </div>

            <div class="space-y-8">
                <!-- Section Title (Shared by all) -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Section Header Title</label>
                    <input type="text" name="title" value="{{ $setting->title }}" placeholder="e.g. Our Featured Services" 
                           class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                </div>

                <!-- Hero Section Specific Fields -->
                @if($setting->key === 'hero')
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Hero Subtitle</label>
                    <textarea name="hero_subtitle" rows="3" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 resize-none dark:text-slate-100">{{ $profile->hero_subtitle }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Background Image</label>
                    <div class="flex items-center gap-6 p-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl">
                         <div class="w-24 h-16 bg-slate-200 dark:bg-slate-700 rounded-xl overflow-hidden shadow-inner">
                            @if($profile->hero_bg)
                                <img src="{{ asset('storage/'.$profile->hero_bg) }}" class="w-full h-full object-cover">
                            @endif
                         </div>
                         <input type="file" name="hero_bg_file" class="flex-1 text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500/20 transition">
                    </div>
                </div>

                <!-- About Section Specific Fields -->
                @elseif($setting->key === 'about')
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Detailed About Description</label>
                    <textarea name="about_text" rows="6" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 resize-none dark:text-slate-100">{{ $profile->about_text }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Mission</label>
                        <textarea name="mission_statement" rows="3" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 resize-none dark:text-slate-100">{{ $profile->mission_statement }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Vision</label>
                        <textarea name="vision_statement" rows="3" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 resize-none dark:text-slate-100">{{ $profile->vision_statement }}</textarea>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">About Image</label>
                    <div class="flex items-center gap-6 p-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl">
                         <div class="w-24 h-16 bg-slate-200 dark:bg-slate-700 rounded-xl overflow-hidden shadow-inner">
                            @if($profile->about_image)
                                <img src="{{ asset('storage/'.$profile->about_image) }}" class="w-full h-full object-cover">
                            @endif
                         </div>
                         <input type="file" name="about_image_file" class="flex-1 text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500/20 transition">
                    </div>
                </div>

                <!-- Stats Section Specific Fields -->
                @elseif($setting->key === 'stats')
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Clients</label>
                        <input type="text" name="stat_clients" value="{{ $profile->stat_clients }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Projects</label>
                        <input type="text" name="stat_projects" value="{{ $profile->stat_projects }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Support Hours</label>
                        <input type="text" name="stat_hours" value="{{ $profile->stat_hours }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Team Size</label>
                        <input type="text" name="stat_workers" value="{{ $profile->stat_workers }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                    </div>
                </div>

                <!-- Header / Topbar Specific Fields -->
                @elseif($setting->key === 'header')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-white/5">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="font-bold text-slate-800 dark:text-slate-100">Show Contact Info</h4>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="show_topbar_contact" value="1" {{ $profile->show_topbar_contact ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-indigo-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Topbar Address</label>
                                <input type="text" name="topbar_address" value="{{ $profile->topbar_address }}" placeholder="e.g. 123 Street, New York" class="w-full px-5 py-3 bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none dark:text-white">
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Topbar Phone</label>
                                <input type="text" name="topbar_phone" value="{{ $profile->topbar_phone }}" placeholder="e.g. +1 234 567 890" class="w-full px-5 py-3 bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none dark:text-white">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-white/5">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="font-bold text-slate-800 dark:text-slate-100">Show Social Icons</h4>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="show_topbar_social" value="1" {{ $profile->show_topbar_social ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-indigo-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Toggle visibility of social media links in the top header. Links are managed in the overall profile settings.
                        </p>
                    </div>
                </div>

                <!-- Contact Section Specific Fields -->
                @elseif($setting->key === 'contact')
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Section Subtitle</label>
                    <textarea name="description" rows="3" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 resize-none dark:text-slate-100">{{ $setting->description }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Office Address</label>
                        <input type="text" name="address" value="{{ $profile->address }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Primary Phone</label>
                        <input type="text" name="phone" value="{{ $profile->phone }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Primary Email</label>
                        <input type="email" name="email" value="{{ $profile->email }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 dark:text-slate-100">
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between ml-1 mb-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Google Map Embed (iframe src or URL)</label>
                        <a href="https://www.google.com/maps" target="_blank" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            Open Google Maps
                        </a>
                    </div>
                    <textarea name="google_map_url" rows="4" placeholder="Paste the 'src' from the Google Maps iframe embed code here" 
                              class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 resize-none dark:text-slate-100 font-mono text-sm">{{ $profile->google_map_url }}</textarea>
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 ml-1">
                        <strong>Tip:</strong> Search location on Google Maps > Share > Embed a map > Copy HTML and paste it here.
                    </p>
                </div>

                <!-- Default description field for other sections -->
                @else
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1 mb-2">Section Subtitle / Description</label>
                    <textarea name="description" rows="4" placeholder="Briefly explain what this section is about..." 
                              class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 focus:bg-white dark:focus:bg-slate-900 focus:outline-none transition-all duration-300 resize-none dark:text-slate-100">{{ $setting->description }}</textarea>
                </div>
                @endif
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all duration-300 shadow-xl shadow-indigo-200 dark:shadow-none transform hover:-translate-y-1">
                    Save Section Configuration
                </button>
            </div>
        </form>
    </div>
    
    @if(in_array($setting->key, ['hero', 'about', 'contact']))
    <div class="mt-8 p-6 bg-amber-50 dark:bg-amber-500/10 rounded-2xl border border-amber-100 dark:border-amber-500/20 flex gap-4">
        <svg class="w-6 h-6 text-amber-600 dark:text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <p class="text-sm text-amber-800 dark:text-amber-300">
            <strong>Note:</strong> The <strong>{{ ucfirst($setting->key) }}</strong> section is a core part of the website. While you can edit its content here, it is recommended to keep it visible for better user experience.
        </p>
    </div>
    @endif
</div>
@endsection
