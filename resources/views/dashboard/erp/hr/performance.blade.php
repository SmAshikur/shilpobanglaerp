@extends('layouts.dashboard')

@section('header', 'Employee Performance')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Performance Reviews</h2>
            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">Rate and give feedback to your employees</p>
        </div>
        <button onclick="document.getElementById('addPerformanceModal').showModal()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
            Add Review
        </button>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($performances as $review)
        <div class="p-8 bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center font-bold text-lg">
                    {{ substr($review->employee->name, 0, 1) }}
                </div>
                <div>
                    <h4 class="font-bold text-slate-800 dark:text-white">{{ $review->employee->name }}</h4>
                    <p class="text-xs text-slate-500">{{ $review->review_date }}</p>
                </div>
            </div>
            
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-black uppercase text-slate-400 tracking-widest">Rating</span>
                    <span class="text-sm font-black text-indigo-600">{{ $review->rating }}/10</span>
                </div>
                <div class="w-full h-2 bg-slate-50 dark:bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-600" style="width: {{ $review->rating * 10 }}%"></div>
                </div>
            </div>
            
            <p class="text-sm text-slate-600 dark:text-slate-400 italic">"{{ $review->feedback }}"</p>
        </div>
        @empty
        <div class="md:col-span-3 p-20 text-center bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-white/5">
            <p class="text-slate-400">No performance reviews yet.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal -->
<dialog id="addPerformanceModal" class="p-0 rounded-[2.5rem] bg-white dark:bg-slate-900 shadow-2xl backdrop:backdrop-blur-sm border border-slate-100 dark:border-white/5">
    <div class="p-8 w-full max-w-md">
        <h3 class="text-xl font-bold mb-6">Add Performance Review</h3>
        <form action="{{ route('dashboard.erp.performance.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Employee</label>
                <select name="employee_id" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Rating (1-10)</label>
                <input type="number" name="rating" min="1" max="10" required class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Feedback</label>
                <textarea name="feedback" rows="3" class="w-full px-5 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-none outline-none font-medium resize-none"></textarea>
            </div>
            <input type="hidden" name="review_date" value="{{ date('Y-m-d') }}">
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white font-bold rounded-xl">Save Review</button>
                <button type="button" onclick="document.getElementById('addPerformanceModal').close()" class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
