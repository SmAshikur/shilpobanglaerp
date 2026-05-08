@extends('layouts.app')

@section('content')

    <!-- Page Header Banner -->
    <div class="relative bg-slate-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-center bg-cover" style="background-image: url('{{ $profile->hero_bg ? asset('storage/'.$profile->hero_bg) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80' }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-slate-900/90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Service Details</h1>
            <div class="flex justify-center items-center gap-3 text-sm font-medium text-blue-200">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <span>/</span>
                <a href="{{ route('home') }}#services" class="hover:text-white transition">Services</a>
                <span>/</span>
                <span class="text-white">{{ $service->title }}</span>
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
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Content Area -->
                <div class="lg:col-span-2">
                    <div class="rounded-2xl overflow-hidden shadow-xl mb-8">
                        @if($service->image)
                            <img src="{{ asset('storage/'.$service->image) }}" class="w-full h-auto object-cover" alt="{{ $service->title }}">
                        @else
                            <!-- Placeholder if no image -->
                            <div class="w-full aspect-video bg-blue-50 flex items-center justify-center">
                                <svg class="w-32 h-32 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                        <h2 class="text-3xl lg:text-4xl font-bold text-slate-800">{{ $service->title }}</h2>
                        @if($service->website_url)
                            <a href="{{ $service->website_url }}" target="_blank" class="inline-flex items-center gap-2 px-8 py-3.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                Visit Live Website
                            </a>
                        @endif
                    </div>
                    
                    <div class="prose prose-lg text-slate-600 max-w-none mb-12">
                        <!-- We use nl2br to preserve line breaks from the textarea -->
                        <p>{!! nl2br(e($service->description)) !!}</p>
                    </div>

                    @if($service->extraDetails->count() > 0)
                    <div class="space-y-10">
                        @foreach($service->extraDetails as $detail)
                        <div class="group">
                            @if($detail->title)
                            <h3 class="text-2xl font-black text-slate-800 mb-4 flex items-center gap-3">
                                <span class="w-8 h-1 bg-blue-600 rounded-full transition-all group-hover:w-16"></span>
                                {{ $detail->title }}
                            </h3>
                            @endif
                            <div class="bg-white p-8 rounded-3xl border border-slate-100 group-hover:shadow-2xl group-hover:shadow-blue-100/50 transition-all duration-500">
                                <p class="text-slate-600 leading-relaxed">
                                    {!! nl2br(e($detail->description)) !!}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Other Services Widget -->
                    <div class="bg-slate-50 rounded-xl p-8 border border-gray-100 shadow-sm">
                        <h4 class="text-xl font-bold text-slate-800 mb-6 relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-blue-600">Other Services</h4>
                        <ul class="space-y-3">
                            @foreach($services as $s)
                            <li>
                                <a href="{{ route('service.details', $s->id) }}" class="flex items-center justify-between p-3 rounded transition-all duration-300 {{ $s->id == $service->id ? 'bg-blue-600 text-white font-semibold' : 'bg-white text-slate-600 hover:text-blue-600 hover:shadow' }}">
                                    <span>{{ $s->title }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Contact Widget -->
                    <div class="bg-blue-600 rounded-xl p-8 text-center text-white shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHBhdGggZD0iTTIwIDBoMjB2MjBIMjB6TTAgMjBoMjB2MjBIMHoiIGZpbGw9IiNmZmYiIGZpbGwtcnVsZT0iZXZlbm9kZCIgZmlsbC1vcGFjaXR5PSIuMSIvPjwvc3ZnPg==')]"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <h4 class="text-xl font-bold mb-2">Need Help?</h4>
                            <p class="text-blue-100 mb-6 text-sm">Contact us directly and we'll help you find the right solution.</p>
                            <p class="text-2xl font-bold mb-6">{{ $profile->phone ?? '+1 5589 55488 55' }}</p>
                            <a href="{{ route('contact.page') }}" class="inline-block w-full bg-white text-blue-600 font-bold py-3 rounded hover:bg-slate-50 transition shadow">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- More Services Section -->
    @if(isset($otherServices) && $otherServices->count() > 0)
    <section class="py-16 bg-slate-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">More Services</h3>
                    <div class="w-12 h-1 bg-blue-600 rounded mt-2"></div>
                </div>
                <a href="{{ route('home') }}#services" class="hidden sm:flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-800 transition">View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherServices as $s)
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                        @if($s->image)
                            <img src="{{ asset('storage/'.$s->image) }}" class="w-7 h-7 object-contain filter group-hover:brightness-0 group-hover:invert">
                        @else
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        @endif
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition">{{ $s->title }}</h4>
                    <p class="text-slate-600 text-sm mb-4">{{ Str::limit($s->description, 80) }}</p>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('service.details', $s->id) }}" class="text-blue-600 font-semibold text-sm hover:underline flex items-center gap-1">Details <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                        @if($s->website_url)
                            <a href="{{ $s->website_url }}" target="_blank" class="text-xs font-bold text-slate-400 hover:text-blue-600 transition flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                Live Site
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8 sm:hidden text-center">
                <a href="{{ route('home') }}#services" class="inline-flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-800 transition">View All Services <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>
        </div>
    </section>
    @endif

@endsection
