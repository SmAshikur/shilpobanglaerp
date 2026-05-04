@extends('layouts.app')

@section('content')

    <!-- Page Header Banner -->
    <div class="relative bg-slate-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-center bg-cover" style="background-image: url('{{ $profile->hero_bg ? asset('storage/'.$profile->hero_bg) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80' }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-slate-900/90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">About Us</h1>
            <div class="flex justify-center items-center gap-3 text-sm font-medium text-blue-200">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <span>/</span>
                <span class="text-white">About Us</span>
            </div>
        </div>
        <!-- Decorative shape -->
        <div class="absolute -bottom-1 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-12 text-white" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C52.16,93.8,105.52,85.2,156.4,72.47,211.75,58.59,266.3,42.5,321.39,56.44Z"></path>
            </svg>
        </div>
    </div>

    <!-- Main Story Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image Side -->
                <div class="relative">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl">
                        @if($profile->about_image)
                            <img src="{{ asset('storage/'.$profile->about_image) }}" class="w-full h-auto object-cover hover:scale-105 transition duration-700" alt="About Our Company">
                        @else
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" class="w-full h-auto object-cover hover:scale-105 transition duration-700" alt="About Our Company">
                        @endif
                    </div>
                    <!-- Floating Experience Badge -->
                    <div class="absolute -bottom-8 -right-8 bg-blue-600 text-white p-8 rounded-2xl shadow-xl z-20 hidden md:block border-4 border-white animate-bounce-slow">
                        <span class="block text-4xl font-black mb-1">10+</span>
                        <span class="text-sm font-semibold uppercase tracking-wider text-blue-100">Years of<br>Experience</span>
                    </div>
                    <!-- Decorative Dots -->
                    <div class="absolute -top-10 -left-10 z-0 opacity-20">
                        <svg width="100" height="100" fill="none" viewBox="0 0 100 100"><pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle fill="currentColor" cx="2" cy="2" r="2" class="text-blue-600"></circle></pattern><rect width="100" height="100" fill="url(#dots)"></rect></svg>
                    </div>
                </div>

                <!-- Text Side -->
                <div>
                    <span class="text-blue-600 font-bold tracking-widest uppercase text-sm mb-3 block relative pl-12 before:content-[''] before:absolute before:left-0 before:top-1/2 before:w-8 before:h-0.5 before:bg-blue-600">Discover Who We Are</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-6 leading-tight">We Build Solutions That Empower Your Business</h2>
                    
                    <div class="prose prose-lg text-slate-600 mb-8">
                        <p class="font-medium text-slate-700 text-lg leading-relaxed">
                            {!! nl2br(e($profile->about_text ?? 'We started with a simple idea: to provide high-quality digital solutions to businesses of all sizes.')) !!}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission & Vision Section -->
            @if($profile->mission_statement || $profile->vision_statement)
            <div class="mt-24 space-y-8 max-w-5xl mx-auto">
                @if($profile->mission_statement)
                <div class="bg-gradient-to-r from-blue-50 to-white border border-blue-100 p-8 md:p-12 rounded-[2rem] shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-200 rounded-full blur-[80px] -mr-20 -mt-20 opacity-40 group-hover:opacity-60 transition-opacity"></div>
                    <div class="absolute bottom-0 left-0 w-2 h-full bg-blue-600"></div>
                    <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start md:items-center">
                        <div class="w-20 h-20 shrink-0 bg-blue-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-600/30">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-slate-800 mb-4 tracking-tight">Our Mission</h3>
                            <p class="text-slate-700 text-xl leading-relaxed font-medium italic">
                                "{!! nl2br(e($profile->mission_statement)) !!}"
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                @if($profile->vision_statement)
                <div class="bg-gradient-to-r from-indigo-50 to-white border border-indigo-100 p-8 md:p-12 rounded-[2rem] shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-indigo-200 rounded-full blur-[80px] -mr-20 -mb-20 opacity-40 group-hover:opacity-60 transition-opacity"></div>
                    <div class="absolute top-0 left-0 w-2 h-full bg-indigo-600"></div>
                    <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start md:items-center">
                        <div class="w-20 h-20 shrink-0 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-600/30">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-slate-800 mb-4 tracking-tight">Our Vision</h3>
                            <p class="text-slate-700 text-xl leading-relaxed font-medium italic">
                                "{!! nl2br(e($profile->vision_statement)) !!}"
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-bold tracking-widest uppercase text-sm mb-2 block">Our Philosophy</span>
                <h2 class="text-3xl font-bold text-slate-800 mb-4">Core Values</h2>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center hover:-translate-y-2 transition duration-300 border-b-4 border-blue-600">
                    <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Innovation</h3>
                    <p class="text-slate-500 text-sm">We constantly push the boundaries to find new and creative solutions.</p>
                </div>
                <!-- Value 2 -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center hover:-translate-y-2 transition duration-300 border-b-4 border-indigo-600">
                    <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Integrity</h3>
                    <p class="text-slate-500 text-sm">We believe in transparent, honest, and ethical business practices.</p>
                </div>
                <!-- Value 3 -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center hover:-translate-y-2 transition duration-300 border-b-4 border-sky-600">
                    <div class="w-20 h-20 bg-sky-50 text-sky-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Excellence</h3>
                    <p class="text-slate-500 text-sm">We are committed to delivering the highest quality in everything we do.</p>
                </div>
                <!-- Value 4 -->
                <div class="bg-white p-8 rounded-xl shadow-sm text-center hover:-translate-y-2 transition duration-300 border-b-4 border-teal-600">
                    <div class="w-20 h-20 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Teamwork</h3>
                    <p class="text-slate-500 text-sm">We collaborate closely with our clients to ensure shared success.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    @if(isset($team) && $team->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-bold tracking-widest uppercase text-sm mb-2 block">The People Behind The Code</span>
                <h2 class="text-3xl font-bold text-slate-800 mb-4">Meet Our Experts</h2>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($team as $member)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-2xl transition-all duration-300 border border-gray-100 relative">
                    <div class="absolute inset-0 bg-blue-600 scale-y-0 origin-bottom group-hover:scale-y-100 transition-transform duration-500 z-0"></div>
                    <div class="relative z-10 p-6 flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg mb-6 group-hover:border-blue-300 transition duration-300">
                            @if($member->image)
                                <img src="{{ asset('storage/'.$member->image) }}" class="w-full h-full object-cover" alt="{{ $member->name }}">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                </div>
                            @endif
                        </div>
                        <h4 class="text-xl font-bold text-slate-800 group-hover:text-white transition duration-300">
                            <a href="{{ route('team.details', $member->id) }}" class="hover:text-blue-200">{{ $member->name }}</a>
                        </h4>
                        <p class="text-blue-600 text-sm font-medium mb-2 group-hover:text-blue-200 transition duration-300">{{ $member->position }}</p>
                        <a href="{{ route('team.details', $member->id) }}" class="text-xs font-semibold text-slate-400 hover:text-white uppercase tracking-wider group-hover:text-white/80 transition duration-300">View Profile</a>
                        
                        <div class="flex justify-center gap-3 w-full border-t border-gray-100 group-hover:border-blue-500 pt-4 mt-2 transition duration-300">
                            @if($member->facebook_url) 
                                <a href="{{ $member->facebook_url }}" class="text-slate-400 hover:text-blue-600 group-hover:text-blue-200 group-hover:hover:text-white transition"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a> 
                            @endif
                            @if($member->linkedin_url) 
                                <a href="{{ $member->linkedin_url }}" class="text-slate-400 hover:text-blue-600 group-hover:text-blue-200 group-hover:hover:text-white transition"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0z"/></svg></a> 
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Call To Action -->
    <section class="py-20 relative bg-blue-600 text-center px-4">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTIwIDBoMjB2MjBIMjB6TTAgMjBoMjB2MjBIMHoiIGZpbGw9IiNmZmYiIGZpbGwtcnVsZT0iZXZlbm9kZCIgZmlsbC1vcGFjaXR5PSIuMSIvPjwvc3ZnPg==')]"></div>
        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Ready to take your business to the next level?</h2>
            <p class="text-blue-100 text-lg mb-8">Join hundreds of satisfied clients who have transformed their digital presence with us.</p>
            <a href="{{ route('contact.page') }}" class="inline-block bg-white text-blue-600 font-bold px-10 py-4 rounded hover:bg-slate-50 transition shadow-xl hover:shadow-2xl hover:-translate-y-1">Start A Project Today</a>
        </div>
    </section>

@endsection
