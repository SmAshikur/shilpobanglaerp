@extends('layouts.dashboard')

@section('header', 'Accounts & Finance')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Chart of Accounts</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Monitor company balance and transactions</p>
        </div>
        <div class="flex gap-3">
            <button class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-600/20">
                Add Income
            </button>
            <button class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-rose-600/20">
                Add Expense
            </button>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        @forelse($accounts as $account)
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">{{ $account->name }}</h4>
            <p class="text-3xl font-black text-slate-800 dark:text-white mb-4">৳{{ number_format($account->balance, 2) }}</p>
            <div class="flex items-center justify-between pt-4 border-t border-slate-50 dark:border-white/5">
                <span class="text-xs font-medium text-slate-500">{{ $account->account_number }}</span>
                <span class="text-xs font-bold text-indigo-600 uppercase">{{ $account->company->name }}</span>
            </div>
        </div>
        @empty
        <div class="md:col-span-3 p-20 text-center bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5">
            <p class="text-slate-400">No bank or cash accounts found. Start by adding an account.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
