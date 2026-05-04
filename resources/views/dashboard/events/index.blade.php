@extends('layouts.dashboard')

@section('header', 'Events & Gallery')

@section('content')
<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Event Management</h3>
            <p class="text-sm text-slate-500">Organize and showcase your business events and highlights</p>
        </div>
        <a href="{{ route('dashboard.events.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Create New Event
        </a>
    </div>

    <!-- Events List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="relative h-48 overflow-hidden">
                @if($event->thumbnail)
                    <img src="{{ asset('storage/'.$event->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                    </div>
                @endif
                <div class="absolute top-4 right-4">
                    <form action="{{ route('dashboard.events.destroy', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-8 h-8 bg-white/90 backdrop-blur text-rose-500 rounded-lg flex items-center justify-center shadow-sm hover:bg-rose-500 hover:text-white transition" onclick="return confirm('Delete event and all its media?')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-8">
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                        {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('M d, Y') : 'Ongoing' }}
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $event->media_count ?? 0 }} Items</span>
                </div>
                <h4 class="text-xl font-bold text-slate-800 mb-2 truncate">{{ $event->title }}</h4>
                <p class="text-sm text-slate-500 line-clamp-2 mb-6">{{ $event->description }}</p>
                
                <a href="{{ route('dashboard.events.show', $event) }}" class="flex items-center justify-center gap-2 w-full py-3 bg-slate-50 text-slate-700 font-bold text-sm rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    Manage Gallery
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-[2rem] p-20 text-center border border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </div>
            <h4 class="text-lg font-bold text-slate-800">No Events Created</h4>
            <p class="text-sm text-slate-500 mt-1">Capture your business milestones and display them in a beautiful gallery.</p>
            <a href="{{ route('dashboard.events.create') }}" class="mt-6 inline-block px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition">Create Event Now</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
