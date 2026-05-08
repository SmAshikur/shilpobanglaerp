@extends('layouts.employee')

@section('header', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl p-8 lg:p-12">
        <div class="flex flex-col md:flex-row gap-8 items-start mb-12">
            <div class="w-32 h-32 rounded-3xl bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-700 dark:text-indigo-400 text-4xl font-black border-4 border-white dark:border-slate-800 shadow-xl">
                {{ substr($employee->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <h2 class="text-3xl font-black text-slate-800 dark:text-white mb-2">{{ $employee->name }}</h2>
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-1.5 bg-slate-100 dark:bg-white/5 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-400">{{ $employee->designation->name }}</span>
                    <span class="px-4 py-1.5 bg-indigo-50 dark:bg-indigo-500/10 rounded-xl text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $employee->department->name }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('employee.profile.update') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Info Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Personal Information
                    </h3>
                    
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ $employee->phone }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 outline-none font-medium focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Home Address</label>
                        <textarea name="address" rows="3" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 outline-none font-medium focus:ring-2 focus:ring-indigo-500 transition-all resize-none">{{ $employee->address }}</textarea>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Security & Login
                    </h3>
                    
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">New Password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 outline-none font-medium focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm new password" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 outline-none font-medium focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-white/5 flex justify-end">
                <button type="submit" class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-black uppercase tracking-widest text-xs rounded-2xl hover:from-indigo-700 hover:to-violet-700 transition-all shadow-xl shadow-indigo-500/20">
                    Save Profile Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
