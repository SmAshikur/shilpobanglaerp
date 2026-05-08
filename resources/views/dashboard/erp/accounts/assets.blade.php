@extends('layouts.dashboard')

@section('header', 'Asset Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Company Assets</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Manage hardware inventory and maintenance history</p>
        </div>
        <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Add New Asset
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Asset Name</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Type</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Serial #</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Value</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                @forelse($assets as $asset)
                <tr>
                    <td class="px-6 py-5 font-bold text-slate-800 dark:text-white">{{ $asset->name }}</td>
                    <td class="px-6 py-5 text-sm text-slate-500">{{ $asset->type }}</td>
                    <td class="px-6 py-5 text-sm text-slate-600">{{ $asset->serial_number }}</td>
                    <td class="px-6 py-5 text-right font-black text-slate-800 dark:text-white">
                        ৳{{ number_format($asset->purchase_price, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-slate-400">No assets registered yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
