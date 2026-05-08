@extends('layouts.dashboard')

@section('header', 'Service Details')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ route('dashboard.services') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Services
        </a>
        <div class="flex gap-3">
            <a href="{{ route('dashboard.services.edit', $service) }}" class="px-6 py-2.5 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition shadow-lg shadow-amber-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Edit
            </a>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <!-- Main Content Card -->
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
                @if($service->image)
                    <div class="h-80 overflow-hidden">
                        <img src="{{ asset('storage/'.$service->image) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="p-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                            @if($service->icon)
                                <i class="fa fa-{{ $service->icon }} text-2xl"></i>
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            @endif
                        </div>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $service->title }}</h3>
                    </div>
                    
                    <div class="prose prose-slate max-w-none">
                        <p class="text-slate-600 leading-relaxed text-lg">
                            {!! nl2br(e($service->description)) !!}
                        </p>
                    </div>

                    @include('dashboard.partials.extra-details', ['model' => $service])
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-8">
            <!-- Status Card -->
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-indigo-100/30">
                <h4 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Visibility Info</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                        <span class="text-sm font-bold text-slate-600">Active Status</span>
                        @if($service->is_active)
                            <span class="px-3 py-1 bg-emerald-500 text-white text-[10px] font-black uppercase rounded-lg">Live</span>
                        @else
                            <span class="px-3 py-1 bg-slate-400 text-white text-[10px] font-black uppercase rounded-lg">Hidden</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                        <span class="text-sm font-bold text-slate-600">Landing Page</span>
                        @if($service->is_featured)
                            <span class="px-3 py-1 bg-amber-500 text-white text-[10px] font-black uppercase rounded-lg">Featured</span>
                        @else
                            <span class="px-3 py-1 bg-slate-200 text-slate-500 text-[10px] font-black uppercase rounded-lg">Standard</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($service->website_url)
            <!-- Link Card -->
            <div class="bg-indigo-600 rounded-[2.5rem] p-8 text-white shadow-xl shadow-indigo-200">
                <h4 class="text-sm font-black text-indigo-200 uppercase tracking-[0.2em] mb-6">Live Preview</h4>
                <p class="text-sm text-indigo-100 mb-6">This service is linked to an external website or showcase.</p>
                <a href="{{ $service->website_url }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-4 bg-white text-indigo-600 font-black rounded-2xl hover:bg-indigo-50 transition">
                    Visit Website
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
