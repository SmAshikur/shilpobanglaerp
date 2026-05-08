@extends('layouts.dashboard')

@section('header', 'Project Details')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ route('dashboard.portfolio') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Portfolio
        </a>
        <div class="flex gap-3">
            <a href="{{ route('dashboard.portfolio.edit', $project) }}" class="px-6 py-2.5 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition shadow-lg shadow-amber-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Edit Project
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
        <div class="grid lg:grid-cols-2">
            <!-- Project Image -->
            <div class="relative bg-slate-100">
                @if($project->image)
                    <img src="{{ asset('storage/'.$project->image) }}" class="w-full h-full object-cover min-h-[400px]">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 min-h-[400px]">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <p class="font-bold mt-4">No Project Image</p>
                    </div>
                @endif
                <!-- Overlay Category -->
                <div class="absolute top-6 left-6 px-6 py-2 bg-white/90 backdrop-blur rounded-2xl shadow-xl border border-white/50">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-0.5">Category</span>
                    <span class="text-sm font-bold text-indigo-600">{{ $project->service->title }}</span>
                </div>
            </div>

            <!-- Project Details -->
            <div class="p-10 lg:p-14">
                <div class="mb-10">
                    <div class="flex gap-2 mb-4">
                        @if($project->is_active)
                            <span class="px-3 py-1 bg-emerald-500 text-white text-[9px] font-black uppercase rounded-lg">Active</span>
                        @else
                            <span class="px-3 py-1 bg-slate-400 text-white text-[9px] font-black uppercase rounded-lg">Inactive</span>
                        @endif
                        @if($project->is_featured)
                            <span class="px-3 py-1 bg-amber-500 text-white text-[9px] font-black uppercase rounded-lg">Featured</span>
                        @endif
                    </div>
                    <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-tight mb-4">{{ $project->title }}</h3>
                    <div class="flex items-center gap-2 text-slate-400 font-bold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Client: <span class="text-slate-700">{{ $project->client_name ?? 'Confidential' }}</span>
                    </div>
                </div>

                <div class="prose prose-slate max-w-none mb-10">
                    <h4 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Description</h4>
                    <p class="text-slate-600 leading-relaxed italic">
                        {!! nl2br(e($project->description)) !!}
                    </p>
                </div>

                @include('dashboard.partials.extra-details', ['model' => $project])

                @if($project->project_url)
                    <div class="pt-8 border-t border-slate-100">
                        <h4 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Project Result</h4>
                        <a href="{{ $project->project_url }}" target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white font-black rounded-2xl hover:bg-black transition shadow-xl shadow-slate-200">
                            View Live Project
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
