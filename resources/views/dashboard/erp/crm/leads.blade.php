@extends('layouts.dashboard')

@section('header', 'Leads Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Leads & Contacts</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Track potential customers and their journey</p>
        </div>
        <button onclick="document.getElementById('addLeadModal').showModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Add New Lead
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Lead Info</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Stage</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Assigned To</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                @forelse($leads as $lead)
                <tr>
                    <td class="px-6 py-5">
                        <h4 class="font-bold text-slate-800 dark:text-white">{{ $lead->name }}</h4>
                        <p class="text-xs text-slate-500">{{ $lead->phone }}</p>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-2.5 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg text-xs font-black uppercase tracking-widest">{{ $lead->stage }}</span>
                    </td>
                    <td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-400">
                        {{ $lead->assignedTo->name ?? 'Unassigned' }}
                    </td>
                    <td class="px-6 py-5 text-right">
                        <button class="text-indigo-600 hover:underline">Details</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-slate-400">No leads found. Start by adding one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Simple Add Lead Modal -->
<dialog id="addLeadModal" class="p-0 rounded-[2.5rem] bg-white dark:bg-slate-900 shadow-2xl backdrop:backdrop-blur-sm border border-slate-100 dark:border-white/5">
    <div class="p-8 w-full max-w-md">
        <h3 class="text-xl font-bold mb-6">Add New Lead</h3>
        <form action="{{ route('dashboard.erp.leads.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Name</label>
                <input type="text" name="name" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Company</label>
                <select name="company_id" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    @foreach(\App\Models\Company::all() as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white font-bold rounded-xl">Save Lead</button>
                <button type="button" onclick="document.getElementById('addLeadModal').close()" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
