@extends('layouts.dashboard')

@section('header', 'Invoice Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Invoices</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Manage billing and payments for your clients</p>
        </div>
        <a href="{{ route('dashboard.erp.invoices.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Create Invoice
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Invoice</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Client</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Amount</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Status</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                @forelse($invoices as $invoice)
                <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                    <td class="px-6 py-5">
                        <h4 class="font-bold text-slate-800 dark:text-white">{{ $invoice->invoice_number }}</h4>
                        <p class="text-xs text-slate-500">{{ $invoice->invoice_date }}</p>
                    </td>
                    <td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-400 font-medium">
                        {{ $invoice->client->name }}
                    </td>
                    <td class="px-6 py-5 font-bold text-slate-800 dark:text-white">
                        ${{ number_format($invoice->total_amount, 2) }}
                    </td>
                    <td class="px-6 py-5">
                        @php
                            $statusColors = [
                                'draft' => 'bg-slate-100 text-slate-600 dark:bg-white/10 dark:text-slate-400',
                                'unpaid' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400',
                                'paid' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400',
                                'overdue' => 'bg-rose-100 text-rose-700 dark:bg-rose-500/10 dark:text-rose-400',
                            ];
                            $color = $statusColors[$invoice->status] ?? 'bg-slate-100 text-slate-600';
                        @endphp
                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $color }}">
                            {{ $invoice->status }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right flex justify-end gap-2">
                        <a href="{{ route('dashboard.erp.invoices.edit', $invoice) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('dashboard.erp.invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Delete this invoice?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
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
