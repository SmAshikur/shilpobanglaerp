@extends('layouts.dashboard')

@section('header', 'Activity Log')

@section('content')
<div class="space-y-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Interaction History</h2>
        <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Full history of calls, emails, and meetings</p>
    </div>

    <div class="max-w-4xl space-y-4">
        @forelse($activities as $activity)
        <div class="p-6 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none flex items-start gap-6 relative overflow-hidden group">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                @if($activity->type === 'call')
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                @elseif($activity->type === 'email')
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                @else
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                @endif
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-bold text-slate-800 dark:text-white">{{ $activity->lead->name }} - <span class="capitalize text-slate-400">{{ $activity->type }}</span></h4>
                    <span class="text-xs font-medium text-slate-400">{{ $activity->activity_date }}</span>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $activity->description }}</p>
                <div class="mt-4 pt-4 border-t border-slate-50 dark:border-white/5 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Performed By: {{ $activity->performedBy->name }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="p-20 text-center bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5">
            <p class="text-slate-400">No activity history found.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
