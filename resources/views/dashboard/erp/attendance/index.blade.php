@extends('layouts.dashboard')

@section('content')
<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 dark:text-white">HR Attendance</h1>
            <p class="text-slate-500 mt-1 text-sm">View, filter, manually record and export attendance</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('dashboard.erp.attendance.export.excel', request()->query()) }}"
               class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                Export CSV
            </a>
            <a href="{{ route('dashboard.erp.attendance.export.pdf', request()->query()) }}"
               class="flex items-center gap-2 px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-rose-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Export PDF
            </a>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('dashboard.erp.attendance') }}"
          class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Employee</label>
                <select name="employee_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Employees</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Status</option>
                    @foreach(['present','absent','late','leave','half_day'] as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all">Filter</button>
                <a href="{{ route('dashboard.erp.attendance') }}" class="px-4 py-2.5 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 text-slate-600 dark:text-slate-400 text-sm font-bold rounded-xl transition-all">Reset</a>
            </div>
        </div>
    </form>

    {{-- Manual Entry Form --}}
    <div x-data="{ open: false }">
        <button @click="open = !open"
                class="flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span x-text="open ? 'Close Form' : 'Add Manual Attendance'"></span>
        </button>

        <div x-show="open" x-collapse class="mt-4 bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm p-6">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-5">Manual Attendance Entry</h3>
            @if(session('error'))
                <div class="mb-4 p-4 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 text-rose-700 dark:text-rose-400 rounded-xl text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('dashboard.erp.attendance.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Employee *</label>
                        <select name="employee_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Employee</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                        @error('employee_id')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Date *</label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Status *</label>
                        <select name="status" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach(['present','absent','late','leave','half_day'] as $s)
                                <option value="{{ $s }}">{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Check In</label>
                        <input type="time" name="check_in" value="{{ old('check_in') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Check Out</label>
                        <input type="time" name="check_out" value="{{ old('check_out') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Note</label>
                        <input type="text" name="note" value="{{ old('note') }}" placeholder="Optional note"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                        Save Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Attendance Table --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-white/5 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                Attendance Records
                <span class="ml-2 text-sm font-normal text-slate-400">({{ $attendances->total() }} total)</span>
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5">
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Employee</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">In</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Out</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Break</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Net</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($attendances as $a)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors" x-data="{ editing: false }">
                            <td class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300 text-sm">
                                {{ $a->employee->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400 text-sm">
                                {{ \Carbon\Carbon::parse($a->date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 rounded-lg text-xs font-bold">
                                    {{ $a->check_in ? \Carbon\Carbon::parse($a->check_in)->format('h:i A') : '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-rose-50 dark:bg-rose-500/10 text-rose-600 rounded-lg text-xs font-bold">
                                    {{ $a->check_out ? \Carbon\Carbon::parse($a->check_out)->format('h:i A') : '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400 text-sm">
                                {{ $a->break_minutes ? $a->break_minutes.'m' : '—' }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400 font-semibold text-sm">
                                @if($a->check_in && $a->check_out)
                                    @php
                                        $total = \Carbon\Carbon::parse($a->check_in)->diffInMinutes(\Carbon\Carbon::parse($a->check_out));
                                        $net   = max(0, $total - ($a->break_minutes ?? 0));
                                    @endphp
                                    {{ intdiv($net,60) }}h {{ $net%60 }}m
                                @else —
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $colors = ['present'=>'emerald','absent'=>'rose','late'=>'amber','leave'=>'blue','half_day'=>'purple'];
                                    $c = $colors[$a->status] ?? 'slate';
                                @endphp
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-{{ $c }}-100 dark:bg-{{ $c }}-500/20 text-{{ $c }}-700">
                                    {{ ucfirst(str_replace('_',' ',$a->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button @click="editing = !editing"
                                            class="p-1.5 text-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form action="{{ route('dashboard.erp.attendance.destroy', $a) }}" method="POST"
                                          onsubmit="return confirm('Delete this record?')">
                                        @csrf @method('DELETE')
                                        <button class="p-1.5 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>

                                {{-- Inline edit form --}}
                                <div x-show="editing" x-collapse class="mt-3 pt-3 border-t border-slate-100 dark:border-white/10 space-y-3">
                                    <form action="{{ route('dashboard.erp.attendance.update', $a) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="time" name="check_in" value="{{ $a->check_in ? \Carbon\Carbon::parse($a->check_in)->format('H:i') : '' }}"
                                                   class="px-3 py-2 rounded-lg border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                            <input type="time" name="check_out" value="{{ $a->check_out ? \Carbon\Carbon::parse($a->check_out)->format('H:i') : '' }}"
                                                   class="px-3 py-2 rounded-lg border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                            <select name="status" class="px-3 py-2 rounded-lg border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                @foreach(['present','absent','late','leave','half_day'] as $s)
                                                    <option value="{{ $s }}" {{ $a->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="note" value="{{ $a->note }}" placeholder="Note"
                                                   class="px-3 py-2 rounded-lg border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <button type="submit" class="mt-2 w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg transition-all">
                                            Update
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center text-slate-400 font-medium">
                                No attendance records found for the selected filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50 dark:bg-white/5">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection
