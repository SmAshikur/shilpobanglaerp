@extends('layouts.dashboard')

@section('header', 'Recruitment Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Hiring & Vacancies</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Manage job openings and candidate applications</p>
        </div>
        <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Post New Job
        </button>
    </div>

    <!-- Job Openings -->
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($jobs as $job)
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">{{ $job->title }}</h3>
                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-[10px] font-black uppercase">{{ $job->status }}</span>
            </div>
            <p class="text-sm text-slate-500 mb-6 line-clamp-2">{{ $job->description }}</p>
            <div class="flex items-center justify-between pt-6 border-t border-slate-50 dark:border-white/5">
                <span class="text-xs font-bold text-slate-400">Deadline: {{ $job->deadline }}</span>
                <button class="text-indigo-600 text-xs font-black uppercase tracking-widest">View Candidates</button>
            </div>
        </div>
        @empty
        <div class="md:col-span-2 p-12 text-center bg-slate-50 dark:bg-white/5 rounded-[2rem] border border-dashed border-slate-200">
            <p class="text-slate-400">No active job openings.</p>
        </div>
        @endforelse
    </div>

    <!-- Recent Candidates -->
    <div class="space-y-4">
        <h3 class="text-xl font-bold text-slate-800 dark:text-white">Recent Applications</h3>
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Candidate</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Applied For</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($candidates as $candidate)
                    <tr>
                        <td class="px-6 py-5 font-bold text-slate-800 dark:text-white">{{ $candidate->name }}</td>
                        <td class="px-6 py-5 text-sm text-slate-500">{{ $candidate->jobOpening->title }}</td>
                        <td class="px-6 py-5 text-right">
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded text-xs font-bold uppercase">{{ $candidate->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-400">No applications received yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
