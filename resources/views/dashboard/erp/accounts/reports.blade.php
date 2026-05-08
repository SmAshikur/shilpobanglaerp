@extends('layouts.dashboard')

@section('header', 'Financial Reports')

@section('content')
<div class="space-y-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Financial Overview</h2>
        <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Summary of income, asset value and recurring costs</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid md:grid-cols-3 gap-8">
        <div class="p-8 bg-gradient-to-br from-indigo-600 to-violet-700 rounded-[2.5rem] text-white shadow-2xl shadow-indigo-200 dark:shadow-none overflow-hidden relative">
            <h4 class="text-xs font-black opacity-60 uppercase tracking-widest mb-2">Total Asset Value</h4>
            <p class="text-4xl font-black tracking-tight">৳{{ number_format($totalAssetsValue, 2) }}</p>
            <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            </div>
        </div>

        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Monthly Subscriptions</h4>
            <p class="text-4xl font-black text-rose-500 tracking-tight">৳{{ number_format($monthlySubCost, 2) }}</p>
            <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-widest">Recurring Monthly Expense</p>
        </div>

        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Current Month Income</h4>
            <p class="text-4xl font-black text-emerald-600 tracking-tight">৳{{ number_format($monthlyIncome->where('month', date('m'))->first()->total ?? 0, 2) }}</p>
            <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-widest">Paid Invoices Only</p>
        </div>
    </div>

    <!-- Income Chart Visualization -->
    <div class="p-10 bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
        <h3 class="text-xl font-black mb-10 tracking-tight">Platform Income Breakdown</h3>
        <div class="flex items-end gap-4 h-64">
            @foreach($monthlyIncome as $inc)
            <div class="flex-1 flex flex-col items-center gap-4">
                <div class="w-full bg-indigo-500 rounded-2xl transition-all hover:bg-indigo-600 cursor-pointer" style="height: {{ min(($inc->total / 100000) * 100, 100) }}%"></div>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Month {{ $inc->month }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
