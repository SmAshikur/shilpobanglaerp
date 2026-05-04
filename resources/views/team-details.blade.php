@extends('layouts.app')

@section('content')

    <!-- Page Header Banner -->
    <div class="relative bg-slate-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-center bg-cover" style="background-image: url('{{ $profile->hero_bg ? asset('storage/'.$profile->hero_bg) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80' }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-slate-900/90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Team Member Details</h1>
            <div class="flex justify-center items-center gap-3 text-sm font-medium text-blue-200">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <span>/</span>
                <a href="{{ route('home') }}#team" class="hover:text-white transition">Team</a>
                <span>/</span>
                <span class="text-white">{{ $member->name }}</span>
            </div>
        </div>
        <div class="absolute -bottom-1 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-12 text-white" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C52.16,93.8,105.52,85.2,156.4,72.47,211.75,58.59,266.3,42.5,321.39,56.44Z"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">
                
                <!-- Left: Profile Image -->
                <div class="lg:col-span-4 flex justify-center lg:justify-end relative">
                    <div class="rounded-2xl overflow-hidden shadow-2xl relative z-10 w-full max-w-xs aspect-square">
                        @if($member->image)
                            <img src="{{ asset('storage/'.$member->image) }}" class="w-full h-full object-cover" alt="{{ $member->name }}">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                <svg class="w-24 h-24 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    </div>
                    <!-- Decorative Dots -->
                    <div class="absolute -bottom-6 -left-0 lg:-left-6 z-0 opacity-20 hidden md:block">
                        <svg width="100" height="100" fill="none" viewBox="0 0 100 100"><pattern id="dots2" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle fill="currentColor" cx="2" cy="2" r="2" class="text-blue-600"></circle></pattern><rect width="100" height="100" fill="url(#dots2)"></rect></svg>
                    </div>
                </div>

                <!-- Right: Details -->
                <div class="lg:col-span-8">
                    <div class="mb-8 border-b border-gray-100 pb-8">
                        <h2 class="text-4xl font-bold text-slate-800 mb-2">{{ $member->name }}</h2>
                        <h4 class="text-xl text-blue-600 font-medium mb-6">{{ $member->position }}</h4>
                        
                        <!-- Social Links -->
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-semibold text-slate-400 uppercase tracking-widest mr-2">Connect:</span>
                            @if($member->facebook_url) 
                                <a href="{{ $member->facebook_url }}" class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a> 
                            @endif
                            @if($member->linkedin_url) 
                                <a href="{{ $member->linkedin_url }}" class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0z"/></svg></a> 
                            @endif
                            @if($member->twitter_url) 
                                <a href="{{ $member->twitter_url }}" class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a> 
                            @endif
                        </div>
                    </div>

                    <div class="prose prose-lg text-slate-600 max-w-none">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Professional Overview</h3>
                        @if($member->bio)
                            <p>{!! nl2br(e($member->bio)) !!}</p>
                        @else
                            <p>
                                <strong>{{ $member->name }}</strong> is an integral part of our team, serving as a dedicated <strong>{{ $member->position }}</strong>. With a wealth of experience and a passion for excellence, {{ $member->name }} consistently drives innovation and results within the organization.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Team Members Section -->
    @if(isset($otherMembers) && $otherMembers->count() > 0)
    <section class="py-16 bg-slate-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Other Team Members</h3>
                    <div class="w-12 h-1 bg-blue-600 rounded mt-2"></div>
                </div>
                <a href="{{ route('home') }}#team" class="hidden sm:flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-800 transition">View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($otherMembers as $om)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300 border border-gray-100">
                    <a href="{{ route('team.details', $om->id) }}" class="block relative overflow-hidden aspect-[4/5]">
                        @if($om->image)
                            <img src="{{ asset('storage/'.$om->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $om->name }}">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                    </a>
                    <div class="p-5 text-center">
                        <a href="{{ route('team.details', $om->id) }}"><h4 class="text-lg font-bold text-slate-800 hover:text-blue-600 transition">{{ $om->name }}</h4></a>
                        <p class="text-sm text-blue-600 mt-1">{{ $om->position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
