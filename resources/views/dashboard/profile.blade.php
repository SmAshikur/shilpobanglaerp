@extends('layouts.dashboard')

@section('header', 'Site Settings & SEO')

@section('content')
<div x-data="{ tab: 'general' }" class="max-w-6xl mx-auto">

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 mb-8 bg-white dark:bg-slate-900 p-2 rounded-2xl shadow-sm border border-slate-100 dark:border-white/5">
        <button @click="tab = 'general'" :class="tab === 'general' ? 'bg-indigo-600 text-white shadow-md dark:shadow-none' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-indigo-600 dark:hover:text-indigo-400'" class="px-6 py-3 rounded-xl font-bold text-sm transition-all flex-1 text-center">Business Profile</button>
        <button @click="tab = 'seo'" :class="tab === 'seo' ? 'bg-indigo-600 text-white shadow-md dark:shadow-none' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-indigo-600 dark:hover:text-indigo-400'" class="px-6 py-3 rounded-xl font-bold text-sm transition-all flex-1 text-center">SEO Settings</button>
        <button @click="tab = 'security'" :class="tab === 'security' ? 'bg-indigo-600 text-white shadow-md dark:shadow-none' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-indigo-600 dark:hover:text-indigo-400'" class="px-6 py-3 rounded-xl font-bold text-sm transition-all flex-1 text-center">Password & Security</button>
        <button @click="tab = 'smtp'" :class="tab === 'smtp' ? 'bg-indigo-600 text-white shadow-md dark:shadow-none' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-indigo-600 dark:hover:text-indigo-400'" class="px-6 py-3 rounded-xl font-bold text-sm transition-all flex-1 text-center">SMTP / Mail</button>
    </div>

    <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- General Info Tab -->
        <div x-show="tab === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-slate-900 p-12 rounded-[3.5rem] border border-slate-100 dark:border-white/5 shadow-xl space-y-8">
            <h3 class="text-2xl font-black text-indigo-950 dark:text-white flex items-center gap-4 mb-4">
                 <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                 </div>
                 Core Business Info
            </h3>
            
            <div class="grid grid-cols-1 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Brand Logo</label>
                    <div class="flex items-center gap-6">
                         <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-3xl overflow-hidden flex items-center justify-center shrink-0">
                            @if($profile->logo)
                                <img src="{{ asset('storage/'.$profile->logo) }}" class="w-full h-full object-contain">
                            @else
                                <span class="text-[10px] text-slate-300 dark:text-slate-600 uppercase font-black">No Logo</span>
                            @endif
                         </div>
                         <input type="file" name="logo_file" class="flex-1 px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Company Name</label>
                    <input type="text" name="company_name" value="{{ $profile->company_name }}" required class="w-full px-6 py-5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Email Address</label>
                        <input type="email" name="email" value="{{ $profile->email }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Phone Number</label>
                        <input type="text" name="phone" value="{{ $profile->phone }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Address</label>
                    <input type="text" name="address" value="{{ $profile->address }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t border-slate-100 dark:border-white/5 pt-8 mt-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Facebook URL</label>
                        <input type="url" name="facebook_url" value="{{ $profile->facebook_url }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" value="{{ $profile->linkedin_url }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Instagram URL</label>
                        <input type="url" name="instagram_url" value="{{ $profile->instagram_url }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Twitter URL</label>
                        <input type="url" name="twitter_url" value="{{ $profile->twitter_url }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">YouTube URL</label>
                        <input type="url" name="youtube_url" value="{{ $profile->youtube_url }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-slate-100 dark:border-white/5 pt-8 mt-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Footer Copyright Text</label>
                        <input type="text" name="footer_text" value="{{ $profile->footer_text }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100" placeholder="e.g. © 2026 CoreBiz Solutions.">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Footer Brief Description</label>
                        <textarea name="footer_description" rows="2" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100" placeholder="A short description for the footer...">{{ $profile->footer_description }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Section Tab -->
        <div x-show="tab === 'seo'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-slate-900 p-12 rounded-[3.5rem] border border-slate-100 dark:border-white/5 shadow-xl space-y-8">
            <h3 class="text-2xl font-black text-indigo-950 dark:text-white flex items-center gap-4 mb-4">
                 <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                 </div>
                 SEO Settings
            </h3>
            
            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Meta Title (SEO Browser Title)</label>
                    <input type="text" name="meta_title" value="{{ $profile->meta_title }}" class="w-full px-6 py-5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100 placeholder-slate-400">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Meta Description</label>
                    <textarea name="meta_description" rows="4" class="w-full px-6 py-5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100 placeholder-slate-400">{{ $profile->meta_description }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ $profile->meta_keywords }}" class="w-full px-6 py-5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100 placeholder-slate-400">
                </div>
            </div>
        </div>

        <!-- Security Tab -->
        <div x-show="tab === 'security'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-slate-900 p-12 rounded-[3.5rem] border border-slate-100 dark:border-white/5 shadow-xl space-y-8">
            <h3 class="text-2xl font-black text-indigo-950 dark:text-white flex items-center gap-4 mb-4">
                 <div class="w-12 h-12 bg-rose-600 rounded-2xl flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                 </div>
                 Admin Access & Password
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-4 uppercase tracking-widest text-center">Admin Profile Picture</label>
                    <div class="flex flex-col items-center justify-center gap-6">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-3xl overflow-hidden ring-4 ring-indigo-50 dark:ring-slate-800 shadow-xl">
                                @if(auth()->user()->profile_image)                                     <img src="{{ asset('storage/'.auth()->user()->profile_image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-500 dark:text-indigo-400 font-black text-2xl">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                        </div>
                        <input type="file" name="profile_image_file" class="text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500/20 transition cursor-pointer">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Admin Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Admin Email</label>
                    <input type="email" name="user_email" value="{{ auth()->user()->email }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">New Password (Leave blank to keep current)</label>
                    <input type="password" name="password" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100" placeholder="••••••••">
                </div>
            </div>
        </div>

        <!-- SMTP Tab -->
        <div x-show="tab === 'smtp'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-slate-900 p-12 rounded-[3.5rem] border border-slate-100 dark:border-white/5 shadow-xl space-y-8">
            <h3 class="text-2xl font-black text-indigo-950 dark:text-white flex items-center gap-4 mb-4">
                 <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                 </div>
                 SMTP / Mail Server Configuration
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Mail Host</label>
                    <input type="text" name="mail_host" value="{{ env('MAIL_HOST') }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100 placeholder-slate-400" placeholder="smtp.gmail.com">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Mail Port</label>
                    <input type="text" name="mail_port" value="{{ env('MAIL_PORT') }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100 placeholder-slate-400" placeholder="587">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Encryption</label>
                    <select name="mail_encryption" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                        <option value="tls" {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }} class="bg-white dark:bg-slate-900">TLS</option>
                        <option value="ssl" {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }} class="bg-white dark:bg-slate-900">SSL</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Username</label>
                    <input type="text" name="mail_username" value="{{ env('MAIL_USERNAME') }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">Password</label>
                    <input type="password" name="mail_password" value="{{ env('MAIL_PASSWORD') }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-2 uppercase tracking-widest">From Address</label>
                    <input type="email" name="mail_from_address" value="{{ env('MAIL_FROM_ADDRESS') }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:ring-2 focus:ring-indigo-600 transition dark:text-slate-100">
                </div>
            </div>
            <div class="p-6 bg-amber-50 dark:bg-amber-500/10 rounded-2xl border border-amber-100 dark:border-amber-500/20 flex gap-4">
                <svg class="w-6 h-6 text-amber-600 dark:text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <p class="text-sm text-amber-800 dark:text-amber-300">Note: SMTP changes will be applied to the environment configuration. Ensure your mail server credentials are correct.</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-8">
            <button type="submit" class="w-full py-6 bg-indigo-600 text-white font-black rounded-2xl hover:bg-indigo-500 transition-all uppercase tracking-[0.2em] shadow-2xl shadow-indigo-600/40 dark:shadow-none transform hover:-translate-y-1">Save All Settings</button>
            <p class="text-center text-[10px] text-slate-400 dark:text-slate-500 font-bold mt-6 uppercase tracking-widest">Changes take effect immediately on live site</p>
        </div>
    </form>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
