@extends('layouts.employee')

@section('header', 'Attendance')

@section('content')
<div class="space-y-8">

    {{-- Today's Card --}}
    <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h3 class="text-2xl font-black text-slate-800 dark:text-white mb-1">Today's Attendance</h3>
                <p class="text-slate-500 font-medium text-sm">{{ now()->format('l, d F Y') }}</p>
            </div>

            <div class="flex flex-wrap gap-3">

                {{-- NOT clocked in yet --}}
                @if(!$todayAttendance)
                    <form action="{{ route('employee.check-in') }}" method="POST">
                        @csrf
                        <button class="px-8 py-3.5 bg-indigo-600 text-white font-bold text-sm rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Clock In
                        </button>
                    </form>

                {{-- Clocked in, shift ongoing --}}
                @elseif(!$todayAttendance->check_out)

                    {{-- In-time badge --}}
                    <div class="px-5 py-3 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl border border-emerald-100 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 font-semibold text-sm flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        In: {{ \Carbon\Carbon::parse($todayAttendance->check_in)->format('h:i A') }}
                    </div>

                    {{-- No break started yet --}}
                    @if(!$todayAttendance->break_start)
                        <form action="{{ route('employee.break-start') }}" method="POST">
                            @csrf
                            <button class="px-8 py-3.5 bg-amber-500 text-white font-bold text-sm rounded-2xl hover:bg-amber-600 transition-all shadow-lg shadow-amber-500/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Start Break
                            </button>
                        </form>

                    {{-- On break --}}
                    @elseif(!$todayAttendance->break_end)
                        <div class="px-5 py-3 bg-amber-50 dark:bg-amber-500/10 rounded-xl border border-amber-100 dark:border-amber-500/20 text-amber-700 dark:text-amber-400 font-semibold text-sm flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                            Break since {{ \Carbon\Carbon::parse($todayAttendance->break_start)->format('h:i A') }}
                        </div>
                        <form action="{{ route('employee.break-end') }}" method="POST">
                            @csrf
                            <button class="px-8 py-3.5 bg-indigo-500 text-white font-bold text-sm rounded-2xl hover:bg-indigo-600 transition-all shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                End Break
                            </button>
                        </form>

                    {{-- Break done badge --}}
                    @else
                        <div class="px-5 py-3 bg-slate-50 dark:bg-white/5 rounded-xl text-slate-500 font-semibold text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Break: {{ $todayAttendance->break_minutes }} min
                        </div>
                    @endif

                    {{-- Clock Out --}}
                    <form action="{{ route('employee.check-out') }}" method="POST">
                        @csrf
                        <button class="px-8 py-3.5 bg-rose-500 text-white font-bold text-sm rounded-2xl hover:bg-rose-600 transition-all shadow-lg shadow-rose-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Clock Out
                        </button>
                    </form>

                {{-- Shift completed --}}
                @else
                    <div class="px-6 py-3.5 bg-emerald-500 text-white font-bold text-sm rounded-2xl shadow-lg shadow-emerald-500/20 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Shift Complete — {{ \Carbon\Carbon::parse($todayAttendance->check_in)->format('h:i A') }} → {{ \Carbon\Carbon::parse($todayAttendance->check_out)->format('h:i A') }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Attendance History Table --}}
    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl overflow-hidden">
        <div class="p-8 border-b border-slate-100 dark:border-white/5">
            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Attendance History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5">
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">In</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Out</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Break</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Net Work</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($attendances as $rec)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-700 dark:text-slate-300 text-sm">
                                {{ \Carbon\Carbon::parse($rec->date)->format('M d, Y') }}
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 rounded-lg text-xs font-bold">
                                    {{ $rec->check_in ? \Carbon\Carbon::parse($rec->check_in)->format('h:i A') : '—' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-rose-50 dark:bg-rose-500/10 text-rose-600 rounded-lg text-xs font-bold">
                                    {{ $rec->check_out ? \Carbon\Carbon::parse($rec->check_out)->format('h:i A') : '—' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                @if($rec->break_minutes > 0)
                                    <span class="px-3 py-1 bg-amber-50 dark:bg-amber-500/10 text-amber-600 rounded-lg text-xs font-bold">
                                        {{ $rec->break_minutes }} min
                                    </span>
                                @else
                                    <span class="text-slate-400 text-sm">—</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-slate-600 dark:text-slate-400 font-semibold text-sm">
                                @if($rec->check_in && $rec->check_out)
                                    @php
                                        $total = \Carbon\Carbon::parse($rec->check_in)->diffInMinutes(\Carbon\Carbon::parse($rec->check_out));
                                        $net   = max(0, $total - ($rec->break_minutes ?? 0));
                                        $h = intdiv($net, 60); $m = $net % 60;
                                    @endphp
                                    {{ $h }}h {{ $m }}m
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    {{ $rec->status === 'present' ? 'bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700' : 'bg-rose-100 dark:bg-rose-500/20 text-rose-600' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $rec->status === 'present' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ ucfirst($rec->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center text-slate-400 font-medium">
                                No attendance records yet.
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
