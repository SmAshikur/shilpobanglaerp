@extends('layouts.dashboard')

@section('header', 'Equipment Tracking')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Gear & Hardware</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Track who has which gear and its current health</p>
        </div>
        <button onclick="document.getElementById('addLoanModal').showModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Issue Gear
        </button>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Loan History -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
            <h3 class="px-6 py-5 text-lg font-bold border-b border-slate-50 dark:border-white/5">Active Loans</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Gear</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Employee</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($loans as $loan)
                    <tr>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $loan->asset->name }}</p>
                            <p class="text-[10px] text-slate-400">Health: {{ $loan->health_on_loan }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $loan->employee->name }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="px-2 py-0.5 {{ $loan->status === 'borrowed' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }} rounded text-[10px] font-black uppercase tracking-tighter">{{ $loan->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-400">No active loans.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Inventory List -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
            <h3 class="px-6 py-5 text-lg font-bold border-b border-slate-50 dark:border-white/5">Gear Inventory</h3>
            <div class="p-6 grid grid-cols-2 gap-4">
                @foreach($assets as $asset)
                <div class="p-4 bg-slate-50 dark:bg-white/5 rounded-2xl border border-slate-100 dark:border-white/5">
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm">{{ $asset->name }}</h4>
                    <p class="text-[10px] text-slate-400 uppercase font-black">{{ $asset->type }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<dialog id="addLoanModal" class="p-0 rounded-[2.5rem] bg-white dark:bg-slate-900 shadow-2xl backdrop:backdrop-blur-sm border border-slate-100 dark:border-white/5">
    <div class="p-8 w-full max-w-md">
        <h3 class="text-xl font-bold mb-6">Issue Gear to Employee</h3>
        <form action="{{ route('dashboard.erp.agency.loan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Select Gear</label>
                <select name="asset_id" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    @foreach($assets as $ast)
                        <option value="{{ $ast->id }}">{{ $ast->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Employee</label>
                <select name="employee_id" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Current Health</label>
                <input type="text" name="health_on_loan" value="Excellent" class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <input type="hidden" name="loan_date" value="{{ date('Y-m-d') }}">
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white font-bold rounded-xl">Issue Gear</button>
                <button type="button" onclick="document.getElementById('addLoanModal').close()" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
