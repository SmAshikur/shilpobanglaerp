@extends('layouts.dashboard')

@section('header', 'Invoice Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Billing & Invoices</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Manage client invoices and track payments</p>
        </div>
        <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Create Invoice
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Invoice #</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Client</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Amount</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                @forelse($invoices as $invoice)
                <tr>
                    <td class="px-6 py-5 font-bold text-slate-800 dark:text-white">{{ $invoice->invoice_number }}</td>
                    <td class="px-6 py-5 text-sm text-slate-500">{{ $invoice->client->name }}</td>
                    <td class="px-6 py-5">
                        <p class="text-sm font-bold text-slate-800 dark:text-white">৳{{ number_format($invoice->total_amount, 2) }}</p>
                        <p class="text-[10px] text-slate-400 uppercase font-black">Due: ৳{{ number_format($invoice->total_amount - $invoice->paid_amount, 2) }}</p>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <span class="px-2.5 py-1 {{ $invoice->status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} rounded-lg text-xs font-black uppercase tracking-widest">{{ $invoice->status }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-slate-400">No invoices generated yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
