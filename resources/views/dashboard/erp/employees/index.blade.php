@extends('layouts.dashboard')
@section('header', 'Employee Management')
@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Human Resources</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Manage all employees across companies</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.erp.hr.departments') }}" class="px-4 py-2.5 bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold rounded-xl hover:bg-slate-200 transition-all">
                Departments
            </a>
            <a href="{{ route('dashboard.erp.hr.designations') }}" class="px-4 py-2.5 bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold rounded-xl hover:bg-slate-200 transition-all">
                Designations
            </a>
            <a href="{{ route('dashboard.erp.employees.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Employee
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Employee</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Company</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Joining</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($employees as $employee)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 font-bold overflow-hidden shrink-0">
                                    @if($employee->image)
                                        <img src="{{ asset('storage/'.$employee->image) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($employee->name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-white">{{ $employee->name }}</h4>
                                    <p class="text-xs text-slate-500 font-mono">{{ $employee->employee_id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="space-y-0.5">
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $employee->company->name ?? 'N/A' }}</p>
                                <p class="text-xs text-slate-500">{{ $employee->designation->name ?? '—' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $employee->joining_date ? $employee->joining_date->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-5">
                            <form action="{{ route('dashboard.erp.employees.toggle-status', $employee->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $employee->is_active ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-700' }}">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $employee->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                                <span class="text-[10px] font-black uppercase tracking-widest {{ $employee->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                    {{ $employee->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </form>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('dashboard.erp.employees.edit', $employee->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('dashboard.erp.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Remove this employee?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">No Employees Yet</h3>
                                <p class="text-slate-500 dark:text-slate-500 max-w-xs mt-1">Start adding employees to manage your workforce.</p>
                                <a href="{{ route('dashboard.erp.employees.create') }}" class="mt-6 px-6 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-colors">Add Employee</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($employees->hasPages())
        <div class="px-6 py-5 border-t border-slate-100 dark:border-white/5 bg-slate-50/50 dark:bg-white/5">
            {{ $employees->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
