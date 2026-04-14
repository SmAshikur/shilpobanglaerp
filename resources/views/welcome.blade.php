@extends('layouts.app')

@section('content')
<div x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 50" class="relative">
    
    <!-- Navigation -->
    <nav 
        :class="scrolled ? 'bg-white/80 backdrop-blur-md shadow-sm border-b' : 'bg-transparent text-white'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-3">
                    @if($profile->logo)
                        <img src="{{ asset('storage/'.$profile->logo) }}" class="h-10 w-auto object-contain">
                    @endif
                    <span :class="scrolled ? 'text-indigo-600' : 'text-white'" class="text-2xl font-bold tracking-tight">
                        {{ $profile->company_name ?? 'Dynamic' }}<span :class="scrolled ? 'text-slate-800' : 'text-indigo-300'">.</span>
                    </span>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-10 text-sm font-medium">
                    <a href="#home" class="hover:text-indigo-500 transition font-bold uppercase tracking-widest text-[11px]">Home</a>
                    <a href="#services" class="hover:text-indigo-500 transition font-bold uppercase tracking-widest text-[11px]">Services</a>
                    <a href="#portfolio" class="hover:text-indigo-500 transition font-bold uppercase tracking-widest text-[11px]">Portfolio</a>
                    <a href="#gallery" class="hover:text-indigo-500 transition font-bold uppercase tracking-widest text-[11px]">Gallery</a>
                    <a href="#about" class="hover:text-indigo-500 transition font-bold uppercase tracking-widest text-[11px]">About</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition shadow-md font-bold uppercase tracking-widest text-[11px]">Dashboard</a>
                    @else
                        <a href="#contact" class="px-5 py-2.5 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition shadow-md font-bold uppercase tracking-widest text-[11px]">Get Started</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-white text-slate-900 border-b">
            <div class="px-4 pt-2 pb-6 space-y-3">
                <a href="#home" class="block px-3 py-2 text-lg font-semibold hover:text-indigo-600 transition">Home</a>
                <a href="#services" class="block px-3 py-2 text-lg font-semibold hover:text-indigo-600 transition">Services</a>
                <a href="#about" class="block px-3 py-2 text-lg font-semibold hover:text-indigo-600 transition">About</a>
                <a href="#team" class="block px-3 py-2 text-lg font-semibold hover:text-indigo-600 transition">Team</a>
                <a href="#contact" class="block px-3 py-2 text-lg font-semibold text-indigo-600">Contact Us</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0 text-center">
            @if($profile->hero_bg)
                <img src="{{ asset('storage/'.$profile->hero_bg) }}" alt="Hero background" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-slate-900"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="max-w-2xl">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-indigo-300 uppercase bg-indigo-500/10 border border-indigo-500/20 rounded-full">
                    Welcome to {{ $profile->company_name ?? 'Dynamic' }}
                </span>
                <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight mb-8">
                    {{ $profile->hero_title ?? 'Elevate Your Digital Presence' }}
                </h1>
                <p class="text-xl text-slate-300 mb-10 leading-relaxed font-light">
                    {{ $profile->hero_subtitle ?? 'Professional solutions for modern businesses looking to scale their digital landscape.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-5">
                    <a href="#contact" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg text-center">Start Your Project</a>
                    <a href="#services" class="px-8 py-4 bg-white/10 text-white backdrop-blur font-bold rounded-xl hover:bg-white/20 transition border border-white/20 text-center">Our Services</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-sm font-bold tracking-[0.2em] text-indigo-600 uppercase mb-4">Our Expertise</h2>
                <h3 class="text-4xl md:text-5xl font-bold text-slate-900">What We Offer</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($services as $service)
                <div class="group p-10 bg-slate-50 border border-slate-100 rounded-3xl hover:bg-white hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-indigo-600/10 text-indigo-600 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-indigo-600 group-hover:text-white transition duration-500 overflow-hidden">
                        @if($service->image)
                            <img src="{{ asset('storage/'.$service->image) }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        @endif
                    </div>
                    <h4 class="text-2xl font-bold text-slate-900 mb-4">{{ $service->title }}</h4>
                    <p class="text-slate-600 leading-relaxed mb-6">{{ $service->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-32 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2 relative">
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl">
                        @if($profile->about_image)
                            <img src="{{ asset('storage/'.$profile->about_image) }}" alt="About our company" class="w-full aspect-[4/3] object-cover">
                        @else
                            <div class="w-full aspect-[4/3] bg-indigo-100"></div>
                        @endif
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-sm font-bold tracking-[0.2em] text-indigo-600 uppercase mb-4">About Us</h2>
                    <h3 class="text-4xl md:text-5xl font-bold text-slate-900 mb-8 leading-tight">We build foundations for your digital future.</h3>
                    <p class="text-lg text-slate-600 mb-10 leading-relaxed">
                        {{ $profile->about_text ?? 'With years of experience in the digital industry, we provide modern solutions to help your business reach its full potential.' }}
                    </p>
                    <div class="grid grid-cols-2 gap-8 mb-12">
                        <div><span class="block text-4xl font-bold text-indigo-600 mb-2">150+</span><span class="text-slate-600 text-sm font-medium">Projects Done</span></div>
                        <div><span class="block text-4xl font-bold text-indigo-600 mb-2">99%</span><span class="text-slate-600 text-sm font-medium">Satisfaction</span></div>
                    </div>
                    <a href="#contact" class="inline-block px-8 py-4 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition shadow-lg">Our Story</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-32 bg-slate-900 overflow-hidden" x-data="{ activeFilter: 'all' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-end justify-between mb-20 gap-8">
                <div class="max-w-xl">
                    <h2 class="text-sm font-bold tracking-[0.2em] text-indigo-400 uppercase mb-4">Portfolio</h2>
                    <h3 class="text-4xl md:text-5xl font-bold text-white leading-tight">Handcrafted digital masterpieces.</h3>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-indigo-600 text-white' : 'bg-white/5 text-slate-400 hover:bg-white/10'" class="px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition">All</button>
                    @foreach($services as $service)
                        <button @click="activeFilter = '{{ $service->title }}'" :class="activeFilter === '{{ $service->title }}' ? 'bg-indigo-600 text-white' : 'bg-white/5 text-slate-400 hover:bg-white/10'" class="px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition">{{ $service->title }}</button>
                    @endforeach
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($portfolios as $project)
                <div x-show="activeFilter === 'all' || activeFilter === '{{ $project->service->title }}'" class="group relative aspect-[4/5] rounded-[2.5rem] overflow-hidden bg-slate-800">
                    @if($project->image)
                        <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-10 translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                        <span class="text-indigo-400 text-xs font-bold uppercase mb-3 block">{{ $project->service->title }}</span>
                        <h4 class="text-2xl font-bold text-white">{{ $project->title }}</h4>
                        <p class="text-slate-400 text-sm mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ Str::limit($project->description, 80) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-sm font-bold tracking-[0.2em] text-indigo-600 uppercase mb-4">Experts</h2>
                <h3 class="text-4xl md:text-5xl font-bold text-slate-900">The Dream Team</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($team as $member)
                <div class="group relative overflow-hidden rounded-[2.5rem] aspect-[4/5] bg-slate-100 shadow-xl transition-all duration-700">
                    @if($member->image)
                        <img src="{{ asset('storage/'.$member->image) }}" alt="{{ $member->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-full p-10 translate-y-10 group-hover:translate-y-0 transition-transform duration-500">
                        <h4 class="text-2xl font-bold text-white mb-1">{{ $member->name }}</h4>
                        <p class="text-indigo-300 font-medium mb-6 uppercase tracking-widest text-xs">{{ $member->position }}</p>
                        <div class="flex gap-4">
                            @if($member->facebook_url) <a href="{{ $member->facebook_url }}" class="text-white hover:text-indigo-400 transition"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a> @endif
                            @if($member->linkedin_url) <a href="{{ $member->linkedin_url }}" class="text-white hover:text-indigo-400 transition"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0z"/></svg></a> @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-32 bg-slate-50" x-data="{ selectedEvent: null, activeTab: 'images' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 text-center">
                <h2 class="text-sm font-bold tracking-[0.2em] text-indigo-600 uppercase mb-4">Gallery</h2>
                <h3 class="text-4xl md:text-5xl font-bold text-slate-900">Moments to Remember</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                <div @click="selectedEvent = {{ $event->toJson() }}; activeTab = 'images'" class="group cursor-pointer relative rounded-[2.5rem] overflow-hidden aspect-video bg-indigo-50 shadow-lg hover:shadow-2xl transition-all duration-500">
                    @if($event->thumbnail)
                        <img src="{{ asset('storage/'.$event->thumbnail) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 w-full p-8 text-white">
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] bg-indigo-600 px-3 py-1 rounded-full mb-3 inline-block">{{ $event->event_date }}</span>
                        <h4 class="text-xl font-bold">{{ $event->title }}</h4>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Modal for Event Media -->
            <template x-if="selectedEvent">
                <div class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                    <div @click="selectedEvent = null" class="absolute inset-0 bg-slate-900/95 backdrop-blur-sm"></div>
                    <div class="relative bg-white w-full max-w-6xl max-h-[90vh] rounded-[3rem] overflow-hidden shadow-2xl flex flex-col">
                        <div class="p-8 border-b flex justify-between items-center bg-slate-50">
                            <h4 class="text-2xl font-bold text-slate-900" x-text="selectedEvent.title"></h4>
                            <button @click="selectedEvent = null" class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-200 transition">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        <div class="flex border-b bg-white">
                            <button @click="activeTab = 'images'" :class="activeTab === 'images' ? 'border-indigo-600 text-indigo-600' : 'text-slate-500'" class="flex-1 py-5 border-b-2 font-bold uppercase tracking-widest text-xs">Images</button>
                            <button @click="activeTab = 'videos'" :class="activeTab === 'videos' ? 'border-indigo-600 text-indigo-600' : 'text-slate-500'" class="flex-1 py-5 border-b-2 font-bold uppercase tracking-widest text-xs">Videos</button>
                        </div>
                        <div class="flex-grow p-8 overflow-y-auto bg-slate-50">
                            <div x-show="activeTab === 'images'" class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                <template x-for="item in selectedEvent.media.filter(m => m.type === 'image')" :key="item.id">
                                    <div class="rounded-2xl overflow-hidden aspect-square bg-white shadow-sm shadow-indigo-100">
                                        <img :src="'/storage/' + item.path" class="w-full h-full object-cover">
                                    </div>
                                </template>
                            </div>
                            <div x-show="activeTab === 'videos'" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <template x-for="item in selectedEvent.media.filter(m => m.type !== 'image')" :key="item.id">
                                    <div class="space-y-4">
                                        <div class="aspect-video rounded-3xl overflow-hidden bg-black">
                                            <template x-if="item.type === 'youtube'">
                                                <iframe :src="item.path" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                                            </template>
                                            <template x-if="item.type === 'video'">
                                                <video :src="'/storage/' + item.path" controls class="w-full h-full object-cover"></video>
                                            </template>
                                        </div>
                                        <h5 class="font-bold text-slate-800" x-text="item.title"></h5>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </section>

    <!-- Review Section -->
    <section id="reviews" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-sm font-bold tracking-[0.2em] text-indigo-600 uppercase mb-4">Feedback</h2>
                <h3 class="text-4xl md:text-5xl font-bold text-slate-900">What Clients Say</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($reviews as $review)
                <div class="bg-slate-50 p-10 rounded-[3rem] border border-slate-100 flex flex-col justify-between hover:bg-white hover:shadow-2xl transition duration-500">
                    <div class="mb-10">
                        <div class="flex gap-1 text-amber-400 mb-6">
                            @for($i=0; $i<$review->rating; $i++) <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg> @endfor
                        </div>
                        <p class="text-lg text-slate-700 italic leading-relaxed">"{{ $review->review_text }}"</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full overflow-hidden">
                            @if($review->client_image)
                                <img src="{{ asset('storage/'.$review->client_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-indigo-600 font-bold uppercase">{{ substr($review->client_name, 0, 1) }}</div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 leading-tight">{{ $review->client_name }}</h4>
                            <p class="text-xs text-slate-500">{{ $review->client_designation }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-indigo-600 rounded-[3rem] overflow-hidden shadow-2xl flex flex-col lg:flex-row relative">
                <div class="lg:w-2/5 p-12 lg:p-20 text-white relative z-10 flex flex-col justify-between">
                    <div>
                        <h2 class="text-sm font-bold tracking-[0.2em] text-indigo-200 uppercase mb-4">Hello!</h2>
                        <h3 class="text-4xl font-bold mb-10">Let's build something epic together.</h3>
                        <div class="space-y-6">
                            <p class="flex items-center gap-4 text-indigo-100 font-medium"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> {{ $profile->email ?? 'test@example.com' }}</p>
                            <p class="flex items-center gap-4 text-indigo-100 font-medium"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> {{ $profile->phone ?? '+123456789' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-12 opacity-50">
                        <a href="#" class="w-10 h-10 border border-white rounded-full flex items-center justify-center hover:bg-white hover:text-indigo-600 transition"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    </div>
                </div>

                <div class="lg:w-3/5 bg-white p-12 lg:p-20">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="text" name="name" required placeholder="Name" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl">
                            <input type="email" name="email" required placeholder="Email" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        </div>
                        <input type="text" name="subject" placeholder="Subject" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <textarea name="message" required rows="4" placeholder="Message" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl"></textarea>
                        <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-xl">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 bg-slate-900 text-white text-center">
        <p class="text-slate-400 font-medium">
            {{ $profile->footer_text ?? ('© ' . date('Y') . ' ' . ($profile->company_name ?? 'Dynamic') . '. All rights reserved.') }}
        </p>
    </footer>
</div>
@endsection
