@extends('layouts.dashboard')

@section('header', 'Project Costing')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Project Expenses</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Track production costs for each video or content</p>
        </div>
        <button onclick="document.getElementById('addProjectModal').showModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Create Project
        </button>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">{{ $project->name }}</h3>
            <div class="mb-6">
                <div class="flex justify-between text-xs font-black uppercase text-slate-400 mb-2">
                    <span>Budget Usage</span>
                    <span>৳{{ number_format($project->total_expenses ?? 0, 2) }} / ৳{{ number_format($project->budget, 2) }}</span>
                </div>
                <div class="w-full h-2 bg-slate-50 dark:bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-600" style="width: {{ $project->budget > 0 ? min(($project->total_expenses / $project->budget) * 100, 100) : 0 }}%"></div>
                </div>
            </div>
            <div class="flex items-center justify-between pt-6 border-t border-slate-50 dark:border-white/5">
                <span class="px-2 py-0.5 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 rounded text-[10px] font-black uppercase tracking-widest">{{ $project->status }}</span>
                <button class="text-indigo-600 text-xs font-black uppercase tracking-widest">Add Expense</button>
            </div>
        </div>
        @empty
        <div class="md:col-span-3 p-20 text-center bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5">
            <p class="text-slate-400">No projects found. Create one to track expenses.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal -->
<dialog id="addProjectModal" class="p-0 rounded-[2.5rem] bg-white dark:bg-slate-900 shadow-2xl backdrop:backdrop-blur-sm border border-slate-100 dark:border-white/5">
    <div class="p-8 w-full max-w-md">
        <h3 class="text-xl font-bold mb-6">Create New Project</h3>
        <form action="{{ route('dashboard.erp.projects.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Project Name</label>
                <input type="text" name="name" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Budget (৳)</label>
                <input type="number" name="budget" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white font-bold rounded-xl">Save Project</button>
                <button type="button" onclick="document.getElementById('addProjectModal').close()" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
