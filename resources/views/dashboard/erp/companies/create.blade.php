@extends('layouts.dashboard')

@section('header', 'Add New Company')

@section('content')
<div class="max-w-4xl">
    <div class="mb-8">
        <a href="{{ route('dashboard.erp.companies') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors gap-2 group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Companies
        </a>
    </div>

    <form action="{{ route('dashboard.erp.companies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none p-8 md:p-12">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg flex items-center justify-center text-sm">01</span>
                        Basic Information
                    </h3>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Company Name</label>
                    <input type="text" name="name" required placeholder="Enter company name" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white">
                </div>



                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Parent Company</label>
                    <select name="parent_id" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white appearance-none">
                        <option value="">None (Main Mother Company)</option>
                        @foreach($motherCompanies as $mc)
                            <option value="{{ $mc->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $mc->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Official Email</label>
                    <input type="email" name="email" placeholder="email@company.com" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Contact Phone</label>
                    <input type="text" name="phone" placeholder="+880..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Company Logo</label>
                    <input type="file" name="logo_file" class="w-full px-6 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 outline-none transition duration-500 font-medium dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
                    <p class="text-[10px] text-slate-400 mt-2 font-medium">Recommended: Square (1:1 ratio), e.g., 512x512px. PNG preferred.</p>
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Company Address</label>
                    <textarea name="address" rows="3" placeholder="Enter full address" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white resize-none"></textarea>
                </div>
            </div>

            <div class="mt-12 flex justify-end">
                <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest text-sm rounded-2xl transition-all shadow-xl shadow-indigo-600/20 transform hover:-translate-y-1">
                    Save Company Info
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
