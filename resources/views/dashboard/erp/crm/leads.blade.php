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
                    <td class="px-6 py-5 text-right flex justify-end gap-2">
                        @if($lead->stage !== 'won')
                        <form action="{{ route('dashboard.erp.leads.convert', $lead) }}" method="POST" onsubmit="return confirm('Convert this lead to a Client?')">
                            @csrf
                            <button type="submit" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Convert to Client">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('dashboard.erp.leads.edit', $lead) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('dashboard.erp.leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Delete this lead?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
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
    <div class="p-8 w-full max-w-2xl">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-2xl font-bold">Add New Lead</h3>
            <button onclick="document.getElementById('addLeadModal').close()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form action="{{ route('dashboard.erp.leads.store') }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf
            <div class="space-y-1 col-span-2">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Full Name</label>
                <input type="text" name="name" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Email</label>
                <input type="email" name="email" class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Phone</label>
                <input type="text" name="phone" class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Company</label>
                <select name="company_id" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    <option value="">Select Company</option>
                    @foreach(\App\Models\Company::where('is_active', true)->get() as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Lead Source</label>
                <select name="source" class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    <option value="web">Website</option>
                    <option value="social">Social Media</option>
                    <option value="referral">Referral</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Assigned To</label>
                <select name="assigned_to" class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    <option value="">Unassigned</option>
                    @foreach(\App\Models\Employee::where('is_active', true)->get() as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Initial Stage</label>
                <select name="stage" class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    <option value="new">New</option>
                    <option value="contacted">Contacted</option>
                    <option value="qualified">Qualified</option>
                </select>
            </div>
            <div class="pt-4 flex gap-3 col-span-2">
                <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-lg shadow-indigo-600/20 hover:scale-[1.02] transition-transform">Create Lead</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
