@extends('layouts.dashboard')
@section('header', 'Edit Employee')
@section('content')
<div class="max-w-4xl mx-auto"
     x-data="{
         selectedCompany: '{{ $employee->company_id }}',
         selectedDepartment: '{{ $employee->department_id }}',
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
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Employee</h2>
                <p class="text-sm text-slate-500 mt-0.5 font-mono">{{ $employee->employee_id }}</p>
            </div>
        </div>

        <form action="{{ route('dashboard.erp.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf @method('PUT')

            {{-- Section 1: Assignment --}}
            <div>
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 pb-2 border-b border-slate-100 dark:border-white/5">Assignment</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Company</label>
                        <select name="company_id" x-model="selectedCompany" @change="selectedDepartment = ''" required class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            @foreach(\App\Models\Company::all() as $company)
                                <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Department</label>
                        <select name="department_id" x-model="selectedDepartment" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            <option value="">— Select Dept —</option>
                            <template x-for="dept in filteredDepts" :key="dept.id">
                                <option :value="dept.id" x-text="dept.name" :selected="dept.id == {{ $employee->department_id }}"></option>
                            </template>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Designation</label>
                        <select name="designation_id" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            <option value="">— Select Desig —</option>
                            <template x-for="desig in filteredDesigs" :key="desig.id">
                                <option :value="desig.id" x-text="desig.name" :selected="desig.id == {{ $employee->designation_id }}"></option>
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
                        <input type="text" name="name" required value="{{ $employee->name }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Phone</label>
                        <input type="text" name="phone" value="{{ $employee->phone }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Gender</label>
                        <select name="gender" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                            <option value="">— Select —</option>
                            <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Joining Date</label>
                        <input type="date" name="joining_date" value="{{ $employee->joining_date?->format('Y-m-d') }}" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Address</label>
                        <textarea name="address" rows="2" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white resize-none">{{ $employee->address }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Photo</label>
                        @if($employee->image)
                            <img src="{{ asset('storage/'.$employee->image) }}" class="w-16 h-16 rounded-xl object-cover mb-2">
                        @endif
                        <input type="file" name="image" accept="image/*" class="w-full px-5 py-3 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 outline-none transition font-medium dark:text-white file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-bold file:text-xs">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Basic Salary</label>
                        <input type="number" name="basic_salary" step="0.01" value="{{ $employee->basic_salary }}" placeholder="Optional" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                    </div>
                </div>
            </div>

            {{-- Section 3: System Access --}}
            <div>
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 pb-2 border-b border-slate-100 dark:border-white/5">System Access
                    <span class="ml-2 text-[9px] text-indigo-500 normal-case font-semibold">Leave password blank to keep existing</span>
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email (Login Email)</label>
                        <input type="email" name="email" placeholder="employee@email.com"
                               value="{{ $employee->user->email ?? $employee->email }}"
                               class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                        @if($employee->user)
                            <p class="text-[10px] text-emerald-500 ml-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                System account exists
                            </p>
                        @else
                            <p class="text-[10px] text-slate-400 ml-1">Provide email to create system account</p>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">New Password</label>
                        <input type="text" name="password" placeholder="Leave blank to keep current password"
                               class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 focus:border-indigo-600 outline-none transition font-medium dark:text-white">
                        <p class="text-[10px] text-slate-400 ml-1">Min 8 characters recommended</p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('dashboard.erp.employees') }}" class="px-6 py-3 bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 font-bold rounded-2xl hover:bg-slate-200 transition-all">Cancel</a>
                <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest text-xs rounded-2xl transition-all shadow-xl shadow-indigo-600/20 transform hover:-translate-y-0.5">
                    Update Employee
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
