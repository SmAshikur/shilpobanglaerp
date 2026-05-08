@extends('layouts.dashboard')

@section('header', 'Sales Pipeline')

@section('content')
<div class="space-y-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Sales Pipeline</h2>
        <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Drag and drop leads between stages (Visualizing stages)</p>
    </div>

    <div class="flex gap-6 overflow-x-auto pb-8 snap-x">
        @foreach($stages as $stage)
        <div class="flex-shrink-0 w-80 snap-start">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ $stage }}</h3>
                <span class="px-2 py-0.5 bg-slate-100 dark:bg-white/5 text-slate-500 rounded-lg text-xs font-bold">{{ count($leads[$stage] ?? []) }}</span>
            </div>
            
            <div class="space-y-4 min-h-[500px] p-4 bg-slate-50 dark:bg-white/5 rounded-[2rem] border border-dashed border-slate-200 dark:border-white/10">
                @forelse($leads[$stage] ?? [] as $lead)
                <div class="p-6 bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm hover:shadow-md transition-all cursor-move">
                    <h4 class="font-bold text-slate-800 dark:text-white mb-1">{{ $lead->name }}</h4>
                    <p class="text-xs text-slate-500 mb-4">{{ $lead->company->name }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase text-indigo-600 tracking-tighter">ID: #{{ $lead->id }}</span>
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold">
                            {{ substr($lead->assignedTo->name ?? '?', 0, 1) }}
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
