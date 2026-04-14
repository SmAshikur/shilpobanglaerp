@extends('layouts.dashboard')

@section('header', 'Site Settings & SEO')

@section('content')
<div class="max-w-6xl mx-auto space-y-12">
    <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        @csrf
        <!-- Business Info Section -->
        <div class="bg-white p-12 rounded-[3.5rem] border border-slate-100 shadow-xl space-y-8">
            <h3 class="text-2xl font-black text-indigo-950 flex items-center gap-4 mb-4">
                 <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                 </div>
                 Core Business Info
            </h3>
            
            <div class="grid grid-cols-1 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2 uppercase tracking-widest">Brand Logo</label>
                    <div class="flex items-center gap-6">
                         <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-3xl overflow-hidden flex items-center justify-center">
                            @if($profile->logo)
                                <img src="{{ asset('storage/'.$profile->logo) }}" class="w-full h-full object-contain">
                            @else
                                <span class="text-[10px] text-slate-300 uppercase font-black">No Logo</span>
                            @endif
                         </div>
                         <input type="file" name="logo_file" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2 uppercase tracking-widest">Company Name</label>
                    <input type="text" name="company_name" value="{{ $profile->company_name }}" required class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2 uppercase tracking-widest">Hero Title</label>
                    <input type="text" name="hero_title" value="{{ $profile->hero_title }}" required class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2 uppercase tracking-widest">About Image</label>
                    <div class="flex items-center gap-6">
                         <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-3xl overflow-hidden flex items-center justify-center">
                            @if($profile->about_image)
                                <img src="{{ asset('storage/'.$profile->about_image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-[10px] text-slate-300 uppercase font-black">No Img</span>
                            @endif
                         </div>
                         <input type="file" name="about_image_file" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2 uppercase tracking-widest">Hero Background</label>
                    <div class="flex items-center gap-6">
                         <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-3xl overflow-hidden flex items-center justify-center">
                            @if($profile->hero_bg)
                                <img src="{{ asset('storage/'.$profile->hero_bg) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-[10px] text-slate-300 uppercase font-black">No Bg</span>
                            @endif
                         </div>
                         <input type="file" name="hero_bg_file" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-2">Email</label>
                        <input type="email" name="email" value="{{ $profile->email }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ $profile->phone }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-medium">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2 uppercase tracking-widest">Footer Info</label>
                    <textarea name="footer_text" rows="2" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition" placeholder="e.g. © 2026 Professional Services Co.">{{ $profile->footer_text }}</textarea>
                </div>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="bg-slate-900 p-12 rounded-[3.5rem] shadow-2xl space-y-8 text-white">
            <h3 class="text-2xl font-black flex items-center gap-4 mb-4">
                 <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                 </div>
                 SEO Settings
            </h3>
            
            <div class="space-y-8">
                <div>
                    <label class="block text-xs font-black text-white/50 mb-3 uppercase tracking-widest">Meta Title (SEO Browser Title)</label>
                    <input type="text" name="meta_title" value="{{ $profile->meta_title }}" class="w-full px-6 py-5 bg-white/5 border border-white/10 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-white placeholder-white/20" placeholder="E.g. Digital Marketing Agency in City">
                </div>

                <div>
                    <label class="block text-xs font-black text-white/50 mb-3 uppercase tracking-widest">Meta Description (Search Snippet)</label>
                    <textarea name="meta_description" rows="4" class="w-full px-6 py-5 bg-white/5 border border-white/10 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-white placeholder-white/20" placeholder="A short description that appears in Google search results...">{{ $profile->meta_description }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-black text-white/50 mb-3 uppercase tracking-widest">Meta Keywords (Comma separated)</label>
                    <input type="text" name="meta_keywords" value="{{ $profile->meta_keywords }}" class="w-full px-6 py-5 bg-white/5 border border-white/10 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-white placeholder-white/20" placeholder="agency, marketing, web design">
                </div>

                <div class="pt-10">
                    <button type="submit" class="w-full py-6 bg-indigo-600 text-white font-black rounded-2xl hover:bg-indigo-500 transition-all uppercase tracking-[0.2em] shadow-2xl shadow-indigo-600/40 transform hover:-translate-y-1">Save All Settings</button>
                    <p class="text-center text-[10px] text-white/30 font-bold mt-6 uppercase tracking-widest">Changes take effect immediately on live site</p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
