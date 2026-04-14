@extends('layouts.dashboard')

@section('header', 'Portfolio Projects')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
    <!-- Add Project Form -->
    <div class="lg:col-span-1">
        <div class="bg-white p-10 rounded-[2rem] border border-slate-100 shadow-xl sticky top-8">
            <h3 class="text-xl font-bold text-indigo-900 mb-8 flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                New Project
            </h3>
            
            <form action="{{ route('dashboard.portfolio') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Project Image</label>
                    <input type="file" name="image_file" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Project Title</label>
                    <input type="text" name="title" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition" placeholder="App Design">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Service Category</label>
                    <select name="service_id" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Project URL</label>
                    <input type="url" name="project_url" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Description</label>
                    <textarea name="description" rows="3" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/20">Add Project</button>
            </form>
        </div>
    </div>

    <!-- Projects List -->
    <div class="lg:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            @foreach($portfolios as $project)
            <div class="bg-white p-4 rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                <div class="aspect-video w-full bg-slate-50 rounded-[2rem] overflow-hidden mb-6">
                    @if($project->image)
                        <img src="{{ asset('storage/'.$project->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-indigo-300 font-bold uppercase tracking-widest bg-indigo-50">No Image</div>
                    @endif
                </div>
                <div class="px-6 flex-grow">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="px-3 py-1 bg-indigo-600 text-white text-[10px] font-bold rounded-full uppercase tracking-widest">{{ $project->service->title }}</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">{{ $project->title }}</h4>
                </div>
                <div class="px-6 pb-6 pt-4 border-t border-slate-50 flex items-center justify-between">
                     <span class="text-[10px] font-bold tracking-widest text-slate-300 uppercase">Created {{ $project->created_at->diffForHumans() }}</span>
                    <form action="{{ route('dashboard.portfolio.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition group-hover:shadow-lg transition duration-500" onclick="return confirm('Wait! are you sure?')">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
