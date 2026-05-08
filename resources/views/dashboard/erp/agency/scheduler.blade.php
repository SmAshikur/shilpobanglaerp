@extends('layouts.dashboard')

@section('header', 'Social Scheduler')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Content Calendar</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Schedule and track performance across platforms</p>
        </div>
        <button onclick="document.getElementById('addPostModal').showModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Schedule Post
        </button>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        @forelse($posts as $post)
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none flex items-start gap-6 relative group overflow-hidden">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 dark:bg-white/5 flex flex-col items-center justify-center shrink-0 border border-slate-100 dark:border-white/5">
                <span class="text-xs font-black text-slate-400 uppercase">{{ date('M', strtotime($post->schedule_date)) }}</span>
                <span class="text-2xl font-black text-slate-800 dark:text-white">{{ date('d', strtotime($post->schedule_date)) }}</span>
            </div>
            
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <span class="px-2 py-0.5 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 rounded text-[10px] font-black uppercase tracking-widest">{{ $post->platform }}</span>
                    <span class="text-[10px] font-bold text-slate-400">{{ $post->status }}</span>
                </div>
                <h4 class="font-bold text-slate-800 dark:text-white mb-4 leading-tight">{{ $post->project->name }}</h4>
                
                <div class="flex items-center gap-6 pt-4 border-t border-slate-50 dark:border-white/5">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span class="text-xs font-bold text-slate-500">{{ number_format($post->views) }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        <span class="text-xs font-bold text-slate-500">{{ number_format($post->reach) }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="lg:col-span-2 p-20 text-center bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5">
            <p class="text-slate-400">No scheduled posts found.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal -->
<dialog id="addPostModal" class="p-0 rounded-[2.5rem] bg-white dark:bg-slate-900 shadow-2xl backdrop:backdrop-blur-sm border border-slate-100 dark:border-white/5">
    <div class="p-8 w-full max-w-md">
        <h3 class="text-xl font-bold mb-6">Schedule Social Media Post</h3>
        <form action="{{ route('dashboard.erp.scheduler.post.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Project / Content</label>
                <select name="project_id" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    @foreach($projects as $proj)
                        <option value="{{ $proj->id }}">{{ $proj->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Platform</label>
                <select name="platform" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    <option value="YouTube">YouTube</option>
                    <option value="Facebook">Facebook</option>
                    <option value="TikTok">TikTok</option>
                    <option value="Instagram">Instagram</option>
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Schedule Date & Time</label>
                <input type="datetime-local" name="schedule_date" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white font-bold rounded-xl">Schedule Post</button>
                <button type="button" onclick="document.getElementById('addPostModal').close()" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
