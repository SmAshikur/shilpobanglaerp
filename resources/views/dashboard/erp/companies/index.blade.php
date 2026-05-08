@extends('layouts.dashboard')

@section('header', 'Companies Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Organization Structure</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Manage Mother and Sister companies</p>
        </div>
        <a href="{{ route('dashboard.erp.companies.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Company
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Logo</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Company Name</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Contact</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($companies as $company)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-5">
                            <div class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 flex items-center justify-center overflow-hidden border-2 border-slate-100 dark:border-white/5 shadow-sm group-hover:border-indigo-200 dark:group-hover:border-indigo-500/30 transition-all">
                                @if($company->logo)
                                    <img src="{{ asset('storage/'.$company->logo) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-900 flex items-center justify-center">
                                        <span class="text-xl font-black text-slate-300 dark:text-slate-600">{{ substr($company->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-white">{{ $company->name }}</h4>
                                <p class="text-xs text-slate-400 font-medium tracking-tight">{{ $company->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-sm font-medium text-slate-600 dark:text-slate-400">
                            {{ $company->phone }}
                        </td>
                        <td class="px-6 py-5">
                            <form action="{{ route('dashboard.erp.companies.toggle-status', $company->id) }}" method="POST">
                                @csrf
                                <button type="submit" @if($company->is_mother) disabled @endif class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none {{ $company->is_active ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-700' }} {{ $company->is_mother ? 'opacity-50 cursor-not-allowed' : '' }}">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $company->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                                <span class="ml-2 text-[10px] font-black uppercase tracking-widest {{ $company->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                    {{ $company->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </form>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('dashboard.erp.companies.edit', $company->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                @if(!$company->is_mother)
                                <form action="{{ route('dashboard.erp.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">No Companies Found</h3>
                                <p class="text-slate-500 dark:text-slate-500 max-w-xs mt-1">Start by adding your Mother company to build the organization structure.</p>
                                <a href="{{ route('dashboard.erp.companies.create') }}" class="mt-6 px-6 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-colors">Add Company</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($companies->hasPages())
        <div class="px-6 py-5 border-t border-slate-100 dark:border-white/5 bg-slate-50/50 dark:bg-white/5">
            {{ $companies->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
