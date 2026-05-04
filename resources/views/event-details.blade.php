@extends('layouts.app')

@section('content')
<div x-data="{ lightbox: false, lightboxSrc: '', lightboxType: '' }">

    <!-- Page Banner -->
    <div class="relative bg-slate-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-center bg-cover" style="background-image: url('{{ $event->thumbnail ? asset('storage/'.$event->thumbnail) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&q=80' }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-slate-900/90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">{{ $event->title }}</h1>
            <div class="flex justify-center items-center gap-3 text-sm font-medium text-blue-200">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <span>/</span>
                <a href="{{ route('home') }}#events" class="hover:text-white transition">Events</a>
                <span>/</span>
                <span class="text-white">{{ $event->title }}</span>
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
            <div class="grid lg:grid-cols-3 gap-12 items-start">

                <!-- Left: Main Content -->
                <div class="lg:col-span-2">

                    <!-- Thumbnail -->
                    @if($event->thumbnail)
                    <div class="rounded-2xl overflow-hidden shadow-2xl mb-10">
                        <img src="{{ asset('storage/'.$event->thumbnail) }}" class="w-full h-auto object-cover" alt="{{ $event->title }}">
                    </div>
                    @endif

                    <!-- Description -->
                    <div class="prose prose-lg text-slate-600 max-w-none mb-12">
                        <h2 class="text-3xl font-bold text-slate-800 mb-4">{{ $event->title }}</h2>
                        @if($event->description)
                            <p class="leading-relaxed">{!! nl2br(e($event->description)) !!}</p>
                        @endif
                    </div>

                    <!-- Media Gallery -->
                    @if($event->media->count() > 0)
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-2 relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-blue-600">Event Gallery</h3>
                        <p class="text-slate-400 mb-8 text-sm">{{ $event->media->count() }} media items</p>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($event->media as $media)
                                @if($media->type === 'image')
                                <div
                                    @click="lightbox = true; lightboxSrc = '{{ asset('storage/'.$media->path) }}'; lightboxType = 'image'"
                                    class="group relative aspect-square overflow-hidden rounded-xl cursor-pointer bg-slate-100 shadow-sm hover:shadow-lg transition-all duration-300">
                                    <img src="{{ asset('storage/'.$media->path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $media->title }}">
                                    <div class="absolute inset-0 bg-blue-900/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                    </div>
                                    @if($media->title)
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3 translate-y-full group-hover:translate-y-0 transition duration-300">
                                        <p class="text-white text-xs font-semibold truncate">{{ $media->title }}</p>
                                    </div>
                                    @endif
                                </div>

                                @elseif($media->type === 'youtube')
                                <div
                                    @click="lightbox = true; lightboxSrc = '{{ $media->path }}'; lightboxType = 'youtube'"
                                    class="group relative aspect-square overflow-hidden rounded-xl cursor-pointer bg-slate-800 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                                    @php
                                        preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $media->path, $ytMatch);
                                        $ytId = $ytMatch[1] ?? null;
                                    @endphp
                                    @if($ytId)
                                        <img src="https://img.youtube.com/vi/{{ $ytId }}/hqdefault.jpg" class="w-full h-full object-cover opacity-70 group-hover:opacity-90 transition duration-300">
                                    @endif
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                                            <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </div>
                                    @if($media->title)
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                        <p class="text-white text-xs font-semibold truncate">{{ $media->title }}</p>
                                    </div>
                                    @endif
                                </div>

                                @elseif($media->type === 'video')
                                <div class="group relative aspect-square overflow-hidden rounded-xl bg-slate-800 shadow-sm">
                                    <video src="{{ asset('storage/'.$media->path) }}" class="w-full h-full object-cover" controls></video>
                                    @if($media->title)
                                    <div class="p-2 bg-slate-900">
                                        <p class="text-white text-xs font-semibold truncate">{{ $media->title }}</p>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right: Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-slate-50 rounded-2xl p-8 border border-gray-100 shadow-sm sticky top-28">
                        <h3 class="text-xl font-bold text-slate-800 mb-6 relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-blue-600">Event Information</h3>

                        <ul class="space-y-5">
                            @if($event->event_date)
                            <li class="border-b border-gray-200 pb-4">
                                <strong class="block text-slate-500 text-xs uppercase tracking-wider mb-1">Date</strong>
                                <span class="text-slate-800 font-semibold">{{ \Carbon\Carbon::parse($event->event_date)->format('d F, Y') }}</span>
                            </li>
                            @endif
                            <li class="border-b border-gray-200 pb-4">
                                <strong class="block text-slate-500 text-xs uppercase tracking-wider mb-1">Media Items</strong>
                                <span class="text-slate-800 font-semibold">{{ $event->media->count() }} Items</span>
                            </li>
                            <li class="pb-4">
                                <strong class="block text-slate-500 text-xs uppercase tracking-wider mb-1">Posted</strong>
                                <span class="text-slate-800 font-semibold">{{ $event->created_at->format('d M, Y') }}</span>
                            </li>
                        </ul>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('contact.page') }}" class="inline-block w-full bg-blue-600 text-white font-bold py-3 px-6 rounded text-center hover:bg-blue-700 transition shadow-md">Get In Touch</a>
                        </div>
                    </div>

                    <!-- Other Events -->
                    @if($otherEvents->count() > 0)
                    <div class="mt-8 bg-slate-50 rounded-2xl p-8 border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-800 mb-6 relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-blue-600">Other Events</h3>
                        <ul class="space-y-4">
                            @foreach($otherEvents as $other)
                            <li>
                                <a href="{{ route('event.details', $other->id) }}" class="flex items-center gap-4 group">
                                    <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 bg-slate-200">
                                        @if($other->thumbnail)
                                            <img src="{{ asset('storage/'.$other->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800 group-hover:text-blue-600 transition text-sm leading-snug">{{ $other->title }}</p>
                                        @if($other->event_date)
                                            <p class="text-xs text-slate-400 mt-1">{{ \Carbon\Carbon::parse($other->event_date)->format('d M, Y') }}</p>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div x-show="lightbox" x-transition.opacity class="fixed inset-0 bg-black/90 z-[999] flex items-center justify-center p-4" @click.self="lightbox = false" @keydown.escape.window="lightbox = false" style="display:none;">
        <button @click="lightbox = false" class="absolute top-6 right-6 text-white hover:text-blue-400 transition z-10">
            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <template x-if="lightboxType === 'image'">
            <img :src="lightboxSrc" class="max-w-5xl max-h-[85vh] rounded-xl shadow-2xl object-contain">
        </template>
        <template x-if="lightboxType === 'youtube'">
            <iframe :src="'https://www.youtube.com/embed/' + lightboxSrc.match(/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/)?.[1]" class="w-full max-w-4xl aspect-video rounded-xl shadow-2xl" allowfullscreen></iframe>
        </template>
    </div>

</div>
@endsection
