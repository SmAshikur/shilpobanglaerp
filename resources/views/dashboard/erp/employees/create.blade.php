@extends('layouts.dashboard')
@section('header', 'Add New Employee')
@section('content')
<div class="max-w-4xl mx-auto"
     x-data="{
         selectedCompany: '{{ $companies->first()->id ?? '' }}',
         selectedDepartment: '',
         allDepartments: {{ $departments->map(fn($d) => ['id'=>$d->id,'name'=>$d->name,'company_id'=>$d->company_id])->toJson() }},
         allDesignations: {{ $designations->map(fn($d) => ['id'=>$d->id,'name'=>$d->name,'department_id'=>$d->department_id])->toJson() }},
         get filteredDepts() { return this.allDepartments.filter(d => d.company_id == this.selectedCompany); },
         get filteredDesigs() { return this.allDesignations.filter(d => d.department_id == this.selectedDepartment); }
     }">

    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none p-8 lg:p-12">
        <div class="flex items-center gap-4 mb-10">
            <a href="{{ route('dashboard.erp.employees') }}" class="p-2 hover:bg-slate-100 dark:hover:bg-white/10 rounded-xl transition-colors text-slate-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Add New Employee</h2>
                <p class="text-sm text-slate-500 mt-0.5">Employee ID will be auto-generated. User account created if email is provided.</p>
            </div>
        </div>

        <form action="{{ route('dashboard.erp.employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Section 1: Company & Role --}}
            <div>
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 pb-2 border-b border-slate-100 dark:border-white/5">Assignment</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Company</label>
                        <select name="company_id" x-model="selectedCompany" @change="selectedDepartment = ''" required class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Department</label>
                        <select name="department_id" x-model="selectedDepartment" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            <option value="">— Select Dept —</option>
                            <template x-for="dept in filteredDepts" :key="dept.id">
                                <option :value="dept.id" x-text="dept.name"></option>
                            </template>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Designation</label>
                        <select name="designation_id" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            <option value="">— Select Desig —</option>
                            <template x-for="desig in filteredDesigs" :key="desig.id">
                                <option :value="desig.id" x-text="desig.name"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Section 2: Personal Info --}}
            <div>
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 pb-2 border-b border-slate-100 dark:border-white/5">Personal Information</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Full Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required placeholder="Employee full name" value="{{ old('name') }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Phone</label>
                        <input type="text" name="phone" placeholder="+880..." value="{{ old('phone') }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Gender</label>
                        <select name="gender" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            <option value="">— Select —</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Joining Date</label>
                        <input type="date" name="joining_date" value="{{ old('joining_date', now()->format('Y-m-d')) }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Address</label>
                        <textarea name="address" rows="2" placeholder="Employee address..." class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white resize-none">{{ old('address') }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Photo</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-5 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 outline-none transition font-medium dark:text-white file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-bold file:text-xs">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Basic Salary</label>
                        <input type="number" name="basic_salary" step="0.01" placeholder="Optional" value="{{ old('basic_salary') }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                </div>
            </div>

            {{-- Section 3: System Access --}}
            <div>
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 pb-2 border-b border-slate-100 dark:border-white/5">System Access <span class="ml-2 text-[9px] text-indigo-500 normal-case font-semibold">Leave blank to skip account creation</span></h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email (Login Email)</label>
                        <input type="email" name="email" placeholder="employee@email.com" value="{{ old('email') }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                        <input type="text" name="password" placeholder="Leave blank for auto-generated" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                        <p class="text-[10px] text-slate-400 ml-1">If empty, a random password will be generated.</p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('dashboard.erp.employees') }}" class="px-6 py-3 bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold rounded-2xl hover:bg-slate-200 transition-all">Cancel</a>
                <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest text-xs rounded-2xl transition-all shadow-xl shadow-indigo-600/20 transform hover:-translate-y-0.5">
                    Create Employee
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
