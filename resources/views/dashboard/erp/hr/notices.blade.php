@extends('layouts.dashboard')

@section('header', 'Notice Board')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Office Notices</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Publish and manage official announcements</p>
        </div>
        <button onclick="document.getElementById('addNoticeModal').showModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Create Notice
        </button>
    </div>

    <div class="max-w-4xl space-y-6">
        @forelse($notices as $notice)
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border {{ $notice->is_urgent ? 'border-rose-200 dark:border-rose-500/20 bg-rose-50/30' : 'border-slate-100 dark:border-white/5' }} shadow-xl shadow-slate-200/50 dark:shadow-none">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ $notice->created_at->format('M d, Y') }}</span>
                @if($notice->is_urgent)
                    <span class="px-2 py-0.5 bg-rose-500 text-white text-[10px] font-black uppercase rounded">Urgent</span>
                @endif
            </div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4">{{ $notice->title }}</h3>
            <div class="text-slate-600 dark:text-slate-400 leading-relaxed text-sm">
                {!! nl2br(e($notice->content)) !!}
            </div>
        </div>
        @empty
        <div class="p-20 text-center bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5">
            <p class="text-slate-400">No notices posted yet.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal -->
<dialog id="addNoticeModal" class="p-0 rounded-[2.5rem] bg-white dark:bg-slate-900 shadow-2xl backdrop:backdrop-blur-sm border border-slate-100 dark:border-white/5">
    <div class="p-8 w-full max-w-md">
        <h3 class="text-xl font-bold mb-6">Create New Notice</h3>
        <form action="{{ route('dashboard.erp.notices.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Title</label>
                <input type="text" name="title" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Content</label>
                <textarea name="content" rows="5" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium resize-none"></textarea>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_urgent" value="1" id="urgent" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <label for="urgent" class="text-sm font-bold text-slate-600">Mark as Urgent</label>
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white font-bold rounded-xl">Publish Notice</button>
                <button type="button" onclick="document.getElementById('addNoticeModal').close()" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
