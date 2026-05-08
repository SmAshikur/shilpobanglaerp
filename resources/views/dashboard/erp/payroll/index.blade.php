@extends('layouts.dashboard')

@section('header', 'Payroll Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Salary & Payments</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Generate and manage employee payslips</p>
        </div>
        <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Generate Payroll
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Employee</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Month</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Net Salary</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                @forelse($payrolls as $pay)
                <tr>
                    <td class="px-6 py-5 font-bold text-slate-800 dark:text-white">{{ $pay->employee->name }}</td>
                    <td class="px-6 py-5 text-sm text-slate-500">{{ $pay->month }}</td>
                    <td class="px-6 py-5 text-sm font-bold text-slate-700 dark:text-slate-300">৳{{ number_format($pay->net_salary, 2) }}</td>
                    <td class="px-6 py-5 text-right">
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs font-bold uppercase">{{ $pay->status }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-slate-400">No payroll records found for this month.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
