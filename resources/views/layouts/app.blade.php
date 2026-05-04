<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': darkMode }" x-data="{ darkMode: localStorage.getItem('site_theme') === 'dark' }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $profile->meta_title ?? (($profile->company_name ?? 'Dynamic') . ' | Professional Business Profile') }}</title>
        <meta name="description" content="{{ $profile->meta_description ?? 'Professional business profile and services' }}">
        <meta name="keywords" content="{{ $profile->meta_keywords ?? 'business, services, creative' }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
            .dark-glass { background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="antialiased bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 scroll-smooth">
        
        <div x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 40" class="relative">
            <!-- Top Bar -->
            @if($sectionSettings['header']->is_visible)
            <div class="bg-slate-900 text-white/80 text-xs hidden lg:block border-b border-white/5">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-12 flex items-center justify-between">
                    <div class="flex items-center gap-8">
                        <span class="flex items-center gap-2 hover:text-white transition cursor-default">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            {{ $profile->phone ?? '+1 5589 55488 55' }}
                        </span>
                        <span class="flex items-center gap-2 hover:text-white transition cursor-default">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            {{ $profile->address ?? 'A108 Adam Street, NY 535022' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-5">
                        @if($profile->facebook_url) <a href="{{ $profile->facebook_url }}" target="_blank" class="hover:text-blue-500 transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></a> @endif
                        @if($profile->twitter_url) <a href="{{ $profile->twitter_url }}" target="_blank" class="hover:text-sky-400 transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a> @endif
                        @if($profile->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:text-blue-600 transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a> @endif
                        @if($profile->instagram_url) <a href="{{ $profile->instagram_url }}" target="_blank" class="hover:text-pink-500 transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a> @endif
                        @if($profile->youtube_url) <a href="{{ $profile->youtube_url }}" target="_blank" class="hover:text-red-500 transition-all"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a> @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Header / Navbar -->
            <header :class="scrolled ? 'bg-white/90 dark:bg-slate-950/90 shadow-md py-3 backdrop-blur-md' : 'bg-white dark:bg-slate-950 py-5'" class="sticky top-0 z-50 transition-all duration-300 w-full border-b border-gray-100 dark:border-white/5">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        @if($profile->logo)
                            <img src="{{ asset('storage/'.$profile->logo) }}" class="h-8 w-auto">
                        @endif
                        <span class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">{{ $profile->company_name ?? 'CoreBiz' }}<span class="text-blue-600">.</span></span>
                    </a>

                    <nav class="hidden md:flex items-center gap-8">
                        <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'text-blue-600' : 'text-slate-600 dark:text-slate-400' }} font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition">Home</a>
                        <a href="{{ route('about') }}" class="{{ Request::is('about') ? 'text-blue-600' : 'text-slate-600 dark:text-slate-400' }} font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition">About</a>
                        
                        @if($sectionSettings['services']->is_visible)
                        <div x-data="{ serviceOpen: false }" @mouseenter="serviceOpen = true" @mouseleave="serviceOpen = false" class="relative">
                            <a href="{{ Request::is('/') ? '#services' : route('home').'#services' }}" class="{{ Request::is('services/*') ? 'text-blue-600' : 'text-slate-600 dark:text-slate-400' }} font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition flex items-center gap-1">
                                Services 
                                <svg class="w-4 h-4 transition-transform duration-200" :class="serviceOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </a>
                            <div x-show="serviceOpen" x-cloak
                                x-transition:enter="transition ease-out duration-200" 
                                x-transition:enter-start="opacity-0 translate-y-2" 
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute top-full left-0 w-64 bg-white dark:bg-slate-900 shadow-2xl rounded-2xl border border-slate-50 dark:border-white/5 py-4 z-50 mt-2">
                                @foreach($services as $s)
                                    <a href="{{ route('service.details', $s->id) }}" class="block px-6 py-3 text-sm text-slate-600 dark:text-slate-400 hover:bg-blue-50 dark:hover:bg-white/5 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">{{ $s->title }}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($sectionSettings['portfolio']->is_visible)
                        <a href="{{ Request::is('/') ? '#portfolio' : route('home').'#portfolio' }}" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition">Portfolio</a>
                        @endif

                        @if($sectionSettings['team']->is_visible)
                        <a href="{{ Request::is('/') ? '#team' : route('home').'#team' }}" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition">Team</a>
                        @endif

                        @if($sectionSettings['reviews']->is_visible)
                        <a href="{{ Request::is('/') ? '#reviews' : route('home').'#reviews' }}" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition">Testimonials</a>
                        @endif

                        @if($sectionSettings['events']->is_visible)
                        <a href="{{ Request::is('/') ? '#events' : route('home').'#events' }}" class="{{ Request::is('event/*') ? 'text-blue-600' : 'text-slate-600 dark:text-slate-400' }} font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition">Events</a>
                        @endif
                        <a href="{{ route('contact.page') }}" class="{{ Request::is('contact') ? 'text-blue-600' : 'text-slate-600 dark:text-slate-400' }} font-semibold text-sm hover:text-blue-600 dark:hover:text-blue-400 transition">Contact</a>
                    </nav>

                    <div class="hidden md:flex items-center gap-4">
                        <!-- Theme Switcher -->
                        <button @click="darkMode = !darkMode; localStorage.setItem('site_theme', darkMode ? 'dark' : 'light')" 
                                class="p-2.5 rounded-xl bg-slate-50 dark:bg-white/5 text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-white/5 hover:bg-slate-100 dark:hover:bg-white/10 transition-all duration-300 shadow-sm" title="Toggle Theme">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                            <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                        </button>
                        
                        <a href="{{ route('contact.page') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl hover:bg-blue-700 transition font-bold text-sm shadow-xl shadow-blue-500/20">Get Started</a>
                    </div>

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-600 hover:text-blue-600 focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div x-show="mobileMenuOpen" x-cloak x-collapse class="md:hidden bg-white dark:bg-slate-900 border-t border-gray-100 dark:border-white/5 absolute w-full left-0 top-full shadow-lg">
                    <div class="flex flex-col px-4 py-4 space-y-4">
                        <div class="flex items-center justify-between pb-2 border-b border-gray-50 dark:border-white/5">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Theme</span>
                            <button @click="darkMode = !darkMode; localStorage.setItem('site_theme', darkMode ? 'dark' : 'light')" 
                                    class="p-2 rounded-lg bg-slate-50 dark:bg-white/5 text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-white/5 transition-all">
                                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                            </button>
                        </div>
                        <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">Home</a>
                        <a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">About</a>
                        @if($sectionSettings['services']->is_visible) <a href="{{ Request::is('/') ? '#services' : route('home').'#services' }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">Services</a> @endif
                        @if($sectionSettings['portfolio']->is_visible) <a href="{{ Request::is('/') ? '#portfolio' : route('home').'#portfolio' }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">Portfolio</a> @endif
                        @if($sectionSettings['team']->is_visible) <a href="{{ Request::is('/') ? '#team' : route('home').'#team' }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">Team</a> @endif
                        @if($sectionSettings['reviews']->is_visible) <a href="{{ Request::is('/') ? '#reviews' : route('home').'#reviews' }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">Testimonials</a> @endif
                        @if($sectionSettings['events']->is_visible) <a href="{{ Request::is('/') ? '#events' : route('home').'#events' }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">Events</a> @endif
                        <a href="{{ route('contact.page') }}" @click="mobileMenuOpen = false" class="text-slate-600 dark:text-slate-400 font-semibold text-sm hover:text-blue-600">Contact</a>
                    </div>
                </div>
            </header>

            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            @if($sectionSettings['footer']->is_visible)
            <footer class="bg-slate-900 text-slate-300 py-20 border-t border-white/5">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                        <div class="col-span-1 lg:col-span-1">
                            <a href="{{ route('home') }}" class="flex items-center gap-2 mb-8">
                                @if($profile->logo)
                                    <img src="{{ asset('storage/'.$profile->logo) }}" class="h-8 w-auto">
                                @endif
                                <span class="text-2xl font-bold text-white tracking-tight">{{ $profile->company_name ?? 'CoreBiz' }}<span class="text-blue-500">.</span></span>
                            </a>
                            <p class="text-slate-400 leading-relaxed mb-8">{{ $profile->footer_description ?? 'Building Digital Solutions For Your Business. We are a team of talented designers making websites with modern technologies.' }}</p>
                            <div class="flex gap-4">
                                @if($profile->facebook_url) <a href="{{ $profile->facebook_url }}" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></a> @endif
                                @if($profile->twitter_url) <a href="{{ $profile->twitter_url }}" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-sky-400 hover:text-white transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a> @endif
                                @if($profile->linkedin_url) <a href="{{ $profile->linkedin_url }}" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-blue-700 hover:text-white transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a> @endif
                                @if($profile->youtube_url) <a href="{{ $profile->youtube_url }}" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a> @endif
                            </div>
                        </div>
                        <div class="lg:col-span-3 grid grid-cols-2 lg:grid-cols-3 gap-8">
                            <div>
                                <h4 class="text-white text-lg font-bold mb-6">Useful Links</h4>
                                <ul class="space-y-4">
                                    <li><a href="{{ route('home') }}" class="hover:text-blue-500 transition-all flex items-center gap-2 group"><svg class="w-3 h-3 text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Home</a></li>
                                    <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition-all flex items-center gap-2 group"><svg class="w-3 h-3 text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> About Us</a></li>
                                    @if($sectionSettings['services']->is_visible) <li><a href="{{ route('home') }}#services" class="hover:text-blue-500 transition-all flex items-center gap-2 group"><svg class="w-3 h-3 text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Services</a></li> @endif
                                    @if($sectionSettings['portfolio']->is_visible) <li><a href="{{ route('home') }}#portfolio" class="hover:text-blue-500 transition-all flex items-center gap-2 group"><svg class="w-3 h-3 text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Portfolio</a></li> @endif
                                    @if($sectionSettings['team']->is_visible) <li><a href="{{ route('home') }}#team" class="hover:text-blue-500 transition-all flex items-center gap-2 group"><svg class="w-3 h-3 text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Our Team</a></li> @endif
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-white text-lg font-bold mb-6">Our Services</h4>
                                <ul class="space-y-4">
                                    @if($sectionSettings['services']->is_visible)
                                        @foreach($services->take(5) as $s)
                                            <li><a href="{{ route('service.details', $s->id) }}" class="hover:text-blue-500 transition-all flex items-center gap-2 group"><svg class="w-3 h-3 text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> {{ $s->title }}</a></li>
                                        @endforeach
                                    @else
                                        <li class="text-slate-500 italic">Services are hidden</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-span-2 lg:col-span-1">
                                <h4 class="text-white text-lg font-bold mb-6">Contact Info</h4>
                                <ul class="space-y-4 text-slate-400">
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-blue-500 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span>{{ $profile->address ?? 'A108 Adam Street, New York, NY 535022' }}</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <span>{{ $profile->phone ?? '+1 5589 55488 55' }}</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        <span class="break-all">{{ $profile->email ?? 'info@example.com' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-white/5 pt-8 text-center text-sm">
                        <p>{{ $profile->footer_text ?? '© Copyright CoreBiz. All Rights Reserved' }}</p>
                    </div>
                </div>
            </footer>
            @endif


            <!-- Back to top -->
            <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" x-show="scrolled" x-transition class="fixed bottom-8 right-8 bg-blue-600 text-white w-10 h-10 rounded shadow-lg flex items-center justify-center hover:bg-blue-700 hover:-translate-y-1 transition-all z-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
            </button>
        </div>

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed bottom-10 right-10 z-[100] bg-indigo-600 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 transition-all" x-transition:enter="translate-y-20 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="translate-y-10 opacity-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span class="font-bold">{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 opacity-70 hover:opacity-100">&times;</button>
            </div>
        @endif
    </body>
</html>
