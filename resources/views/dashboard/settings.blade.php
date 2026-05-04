@extends('layouts.dashboard')

@section('header', 'Admin Account Security')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-slate-900 p-12 rounded-[3.5rem] border border-slate-100 dark:border-white/5 shadow-xl overflow-hidden transition-all">
        <div class="flex flex-col items-center mb-10">
            <div class="w-16 h-16 bg-slate-900 dark:bg-white border-4 border-slate-50 dark:border-slate-800 rounded-2xl flex items-center justify-center text-white dark:text-slate-900 text-2xl font-black mb-4">
                {{ substr($user->name, 0, 1) }}
            </div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Hi, {{ $user->name }}!</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest mt-1">Manage your credentials</p>
        </div>

        <form action="{{ route('dashboard.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2 uppercase tracking-widest">Full Name</label>
                <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-6 py-5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-white">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2 uppercase tracking-widest">Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-6 py-5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-2xl font-medium focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-white">
            </div>
            
            <div class="pt-8 border-t border-slate-100 dark:border-white/5">
                <h4 class="text-xs font-black text-rose-500 mb-6 uppercase tracking-[0.2em]">Change Password (Optional)</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-widest">New Password</label>
                        <input type="password" name="password" class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-widest">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-600 transition dark:text-white">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="w-full py-6 bg-slate-950 dark:bg-indigo-600 text-white font-black rounded-2xl hover:bg-slate-800 dark:hover:bg-indigo-700 transition shadow-2xl shadow-slate-900/40 dark:shadow-none uppercase tracking-[0.1em]">Update Security Settings</button>
        </form>
    </div>
</div>
@endsection
