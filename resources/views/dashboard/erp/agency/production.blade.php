@extends('layouts.dashboard')

@section('header', 'Production Pipeline')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Production Workflow</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Track scripting, shooting and editing stages</p>
        </div>
        <button onclick="document.getElementById('addTaskModal').showModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Assign New Task
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-white/5 border-b border-slate-100 dark:border-white/5">
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Project</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Task Title</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Assigned To</th>
                    <th class="px-6 py-5 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                @forelse($tasks as $task)
                <tr>
                    <td class="px-6 py-5">
                        <h4 class="font-bold text-slate-800 dark:text-white">{{ $task->project->name }}</h4>
                        <p class="text-[10px] text-slate-400 uppercase font-black">Deadline: {{ $task->deadline }}</p>
                    </td>
                    <td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-400 font-medium">{{ $task->title }}</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-indigo-50 flex items-center justify-center text-[10px] font-bold text-indigo-600">
                                {{ substr($task->assignedTo->name ?? '?', 0, 1) }}
                            </div>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $task->assignedTo->name ?? 'Unassigned' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <span class="px-2.5 py-1 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-lg text-xs font-black uppercase tracking-widest">{{ str_replace('_', ' ', $task->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-slate-400">No production tasks assigned yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<dialog id="addTaskModal" class="p-0 rounded-[2.5rem] bg-white dark:bg-slate-900 shadow-2xl backdrop:backdrop-blur-sm border border-slate-100 dark:border-white/5">
    <div class="p-8 w-full max-w-md">
        <h3 class="text-xl font-bold mb-6">Assign Production Task</h3>
        <form action="{{ route('dashboard.erp.production.task.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Project</label>
                <select name="project_id" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    @foreach($projects as $proj)
                        <option value="{{ $proj->id }}">{{ $proj->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Task Title (e.g. Editing)</label>
                <input type="text" name="title" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Assign To</label>
                <select name="assigned_to" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Deadline</label>
                <input type="date" name="deadline" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white font-bold rounded-xl">Assign Task</button>
                <button type="button" onclick="document.getElementById('addTaskModal').close()" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
