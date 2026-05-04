@extends('layouts.dashboard')

@section('header', 'Manage Event Media')

@section('content')
<div class="space-y-10">
    <!-- Back Link -->
    <div class="mb-2">
        <a href="{{ route('dashboard.events') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Events
        </a>
    </div>

    <!-- Event Info Header -->
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row gap-8 items-center">
        <div class="w-48 h-32 rounded-2xl overflow-hidden bg-slate-100 shrink-0 shadow-sm border border-slate-50">
            @if($event->thumbnail)
                <img src="{{ asset('storage/'.$event->thumbnail) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-slate-300"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg></div>
            @endif
        </div>
        <div class="flex-1 text-center md:text-left">
            <h2 class="text-3xl font-bold text-slate-800">{{ $event->title }}</h2>
            <p class="text-slate-500 mt-2 max-w-2xl">{{ $event->description }}</p>
            <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-4">
                <span class="flex items-center gap-2 text-xs font-bold text-slate-400 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('M d, Y') : 'Ongoing' }}
                </span>
                <span class="flex items-center gap-2 text-xs font-bold text-indigo-500 bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                    {{ $event->media->count() }} Media Items
                </span>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        <!-- Add Media Form -->
        <div class="lg:col-span-1">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl sticky top-28" x-data="{ mediaType: 'image' }">
                <h3 class="text-xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    Add Media
                </h3>
                
                <form action="{{ route('dashboard.events.media.store', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-3 ml-1">Media Type</label>
                        <div class="grid grid-cols-3 gap-2 p-1 bg-slate-50 rounded-2xl border border-slate-100">
                            <button type="button" @click="mediaType = 'image'" 
                                    :class="mediaType === 'image' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500'"
                                    class="py-2.5 text-xs font-bold rounded-xl transition-all">Image</button>
                            <button type="button" @click="mediaType = 'video'" 
                                    :class="mediaType === 'video' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500'"
                                    class="py-2.5 text-xs font-bold rounded-xl transition-all">Video</button>
                            <button type="button" @click="mediaType = 'youtube'" 
                                    :class="mediaType === 'youtube' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500'"
                                    class="py-2.5 text-xs font-bold rounded-xl transition-all">YouTube</button>
                        </div>
                        <input type="hidden" name="type" :value="mediaType">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-2 ml-1">Title (Optional)</label>
                        <input type="text" name="title" placeholder="e.g. Workshop highlight" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition">
                    </div>

                    <div x-show="mediaType === 'image'" x-cloak class="space-y-2">
                        <label class="block text-sm font-bold text-slate-800 mb-2 ml-1">Select Image</label>
                        <input type="file" name="image_file" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700">
                    </div>

                    <div x-show="mediaType === 'video'" x-cloak class="space-y-2">
                        <label class="block text-sm font-bold text-slate-800 mb-2 ml-1">Select Video File</label>
                        <input type="file" name="video_file" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700">
                        <p class="text-[10px] text-slate-400">MP4, MOV up to 20MB</p>
                    </div>

                    <div x-show="mediaType === 'youtube'" x-cloak class="space-y-2">
                        <label class="block text-sm font-bold text-slate-800 mb-2 ml-1">YouTube URL</label>
                        <input type="url" name="youtube_url" placeholder="https://youtube.com/watch?v=..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition">
                    </div>

                    <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100">Upload Media</button>
                </form>
            </div>
        </div>

        <!-- Media Gallery -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @forelse($event->media as $item)
                    <div class="relative aspect-square rounded-2xl overflow-hidden group border border-slate-100">
                        @if($item->type == 'image')
                            <img src="{{ asset('storage/'.$item->path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @elseif($item->type == 'video')
                            <video src="{{ asset('storage/'.$item->path) }}" class="w-full h-full object-cover"></video>
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="w-10 h-10 bg-black/40 backdrop-blur rounded-full flex items-center justify-center text-white">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
                                </div>
                            </div>
                        @else
                            @php 
                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $item->path, $match);
                                $youtube_id = $match[1] ?? '';
                            @endphp
                            <img src="https://img.youtube.com/vi/{{ $youtube_id }}/hqdefault.jpg" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="w-12 h-12 bg-rose-600 rounded-full flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" /></svg>
                                </div>
                            </div>
                        @endif

                        <!-- Actions Overlay -->
                        <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <form action="{{ route('dashboard.media.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-white/20 backdrop-blur text-white rounded-xl flex items-center justify-center hover:bg-rose-500 transition" onclick="return confirm('Remove this media?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-20 text-center border-2 border-dashed border-slate-100 rounded-3xl bg-slate-50/50">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                        </div>
                        <h4 class="font-bold text-slate-800">Gallery Empty</h4>
                        <p class="text-xs text-slate-400 mt-1">Upload images or add video links to populate this event gallery.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
