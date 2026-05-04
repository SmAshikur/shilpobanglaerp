@extends('layouts.dashboard')

@section('header', 'Portfolio Projects')

@section('content')
<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Project Showcase</h3>
            <p class="text-sm text-slate-500">Manage and display your best work to potential clients</p>
        </div>
        <a href="{{ route('dashboard.portfolio.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Add New Project
        </a>
    </div>

    <!-- Portfolio Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($portfolios as $project)
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-2xl transition-all duration-500">
            <div class="relative aspect-video overflow-hidden">
                @if($project->image)
                    <img src="{{ asset('storage/'.$project->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                    </div>
                @endif
                <!-- Service Badge -->
                <div class="absolute top-6 left-6">
                    <span class="px-4 py-2 bg-white/90 backdrop-blur text-indigo-700 text-[10px] font-black uppercase tracking-widest rounded-full shadow-sm">
                        {{ $project->service->title ?? 'General' }}
                    </span>
                </div>
                <!-- Delete Button (Overlay) -->
                <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity">
                    <form action="{{ route('dashboard.portfolio.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-rose-500 text-white rounded-xl flex items-center justify-center shadow-lg hover:bg-rose-600 transition" onclick="return confirm('Remove project from portfolio?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-8">
                <h4 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-indigo-600 transition">{{ $project->title }}</h4>
                <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed mb-6">{{ $project->description }}</p>
                
                <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-600">{{ $project->client_name ?? 'Confidential' }}</span>
                    </div>
                    @if($project->project_url)
                    <a href="{{ $project->project_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-[2rem] p-20 text-center border border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
            </div>
            <h4 class="text-lg font-bold text-slate-800">No Projects Found</h4>
            <p class="text-sm text-slate-500 mt-1">Start building your portfolio by adding your successfully completed projects.</p>
            <a href="{{ route('dashboard.portfolio.create') }}" class="mt-6 inline-block px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">Add Project Now</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
