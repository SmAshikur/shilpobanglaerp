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
        <div class="flex-shrink-0 w-80 snap-start" ondragover="event.preventDefault()" ondrop="drop(event, '{{ $stage }}')">
            <div class="mb-4 flex items-center justify-between px-2">
                <h3 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">{{ $stage }}</h3>
                <span class="px-2.5 py-1 bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 rounded-lg text-[10px] font-black uppercase tracking-widest">{{ count($leads[$stage] ?? []) }}</span>
            </div>
            
            <div class="space-y-4 min-h-[600px] p-4 bg-slate-50/50 dark:bg-white/5 rounded-[2.5rem] border-2 border-dashed border-slate-200 dark:border-white/10 transition-colors">
                @forelse($leads[$stage] ?? [] as $lead)
                <div id="lead-{{ $lead->id }}" draggable="true" ondragstart="drag(event, {{ $lead->id }})" class="group p-6 bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm hover:shadow-xl hover:border-indigo-500/50 transition-all cursor-grab active:cursor-grabbing relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        @if($lead->stage !== 'won')
                        <form action="{{ route('dashboard.erp.leads.convert', $lead) }}" method="POST" onsubmit="return confirm('Convert this lead to a Client?')">
                            @csrf
                            <button type="submit" class="text-emerald-500 hover:text-emerald-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('dashboard.erp.leads.edit', $lead) }}" class="text-slate-400 hover:text-indigo-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                    </div>
                    <h4 class="font-bold text-slate-800 dark:text-white mb-1 pr-6">{{ $lead->name }}</h4>
                    <p class="text-[10px] font-black uppercase text-slate-400 dark:text-slate-500 mb-4">{{ $lead->company->name }}</p>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-[10px] font-black text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20">
                                {{ substr($lead->assignedTo->name ?? '?', 0, 1) }}
                            </div>
                            <span class="text-[10px] font-bold text-slate-500">{{ $lead->assignedTo->name ?? 'Unassigned' }}</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-300 dark:text-slate-600">#{{ $lead->id }}</span>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function drag(ev, leadId) {
        ev.dataTransfer.setData("leadId", leadId);
        ev.target.style.opacity = '0.5';
    }

    function drop(ev, stage) {
        ev.preventDefault();
        const leadId = ev.dataTransfer.getData("leadId");
        const element = document.getElementById('lead-' + leadId);
        element.style.opacity = '1';

        // Show loading state or immediately move visually
        const dropzone = ev.target.closest('.space-y-4');
        if (dropzone) {
            dropzone.appendChild(element);
        }

        // AJAX update
        fetch(`/dashboard/erp/leads/${leadId}/update-stage`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ stage: stage })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Optional: Show a toast or notification
                console.log('Stage updated to ' + stage);
            } else {
                alert('Failed to update stage');
                location.reload(); // Revert on failure
            }
        })
        .catch(error => {
            console.error('Error:', error);
            location.reload();
        });
    }
</script>
@endsection
