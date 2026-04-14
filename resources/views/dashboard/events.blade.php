@extends('layouts.dashboard')

@section('header', 'Gallery & Events Manager')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
    <!-- Create Event Form -->
    <div class="lg:col-span-1">
        <div class="bg-white p-10 rounded-[2rem] border border-slate-100 shadow-xl sticky top-8">
            <h3 class="text-xl font-bold text-indigo-900 mb-8 flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                New Event
            </h3>
            
            <form action="{{ route('dashboard.events') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Album Thumbnail</label>
                    <input type="file" name="thumbnail_file" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Event Title</label>
                    <input type="text" name="title" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition" placeholder="Corporate Picnic">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Event Date</label>
                    <input type="date" name="event_date" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Short Description</label>
                    <textarea name="description" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition" placeholder="About the event..."></textarea>
                </div>
                
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/20">Create Album</button>
            </form>
        </div>
    </div>

    <!-- Events List & Media Manager -->
    <div class="lg:col-span-3">
        <div class="grid grid-cols-1 gap-12">
            @foreach($events as $event)
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden" x-data="{ showAdd: false }">
                <div class="p-8 bg-slate-50 border-b flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-12 bg-indigo-50 rounded-xl overflow-hidden border border-slate-200">
                            @if($event->thumbnail)
                                <img src="{{ asset('storage/'.$event->thumbnail) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-slate-900">{{ $event->title }}</h4>
                            <p class="text-slate-500 text-sm italic">{{ $event->event_date }} — {{ count($event->media) }} Items</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <button @click="showAdd = !showAdd" class="px-5 py-2.5 bg-indigo-600 text-white text-xs font-bold uppercase tracking-widest rounded-full hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/20">Add Media</button>
                        <form action="{{ route('dashboard.events.destroy', $event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-400 hover:text-red-600 transition" onclick="return confirm('Delete event and all media?')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Media Grid -->
                <div class="p-8 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @foreach($event->media as $media)
                    <div class="group relative aspect-square rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
                        @if($media->type == 'image')
                            <img src="{{ asset('storage/'.$media->path) }}" class="w-full h-full object-cover">
                        @elseif($media->type == 'video')
                            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-900">
                                <svg class="w-8 h-8 text-white/50" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" /></svg>
                                <span class="text-[8px] text-white/40 uppercase mt-2 font-bold">{{ $media->type }}</span>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-red-600">
                                <svg class="w-8 h-8 text-white/70" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                <span class="text-[8px] text-white/70 uppercase mt-2 font-bold">YouTube</span>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-red-600/80 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center p-2 text-center">
                             <form action="{{ route('dashboard.media.destroy', $media) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white hover:scale-125 transition-transform" onclick="return confirm('Delete this media?')">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                             </form>
                             <span class="text-[8px] text-white font-bold mt-2 uppercase text-center line-clamp-2 w-full">{{ $media->title }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Add Media Form (Hidden by Default) -->
                <div x-show="showAdd" x-transition class="p-8 bg-indigo-50/50 border-t border-indigo-100" x-data="{ mediaType: 'image' }">
                    <form action="{{ route('dashboard.events.media.store', $event) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-end gap-6">
                        @csrf
                        <div class="flex-1 min-w-[150px]">
                            <label class="block text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-widest">Media Type</label>
                            <select name="type" x-model="mediaType" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition">
                                <option value="image">Image</option>
                                <option value="youtube">YouTube (Embed Link)</option>
                                <option value="video">Local Video (File)</option>
                            </select>
                        </div>
                        
                        <div class="flex-1 min-w-[300px]" x-show="mediaType === 'image'">
                            <label class="block text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-widest">Select Image</label>
                            <input type="file" name="image_file" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl">
                        </div>

                        <div class="flex-1 min-w-[300px]" x-show="mediaType === 'video'">
                            <label class="block text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-widest">Select Video (MP4/MOV)</label>
                            <input type="file" name="video_file" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl">
                        </div>

                        <div class="flex-1 min-w-[300px]" x-show="mediaType === 'youtube'">
                            <label class="block text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-widest">YouTube Embed URL</label>
                            <input type="url" name="youtube_url" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl" placeholder="https://www.youtube.com/embed/...">
                        </div>

                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-widest">Media Title</label>
                            <input type="text" name="title" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition" placeholder="Optional title">
                        </div>
                        <button type="submit" class="px-8 py-3.5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition">Save Media</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
