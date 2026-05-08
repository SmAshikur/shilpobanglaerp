@extends('layouts.dashboard')

@section('header', 'CRM Reports')

@section('content')
<div class="space-y-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Analytics Dashboard</h2>
        <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Overview of your sales performance and revenue</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6">
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Total Revenue</h4>
            <p class="text-3xl font-black text-emerald-600 tracking-tight">৳{{ number_format($revenue, 2) }}</p>
        </div>
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Pending Payments</h4>
            <p class="text-3xl font-black text-rose-500 tracking-tight">৳{{ number_format($pending, 2) }}</p>
        </div>
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Total Leads</h4>
            <p class="text-3xl font-black text-indigo-600 tracking-tight">{{ \App\Models\Lead::count() }}</p>
        </div>
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Conversion Rate</h4>
            <p class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">
                {{ \App\Models\Lead::count() > 0 ? round((\App\Models\Lead::where('stage', 'won')->count() / \App\Models\Lead::count()) * 100, 1) : 0 }}%
            </p>
        </div>
    </div>

    <!-- Charts Placeholder & Stage Breakdown -->
    <div class="grid lg:grid-cols-2 gap-8">
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h3 class="text-xl font-bold mb-8">Leads by Stage</h3>
            <div class="space-y-6">
                @foreach($leadsByStage as $stage)
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black uppercase text-slate-500 tracking-widest">{{ $stage->stage }}</span>
                        <span class="text-sm font-bold">{{ $stage->total }}</span>
                    </div>
                    <div class="w-full h-3 bg-slate-50 dark:bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-600 rounded-full" style="width: {{ ($stage->total / (\App\Models\Lead::count() ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="p-8 bg-indigo-600 rounded-[2.5rem] text-white shadow-2xl shadow-indigo-200 flex flex-col justify-center items-center text-center">
            <svg class="w-20 h-20 mb-6 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055zM13 3.055V11h7.945A9.002 9.002 0 0013 3.055z" /></svg>
            <h3 class="text-2xl font-black mb-4">Ready for Growth?</h3>
            <p class="text-indigo-100 mb-8 max-w-xs">Track your sales performance and optimize your business processes in real-time.</p>
            <button class="px-8 py-3 bg-white text-indigo-600 font-black rounded-2xl shadow-xl">Download Full Report</button>
        </div>
    </div>
</div>
@endsection
