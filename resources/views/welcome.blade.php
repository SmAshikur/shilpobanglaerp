@extends('layouts.app')

@section('content')
    <div x-data="{ activeFilter: 'all' }" class="font-sans text-slate-600 dark:text-slate-400">

        <!-- Hero Section -->
        @if($sectionSettings->get('hero')?->is_visible ?? true)
            <section id="hero" class="relative bg-slate-50 dark:bg-slate-950 py-20 lg:py-32 overflow-hidden transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <!-- Text Content -->
                        <div class="text-center lg:text-left z-10">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-800 dark:text-white leading-tight mb-6">
                                {{ $sectionSettings->get('hero')?->title ?? ($profile->hero_title ?? 'Building Digital Solutions For Your Business') }}
                            </h1>
                            <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto lg:mx-0">
                                {{ $sectionSettings->get('hero')?->description ?? ($profile->hero_subtitle ?? 'We are a team of talented designers making websites with modern technologies.') }}
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <a href="{{ route('login') }}"
                                    class="bg-blue-600 text-white px-8 py-3.5 rounded hover:bg-blue-700 transition font-semibold text-sm shadow-md">Get
                                    Started</a>
                                <a href="#"
                                    class="flex items-center justify-center gap-2 text-slate-800 hover:text-blue-600 transition font-semibold text-sm px-8 py-3.5">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Watch Video
                                </a>
                            </div>
                        </div>
                        <!-- Image Content -->
                        <div class="relative z-10 flex justify-center lg:justify-end">
                            @if($profile->hero_bg)
                                <img src="{{ asset('storage/' . $profile->hero_bg) }}"
                                    class="w-full max-w-lg rounded-2xl shadow-2xl animate-[wiggle_4s_ease-in-out_infinite] object-cover"
                                    alt="Hero Image">
                            @else
                                <!-- Placeholder Illustration -->
                                <div
                                    class="w-full max-w-lg h-96 bg-blue-100 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-32 h-32 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Decorative Shapes (CoreBiz style) -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-50 dark:bg-blue-500/5 opacity-50 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 rounded-full bg-indigo-50 dark:bg-indigo-500/5 opacity-50 blur-3xl">
                </div>
            </section>
        @endif

        <!-- Client / Brands (Optional) -->
        <section class="py-10 border-b border-gray-100 dark:border-white/5 bg-white dark:bg-slate-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                    <span class="text-2xl font-black text-slate-400 dark:text-slate-600">CLIENT<span class="text-blue-500">1</span></span>
                    <span class="text-2xl font-black text-slate-400 dark:text-slate-600">BRAND<span class="text-blue-500">2</span></span>
                    <span class="text-2xl font-black text-slate-400 dark:text-slate-600">COMPANY<span class="text-blue-500">3</span></span>
                    <span class="text-2xl font-black text-slate-400 dark:text-slate-600">PARTNER<span class="text-blue-500">4</span></span>
                    <span class="text-2xl font-black text-slate-400 dark:text-slate-600">STUDIO<span class="text-blue-500">5</span></span>
                </div>
            </div>
        </section>

        <!-- About Section -->
        @if($sectionSettings->get('about')?->is_visible ?? true)
            <section id="about" class="py-20 bg-white dark:bg-slate-900 transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-4">{{ $sectionSettings->get('about')?->title ?? 'About Us' }}
                        </h2>
                        <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
                        <p class="mt-4 text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                            {{ $sectionSettings->get('about')?->description ?? 'Discover our journey, our mission, and the core values that drive us to deliver exceptional results.' }}
                        </p>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="order-2 lg:order-1 relative">
                            @if($profile->about_image)
                                <img src="{{ asset('storage/' . $profile->about_image) }}" class="w-full rounded shadow-xl"
                                    alt="About Us">
                            @else
                                <div class="w-full aspect-[4/3] bg-gray-200 rounded shadow-xl flex items-center justify-center">
                                    <span class="text-gray-400">About Image</span>
                                </div>
                            @endif
                            <!-- Video Play Button Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <a href="#"
                                    class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-blue-700 transition animate-pulse">
                                    <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="order-1 lg:order-2">
                            <div class="prose dark:prose-invert text-slate-600 dark:text-slate-400 mb-6 leading-relaxed">
                                {!! nl2br(e($profile->about_text ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.')) !!}
                            </div>
                            <a href="{{ route('about') }}"
                                class="inline-block px-8 py-3 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition shadow-md">Read
                                More</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Services Section -->
        @if($sectionSettings->get('services')?->is_visible ?? true)
            <section id="services" class="py-20 bg-slate-50 dark:bg-slate-950 transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-4">
                            {{ $sectionSettings->get('services')?->title ?? 'Services' }}</h2>
                        <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
                        <p class="mt-4 text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                            {{ $sectionSettings->get('services')?->description ?? 'Explore our wide range of professional services designed to help your business grow and succeed.' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-8">
                        @foreach($services as $index => $service)
                            <div
                                class="w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.34rem)] bg-white dark:bg-slate-900 p-10 rounded shadow-sm hover:shadow-xl transition-all duration-300 border-b-4 border-transparent hover:border-blue-600 group">
                                <div
                                    class="w-16 h-16 bg-blue-50 dark:bg-white/5 text-blue-600 dark:text-blue-400 rounded flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}"
                                            class="w-8 h-8 object-contain filter group-hover:brightness-0 group-hover:invert">
                                    @else
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-blue-600 transition">
                                    {{ $service->title }}</h4>
                                <p class="text-slate-600 mb-4">{{ Str::limit($service->description, 100) }}</p>
                                <div class="flex items-center justify-between mt-auto">
                                    <a href="{{ route('service.details', $service->id) }}"
                                        class="text-blue-600 dark:text-blue-400 font-bold text-xs hover:underline flex items-center gap-1 uppercase tracking-wider">
                                        Details
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    @if($service->website_url)
                                        <a href="{{ $service->website_url }}" target="_blank"
                                            class="px-4 py-2 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 font-bold text-[10px] rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 uppercase tracking-widest flex items-center gap-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                            Visit Site
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Stats / Counters Section -->
        @if($sectionSettings->get('stats')?->is_visible ?? true)
            <section id="stats" class="py-24 relative overflow-hidden bg-slate-900">
                <!-- Animated Background Elements -->
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                    <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[60%] bg-blue-600/20 blur-[120px] rounded-full"></div>
                    <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[60%] bg-indigo-600/20 blur-[120px] rounded-full">
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-white">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-black mb-4 tracking-tight">
                            {{ $sectionSettings->get('stats')?->title ?? 'Our Achievement' }}</h2>
                        <div class="w-16 h-1.5 bg-blue-500 mx-auto rounded-full"></div>
                        @if($sectionSettings->get('stats')?->description)
                            <p class="mt-6 text-slate-400 max-w-2xl mx-auto font-medium">
                                {{ $sectionSettings->get('stats')?->description }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                        <!-- Stat Item -->
                        <div
                            class="group p-8 rounded-[2.5rem] bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-500 text-center">
                            <div
                                class="w-14 h-14 bg-blue-600/20 text-blue-400 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-4xl md:text-5xl font-black block mb-2 tracking-tighter">{{ $profile->stat_clients ?? '232' }}</span>
                            <span
                                class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400 group-hover:text-blue-400 transition-colors">Happy
                                Clients</span>
                        </div>

                        <!-- Stat Item -->
                        <div
                            class="group p-8 rounded-[2.5rem] bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-500 text-center">
                            <div
                                class="w-14 h-14 bg-indigo-600/20 text-indigo-400 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01" />
                                </svg>
                            </div>
                            <span
                                class="text-4xl md:text-5xl font-black block mb-2 tracking-tighter">{{ $profile->stat_projects ?? '521' }}</span>
                            <span
                                class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400 group-hover:text-indigo-400 transition-colors">Projects
                                Done</span>
                        </div>

                        <!-- Stat Item -->
                        <div
                            class="group p-8 rounded-[2.5rem] bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-500 text-center">
                            <div
                                class="w-14 h-14 bg-emerald-600/20 text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-4xl md:text-5xl font-black block mb-2 tracking-tighter">{{ $profile->stat_hours ?? '1,453' }}</span>
                            <span
                                class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400 group-hover:text-emerald-400 transition-colors">Support
                                Hours</span>
                        </div>

                        <!-- Stat Item -->
                        <div
                            class="group p-8 rounded-[2.5rem] bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-500 text-center">
                            <div
                                class="w-14 h-14 bg-rose-600/20 text-rose-400 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span
                                class="text-4xl md:text-5xl font-black block mb-2 tracking-tighter">{{ $profile->stat_workers ?? '32' }}</span>
                            <span
                                class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400 group-hover:text-rose-400 transition-colors">Hard
                                Workers</span>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Portfolio Section -->
        @if($sectionSettings->get('portfolio')?->is_visible ?? true)
            <section id="portfolio" class="py-20 bg-white dark:bg-slate-950 transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-4">
                            {{ $sectionSettings->get('portfolio')?->title ?? 'Portfolio' }}</h2>
                        <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
                        <p class="mt-4 text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                            {{ $sectionSettings->get('portfolio')?->description ?? 'Take a look at some of our recent work and successful projects.' }}
                        </p>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-wrap justify-center gap-3 mb-12">
                        <button @click="activeFilter = 'all'"
                            :class="activeFilter === 'all' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20 dark:shadow-none' : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400'"
                            class="px-5 py-2 rounded-full font-medium text-sm transition shadow-sm border border-gray-100 dark:border-white/5">All</button>
                        @foreach($services as $service)
                            <button @click="activeFilter = '{{ $service->title }}'"
                                :class="activeFilter === '{{ $service->title }}' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20 dark:shadow-none' : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400'"
                                class="px-5 py-2 rounded-full font-medium text-sm transition shadow-sm border border-gray-100 dark:border-white/5">{{ $service->title }}</button>
                        @endforeach
                    </div>

                    <!-- Grid -->
                    <div class="flex flex-wrap justify-center gap-6">
                        @foreach($portfolios as $project)
                            <div x-show="activeFilter === 'all' || activeFilter === '{{ $project->service->title }}'"
                                class="w-full md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] group relative overflow-hidden rounded shadow-sm aspect-[4/3] bg-slate-100">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}"
                                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                                        alt="{{ $project->title }}">
                                @endif
                                <!-- Overlay -->
                                <div
                                    class="absolute inset-0 bg-blue-900/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center text-center p-6">
                                    <a href="{{ route('portfolio.details', $project->id) }}">
                                        <h4
                                            class="text-xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition duration-300 hover:text-blue-200">
                                            {{ $project->title }}</h4>
                                    </a>
                                    <span
                                        class="text-blue-200 text-sm translate-y-4 group-hover:translate-y-0 transition duration-300 delay-75">{{ $project->service->title }}</span>
                                    <div
                                        class="flex gap-3 mt-6 opacity-0 group-hover:opacity-100 transition duration-300 delay-150">
                                        @if($project->image)
                                            <a href="{{ asset('storage/' . $project->image) }}" target="_blank"
                                                class="w-10 h-10 bg-white text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><svg
                                                    class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg></a>
                                        @endif
                                        <a href="{{ route('portfolio.details', $project->id) }}"
                                            class="w-10 h-10 bg-white text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><svg
                                                class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 10-5.656-5.656l-1.1 1.1" />
                                            </svg></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Team Section -->
        @if($sectionSettings->get('team')?->is_visible ?? true)
            <section id="team" class="py-20 bg-slate-50 dark:bg-slate-900 transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-4">{{ $sectionSettings->get('team')?->title ?? 'Team' }}</h2>
                        <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
                        <p class="mt-4 text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
                            {{ $sectionSettings->get('team')?->description ?? 'Meet our experienced and dedicated team of professionals.' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-8">
                        @foreach($team as $member)
                            <div
                                class="w-full sm:w-[calc(50%-1rem)] lg:w-[calc(25%-1.5rem)] bg-white dark:bg-slate-950 rounded shadow-sm overflow-hidden group hover:shadow-xl transition-shadow border border-transparent dark:border-white/5">
                                <div class="relative overflow-hidden aspect-square">
                                    @if($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}"
                                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                                            alt="{{ $member->name }}">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @endif
                                    <!-- Social Overlay -->
                                    <div
                                        class="absolute inset-x-0 bottom-0 bg-white/90 dark:bg-slate-900/90 backdrop-blur py-3 flex justify-center gap-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                                        @if($member->facebook_url) <a href="{{ $member->facebook_url }}"
                                            class="text-slate-400 hover:text-blue-600"><svg class="w-5 h-5 fill-current"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg></a> @endif
                                        @if($member->linkedin_url) <a href="{{ $member->linkedin_url }}"
                                            class="text-slate-400 hover:text-blue-600"><svg class="w-5 h-5 fill-current"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0z" />
                                        </svg></a> @endif
                                    </div>
                                </div>
                                <div class="p-6 text-center">
                                    <a href="{{ route('team.details', $member->id) }}">
                                        <h4 class="text-lg font-bold text-slate-800 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition">
                                            {{ $member->name }}</h4>
                                    </a>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 mb-3">{{ $member->position }}</p>
                                    <a href="{{ route('team.details', $member->id) }}"
                                        class="text-xs font-semibold text-blue-600 hover:underline uppercase tracking-wider">View
                                        Profile</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </section>
        @endif

        <!-- Testimonials / Reviews Section -->
        @if($sectionSettings->get('reviews')?->is_visible ?? true)
            <section id="reviews" class="py-20 bg-blue-600 relative overflow-hidden">
                <!-- Decorative Background -->
                <div
                    class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTIwIDBoMjB2MjBIMjB6TTAgMjBoMjB2MjBIMHoiIGZpbGw9IiNmZmYiIGZpbGwtcnVsZT0iZXZlbm9kZCIgZmlsbC1vcGFjaXR5PSIuMSIvPjwvc3ZnPg==')]">
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-white mb-4">
                            {{ $sectionSettings->get('reviews')?->title ?? 'What Our Clients Say' }}</h2>
                        <div class="w-16 h-1 bg-blue-300 mx-auto rounded"></div>
                        <p class="mt-4 text-blue-100 max-w-2xl mx-auto">
                            {{ $sectionSettings->get('reviews')?->description ?? 'Discover why businesses trust us to deliver exceptional results and outstanding service.' }}
                        </p>
                    </div>

                    @if($reviews->count() > 0)
                        <div x-data="{ 
                                activeSlide: 0, 
                                totalSlides: {{ $reviews->count() }},
                                next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides; },
                                prev() { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides; },
                                init() { setInterval(() => { this.next(); }, 5000); }
                            }" class="relative max-w-4xl mx-auto mt-12 px-4 md:px-12">

                            <div class="overflow-hidden relative rounded-2xl pb-4">
                                <div class="flex transition-transform duration-700 ease-in-out"
                                    :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                                    @foreach($reviews as $review)
                                        <div class="w-full flex-shrink-0 px-2">
                                            <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 md:p-12 shadow-xl dark:shadow-none relative mt-6 text-center">
                                                <!-- Quote Icon -->
                                                <div
                                                    class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white border-4 border-white dark:border-slate-900 shadow-sm">
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                        <path
                                                            d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                                    </svg>
                                                </div>

                                                <div class="flex items-center justify-center gap-1 mb-6 text-yellow-400">
                                                    @for($i = 0; $i < 5; $i++)
                                                        @if($i < $review->rating)
                                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-5 h-5 text-gray-200 fill-current" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>

                                                <p class="text-slate-600 dark:text-slate-300 text-lg md:text-xl italic mb-8 leading-relaxed">
                                                    "{!! nl2br(e($review->review_text)) !!}"</p>

                                                <div class="flex flex-col items-center justify-center">
                                                    @if($review->client_image)
                                                        <img src="{{ asset('storage/' . $review->client_image) }}"
                                                            alt="{{ $review->client_name }}"
                                                            class="w-16 h-16 rounded-full object-cover shadow-md mb-3">
                                                    @else
                                                        <div
                                                            class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl mb-3">
                                                            {{ substr($review->client_name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <h4 class="font-bold text-slate-800 dark:text-white text-lg">{{ $review->client_name }}</h4>
                                                    @if($review->client_designation)
                                                        <p class="text-sm text-blue-600 dark:text-blue-400 font-medium mt-1">{{ $review->client_designation }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Controls -->
                            <button @click="prev()"
                                class="absolute top-1/2 left-0 md:left-4 -translate-y-1/2 w-12 h-12 bg-white text-blue-600 rounded-full shadow-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition z-10 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button @click="next()"
                                class="absolute top-1/2 right-0 md:right-4 -translate-y-1/2 w-12 h-12 bg-white text-blue-600 rounded-full shadow-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition z-10 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Dots -->
                            <div class="flex justify-center gap-2 mt-6">
                                <template x-for="i in totalSlides" :key="i">
                                    <button @click="activeSlide = i - 1"
                                        :class="activeSlide === i - 1 ? 'w-8 bg-blue-100' : 'w-2 bg-blue-400 hover:bg-blue-300'"
                                        class="h-2 rounded-full transition-all duration-300 focus:outline-none"></button>
                                </template>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-blue-100 italic">
                            No reviews available at the moment.
                        </div>
                    @endif
            </section>
        @endif

        <!-- Latest Events Section -->
        @if($sectionSettings->get('events')?->is_visible ?? true)
            <section id="events" class="py-20 bg-slate-50 dark:bg-slate-950 border-t border-slate-100 dark:border-white/5 transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-end mb-16">
                        <div>
                            <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-4">
                                {{ $sectionSettings->get('events')?->title ?? 'Latest Events & Highlights' }}</h2>
                            <div class="w-16 h-1 bg-blue-600 rounded"></div>
                            <p class="mt-4 text-slate-500 dark:text-slate-400 max-w-2xl">
                                {{ $sectionSettings->get('events')?->description ?? 'Stay updated with our latest company events, workshops, and milestones.' }}
                            </p>
                        </div>
                    </div>

                    @if($events->count() > 0)
                        <div class="flex flex-wrap justify-center gap-8">
                            @foreach($events->take(3) as $event)
                                <div
                                    class="w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.34rem)] bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-white/5 group">
                                    <div class="relative overflow-hidden aspect-[16/10]">
                                        @if($event->thumbnail)
                                            <img src="{{ asset('storage/' . $event->thumbnail) }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                                alt="{{ $event->title }}">
                                        @else
                                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute top-4 left-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur px-3 py-2 rounded-lg shadow-sm text-center">
                                            @if($event->event_date)
                                                <span
                                                    class="block text-xl font-black text-blue-600 dark:text-blue-400 leading-none">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                                <span
                                                    class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mt-1">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                                            @else
                                                <span class="block text-sm font-bold text-slate-500 uppercase tracking-wider">TBA</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="p-8">
                                        <h4 class="text-xl font-bold text-slate-800 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                            {{ $event->title }}</h4>
                                        <p class="text-slate-500 dark:text-slate-400 mb-6 line-clamp-3">{{ $event->description }}</p>

                                        <div class="flex items-center justify-between border-t border-slate-50 dark:border-white/5 pt-4">
                                            <span class="text-sm font-semibold text-slate-400 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $event->media->count() }} Media
                                            </span>
                                            <a href="{{ route('event.details', $event->id) }}"
                                                class="text-sm font-bold text-blue-600 flex items-center gap-1 hover:text-blue-800 transition">
                                                View Details <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-slate-500 font-medium">No events have been posted yet.</p>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <!-- Contact Section -->
        @if($sectionSettings->get('contact')?->is_visible ?? true)
            <section id="contact" class="py-24 bg-white dark:bg-slate-950 relative overflow-hidden transition-colors duration-500">
                <!-- Subtle Background Pattern -->
                <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] dark:opacity-[0.05] pointer-events-none"
                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCI+PHBhdGggZD0iTTMwIDBMMzAgNjBNMCAzMEw2MCAzMCIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEiLz48L3N2Zz4=')">
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-20">
                        <span
                            class="inline-block px-4 py-1.5 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Get
                            In Touch</span>
                        <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-6">
                            {{ $sectionSettings->get('contact')?->title ?? 'Contact Us' }}</h2>
                        <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
                        <p class="mt-6 text-slate-500 dark:text-slate-400 text-lg max-w-2xl mx-auto font-medium">
                            {{ $sectionSettings->get('contact')?->description ?? 'We are here to help and answer any question you might have. We look forward to hearing from you.' }}
                        </p>
                    </div>

                    <!-- Centered Map -->
                    <div
                        class="mb-20 max-w-5xl mx-auto h-[450px] bg-slate-100 dark:bg-slate-900 rounded-[3rem] overflow-hidden shadow-2xl dark:shadow-none border-8 border-white dark:border-slate-800 relative group">
                        @if($profile->google_map_url)
                            @if(str_contains($profile->google_map_url, '<iframe'))
                                {!! $profile->google_map_url !!}
                            @else
                                <iframe
                                    class="w-full h-full grayscale-[0.5] group-hover:grayscale-0 transition-all duration-1000 scale-105 group-hover:scale-100"
                                    src="{{ $profile->google_map_url }}"
                                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            @endif
                        @else
                            <iframe
                                class="w-full h-full grayscale-[0.5] group-hover:grayscale-0 transition-all duration-1000 scale-105 group-hover:scale-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9024424301355!2d90.3912033!3d23.7508665!2m3!1f0!2f0!3f0!3m2!i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8bd55555555%3A0x1234567890abcdef!2sDhaka!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd"
                                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        @endif
                        <div class="absolute inset-0 pointer-events-none shadow-[inset_0_0_100px_rgba(0,0,0,0.1)]"></div>
                    </div>

                    <div class="grid lg:grid-cols-12 gap-16 items-start">
                        <!-- Contact Info Cards -->
                        <div class="lg:col-span-4 space-y-8">
                             <div
                                class="p-8 bg-slate-50 dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 hover:border-blue-200 dark:hover:border-blue-500/30 transition-all duration-500 group">
                                <div
                                    class="w-16 h-16 bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition duration-500 transform group-hover:rotate-6">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h4 class="font-black text-slate-900 dark:text-white text-xl mb-3 tracking-tight">Our Headquarters</h4>
                                <p class="text-slate-500 dark:text-slate-400 leading-relaxed font-medium">
                                    {{ $profile->address ?? 'A108 Adam Street, New York, NY 535022' }}</p>
                            </div>

                            <div
                                class="p-8 bg-slate-900 rounded-[2rem] text-white shadow-xl shadow-slate-200 relative overflow-hidden group">
                                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600 rounded-full blur-3xl opacity-20">
                                </div>
                                <div
                                    class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-blue-600/20 transform group-hover:-rotate-6 transition duration-500">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h4 class="font-black text-white text-xl mb-3 tracking-tight">Quick Connect</h4>
                                <div class="space-y-2">
                                    <p class="text-slate-400 font-medium break-all">{{ $profile->email ?? 'info@example.com' }}
                                    </p>
                                    <p class="text-slate-400 font-medium">{{ $profile->phone ?? '+1 5589 55488 55' }}</p>
                                </div>
                            </div>

                            @if(isset($referenceProject) && $referenceProject)
                                <div
                                    class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-blue-200 relative overflow-hidden group">
                                    <div class="absolute top-0 right-0 p-4 opacity-10">
                                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-xl mb-4 relative z-10">Inquiry Reference</h4>
                                    <div
                                        class="flex items-center gap-5 relative z-10 bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20">
                                        @if($referenceProject->image)
                                            <img src="{{ asset('storage/' . $referenceProject->image) }}"
                                                class="w-20 h-20 rounded-xl object-cover shadow-lg border-2 border-white/30">
                                        @endif
                                        <div>
                                            <h5 class="font-bold text-white text-lg">{{ $referenceProject->title }}</h5>
                                            <p class="text-blue-100 text-sm mt-1">Ref ID: #PRJ-{{ $referenceProject->id }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Contact Form -->
                        <div class="lg:col-span-8">
                            <div
                                class="bg-white dark:bg-slate-900 p-8 md:p-14 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl dark:shadow-none shadow-slate-200/50">
                                <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                                    @csrf
                                    <div class="grid md:grid-cols-2 gap-8">
                                        <div class="space-y-2">
                                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Your
                                                Full Name</label>
                                            <input type="text" name="name" required placeholder="e.g. John Doe"
                                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-950 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium dark:text-white">
                                        </div>
                                        <div class="space-y-2">
                                            <label
                                                class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email
                                                Address</label>
                                            <input type="email" name="email" required placeholder="e.g. john@example.com"
                                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-950 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium dark:text-white">
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Message
                                            Subject</label>
                                        @php
                                            $defaultSubject = isset($referenceProject) && $referenceProject ? "Discussing similar project: " . $referenceProject->title : "";
                                        @endphp
                                        <input type="text" name="subject" value="{{ $defaultSubject }}" required
                                            placeholder="What are you inquiring about?"
                                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-950 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium dark:text-white">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Detailed
                                            Message</label>
                                        <textarea name="message" rows="5" required placeholder="Write your message here..."
                                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-950 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium resize-none dark:text-white"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white font-black py-5 rounded-2xl hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-blue-600/25 dark:shadow-none flex items-center justify-center gap-3 group">
                                        <span class="tracking-widest uppercase text-sm">Send Your Message</span>
                                        <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection