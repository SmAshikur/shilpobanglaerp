@extends('layouts.dashboard')

@section('header', 'Services List')

@section('content')
<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Available Services</h3>
            <p class="text-sm text-slate-500">Manage and view all services offered by your business</p>
        </div>
        <a href="{{ route('dashboard.services.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
            Add New Service
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 uppercase tracking-widest">Service Info</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Icon</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 uppercase tracking-widest">Description</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($services as $service)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 shrink-0 rounded-2xl bg-indigo-50 overflow-hidden border border-slate-100">
                                    @if($service->image)
                                        <img src="{{ asset('storage/'.$service->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-indigo-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 group-hover:text-indigo-600 transition">{{ $service->title }}</h4>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter bg-slate-100 px-2 py-0.5 rounded">ID: #{{ str_pad($service->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center">
                            @if($service->icon)
                                <span class="inline-flex items-center justify-center w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl font-mono text-xs">{{ $service->icon }}</span>
                            @else
                                <span class="text-slate-300 text-xs italic">No Icon</span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm text-slate-600 line-clamp-2 max-w-md">{{ $service->description }}</p>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('dashboard.services.destroy', $service) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" onclick="return confirm('Are you sure you want to delete this service?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                </div>
                                <h4 class="text-lg font-bold text-slate-800">No Services Yet</h4>
                                <p class="text-sm text-slate-500 max-w-xs mx-auto mt-1">Start by adding your first service to showcase on your profile.</p>
                                <a href="{{ route('dashboard.services.create') }}" class="mt-6 text-indigo-600 font-bold hover:underline">Create Service &rarr;</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
