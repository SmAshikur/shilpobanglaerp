@extends('layouts.dashboard')

@section('header', 'Subscriptions')

@section('content')
<div class="space-y-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Software & Tools</h2>
        <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Track monthly editing and AI tool subscriptions</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($subscriptions as $sub)
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">{{ $sub->name }}</h4>
            <p class="text-2xl font-black text-slate-800 dark:text-white mb-4">৳{{ number_format($sub->monthly_cost, 2) }}<span class="text-xs text-slate-400 font-medium">/mo</span></p>
            <div class="flex items-center justify-between pt-4 border-t border-slate-50 dark:border-white/5">
                <span class="text-[10px] font-bold text-slate-400 uppercase">Next: {{ $sub->next_billing_date }}</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </div>
        </div>
        @empty
        <div class="md:col-span-4 p-12 text-center bg-slate-50 dark:bg-white/5 rounded-[2rem] border border-dashed border-slate-200">
            <p class="text-slate-400">No active subscriptions tracked.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
