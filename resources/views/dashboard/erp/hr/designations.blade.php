@extends('layouts.dashboard')

@section('header', 'Designations Management')

@section('content')
<div class="grid lg:grid-cols-3 gap-8 items-start">
    <!-- Add Designation Form -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none p-8 sticky top-8" 
             x-data="{ 
                selectedCompany: '{{ $companies->first()->id ?? '' }}',
                departments: {{ $departments->map(fn($d) => ['id' => $d->id, 'name' => $d->name, 'company_id' => $d->company_id])->toJson() }}
             }">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Add Designation</h3>
            </div>
            
            <form action="{{ route('dashboard.erp.hr.designations.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Assign to Company</label>
                    <select name="company_id" x-model="selectedCompany" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white">
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2" x-show="selectedCompany">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Select Department</label>
                    <select name="department_id" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white">
                        <template x-for="dept in departments.filter(d => d.company_id == selectedCompany)" :key="dept.id">
                            <option :value="dept.id" x-text="dept.name"></option>
                        </template>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Designation Title</label>
                    <input type="text" name="name" required placeholder="e.g. Senior Content Lead" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 outline-none transition duration-500 font-medium dark:text-white">
                </div>
                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest text-xs rounded-2xl transition-all shadow-xl shadow-indigo-600/20 transform hover:-translate-y-1">
                    Create Designation
                </button>
            </form>
        </div>
    </div>

    <!-- Designations List -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                            <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Designation</th>
                            <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Dept / Company</th>
                            <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-6 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                        @forelse($designations as $desig)
                        <tr class="group hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors" x-data="{ 
                            editing: false,
                            selectedCompany: '{{ $desig->company_id }}',
                            departments: {{ $departments->map(fn($d) => ['id' => $d->id, 'name' => $d->name, 'company_id' => $d->company_id])->toJson() }}
                        }">
                            <td class="px-8 py-6">
                                <div x-show="!editing" class="font-bold text-slate-800 dark:text-white">{{ $desig->name }}</div>
                                <form x-show="editing" x-cloak action="{{ route('dashboard.erp.hr.designations.update', $desig->id) }}" method="POST" class="space-y-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $desig->name }}" class="w-full px-3 py-1 text-sm rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 outline-none focus:border-indigo-500 dark:text-white">
                                    <select name="company_id" x-model="selectedCompany" class="w-full px-3 py-1 text-sm rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 outline-none focus:border-indigo-500 dark:text-white">
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <select name="department_id" class="w-full px-3 py-1 text-sm rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 outline-none focus:border-indigo-500 dark:text-white">
                                        <template x-for="dept in departments.filter(d => d.company_id == selectedCompany)" :key="dept.id">
                                            <option :value="dept.id" x-text="dept.name" :selected="dept.id == {{ $desig->department_id }}"></option>
                                        </template>
                                    </select>
                                    <div class="flex gap-2">
                                        <button type="submit" class="px-3 py-1 bg-emerald-500 text-white text-xs font-bold rounded-lg uppercase tracking-widest">Save</button>
                                        <button type="button" @click="editing = false; selectedCompany = '{{ $desig->company_id }}'" class="px-3 py-1 bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-lg uppercase tracking-widest">Cancel</button>
                                    </div>
                                </form>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col gap-1">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $desig->department->name ?? 'N/A' }}</span>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ $desig->company->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <form action="{{ route('dashboard.erp.hr.designations.toggle-status', $desig->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors {{ $desig->is_active ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-700' }}">
                                        <span class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform {{ $desig->is_active ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="editing = true" class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </button>
                                    <form action="{{ route('dashboard.erp.hr.designations.destroy', $desig->id) }}" method="POST" onsubmit="return confirm('Delete this designation?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">No Designations</h3>
                                    <p class="text-slate-500 text-sm mt-1">Start by adding your first designation.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
