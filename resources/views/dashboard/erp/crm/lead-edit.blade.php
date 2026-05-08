@extends('layouts.dashboard')

@section('header', 'Edit Lead')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Edit Lead</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium text-lg italic">Updating details for {{ $lead->name }}</p>
        </div>
        <a href="{{ route('dashboard.erp.leads') }}" class="px-6 py-3 bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 font-bold rounded-2xl hover:bg-slate-200 dark:hover:bg-white/10 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl shadow-slate-200/50 dark:shadow-none p-10">
        <form action="{{ route('dashboard.erp.leads.update', $lead) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            @method('PUT')

            <div class="space-y-2 md:col-span-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Full Name</label>
                <input type="text" name="name" value="{{ $lead->name }}" required 
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                <input type="email" name="email" value="{{ $lead->email }}"
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Phone Number</label>
                <input type="text" name="phone" value="{{ $lead->phone }}"
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Associated Company</label>
                <select name="company_id" required
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all appearance-none">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $lead->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Lead Source</label>
                <select name="source"
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all appearance-none">
                    @foreach(['web', 'social', 'referral', 'other'] as $source)
                        <option value="{{ $source }}" {{ $lead->source == $source ? 'selected' : '' }}>{{ ucfirst($source) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Current Stage</label>
                <select name="stage" required
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all appearance-none">
                    @foreach(['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'] as $stage)
                        <option value="{{ $stage }}" {{ $lead->stage == $stage ? 'selected' : '' }}>{{ ucfirst($stage) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Assigned Employee</label>
                <select name="assigned_to"
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all appearance-none">
                    <option value="">Unassigned</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $lead->assigned_to == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 pt-6">
                <button type="submit" 
                    class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-3xl transition-all shadow-xl shadow-indigo-600/20 hover:scale-[1.02] active:scale-95 uppercase tracking-widest">
                    Update Lead Information
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
