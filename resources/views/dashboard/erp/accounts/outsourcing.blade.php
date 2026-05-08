@extends('layouts.dashboard')

@section('header', 'Outsourcing')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">External Payments</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Track payments for freelancers, editors and designers</p>
        </div>
        <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Log New Payment
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Freelancer</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Project</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                @forelse($payments as $payment)
                <tr>
                    <td class="px-6 py-5 font-bold text-slate-800 dark:text-white">{{ $payment->freelancer_name }}</td>
                    <td class="px-6 py-5 text-sm text-slate-500">{{ $payment->project->name ?? 'N/A' }}</td>
                    <td class="px-6 py-5 text-right font-black text-indigo-600">
                        ৳{{ number_format($payment->amount, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-slate-400">No outsourcing payments recorded.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
