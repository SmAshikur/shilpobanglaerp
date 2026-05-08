@extends('layouts.employee')

@section('header', 'Employee Portal')

@section('content')
<div class="space-y-8">
    <!-- Welcome & Attendance Stats -->
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2 p-8 bg-gradient-to-br from-indigo-600 to-violet-700 rounded-[2.5rem] text-white shadow-2xl shadow-indigo-200 dark:shadow-none relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl font-black mb-2 tracking-tight">Welcome back, {{ $employee->name }}!</h2>
                <p class="text-indigo-100 opacity-90 font-medium max-w-md">Manage your daily tasks, mark attendance, and keep your profile updated.</p>
                
                <div class="mt-8 flex flex-wrap gap-4">
                    @if(!$todayAttendance)
                        <form action="{{ route('employee.check-in') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-8 py-3.5 bg-white text-indigo-600 font-black rounded-2xl hover:bg-indigo-50 transition-all shadow-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                                Check In Now
                            </button>
                        </form>
                    @elseif($todayAttendance && !$todayAttendance->check_out)
                        <form action="{{ route('employee.check-out') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-8 py-3.5 bg-rose-500 text-white font-black rounded-2xl hover:bg-rose-600 transition-all shadow-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                Check Out
                            </button>
                        </form>
                    @else
                        <div class="px-8 py-3.5 bg-emerald-500 text-white font-black rounded-2xl flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Attendance Completed
                        </div>
                    @endif
                </div>
            </div>
            <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            </div>
        </div>

        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none flex flex-col justify-center">
            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Today's Timeline</h4>
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Check In</p>
                        <p class="font-bold text-slate-800 dark:text-white">{{ $todayAttendance->check_in ?? '--:--' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-500/10 flex items-center justify-center text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium">Check Out</p>
                        <p class="font-bold text-slate-800 dark:text-white">{{ $todayAttendance->check_out ?? '--:--' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Section -->
    <div class="space-y-6">
        <h3 class="text-xl font-bold text-slate-800 dark:text-white flex items-center gap-3">
            Current Assigned Tasks
            <span class="px-2 py-0.5 bg-indigo-100 text-indigo-600 rounded-lg text-xs">{{ count($tasks) }}</span>
        </h3>
        
        <div class="grid md:grid-cols-2 gap-6">
            @forelse($tasks as $task)
                <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl hover:shadow-2xl hover:shadow-indigo-500/10 transition-all flex flex-col justify-between group">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-white group-hover:text-indigo-600 transition-colors">{{ $task->title }}</h4>
                                <p class="text-xs text-slate-500 font-medium">Due: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('M d, Y') : 'No deadline' }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-600' : ($task->status === 'in_progress' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-600') }}">
                            {{ str_replace('_', ' ', $task->status) }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-slate-50 dark:border-white/5">
                        <span class="text-xs font-bold text-slate-400">Update Status:</span>
                        <form action="{{ route('employee.tasks.update', $task) }}" method="POST">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="px-4 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 border-none text-xs font-bold focus:ring-2 focus:ring-indigo-500 transition-all cursor-pointer">
                                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </form>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 p-20 text-center bg-white dark:bg-slate-900 rounded-[3rem] border border-dashed border-slate-200 dark:border-white/10">
                    <div class="flex flex-col items-center gap-4 text-slate-400 font-medium">
                        <svg class="w-16 h-16 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        No tasks assigned to you yet.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

