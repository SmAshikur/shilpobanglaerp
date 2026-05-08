@extends('layouts.dashboard')

@section('header', 'Create Event')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('dashboard.events') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Events
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
        <div class="p-8 md:p-12">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">New Event Profile</h3>
                    <p class="text-slate-500">Create the event container first, then you can add photos and videos</p>
                </div>
            </div>

            <form action="{{ route('dashboard.events') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Event Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" required placeholder="e.g. Annual Tech Summit 2024" 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-300">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Event Date</label>
                        <input type="date" name="event_date" 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-300">
                    </div>
                </div>

                <div class="space-y-2" x-data="{ preview: null }">
                    <label class="block text-sm font-bold text-slate-700 ml-1">Main Cover / Thumbnail</label>
                    <div class="relative group">
                        <input type="file" name="thumbnail_file" @change="preview = URL.createObjectURL($event.target.files[0])"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full py-12 border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-slate-50 group-hover:bg-slate-100 group-hover:border-indigo-300 transition-all duration-300 flex flex-col items-center justify-center text-center">
                            <template x-if="!preview">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-white rounded-3xl shadow-sm flex items-center justify-center mb-4 text-slate-400 group-hover:text-indigo-500 transition-colors">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-600">Choose event cover photo</p>
                                    <p class="text-xs text-slate-400 mt-2">Max file size 2MB</p>
                                </div>
                            </template>
                            <template x-if="preview">
                                <div class="relative w-2/3 aspect-video rounded-2xl overflow-hidden shadow-xl border-4 border-white">
                                    <img :src="preview" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <p class="text-white font-bold">Replace Cover</p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700 ml-1">Short Description</label>
                    <textarea name="description" rows="4" placeholder="Briefly describe what this event is about..." 
                              class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-300 resize-none"></textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-8 border-t border-slate-100 pt-8 mt-8">
                    <label class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-100 transition">
                        <div>
                            <span class="block text-sm font-bold text-slate-700">Active Status</span>
                            <span class="block text-xs text-slate-500 mt-1">Show this item on the frontend</span>
                        </div>
                        <div class="relative">
                            <input type="checkbox" name="is_active" value="1" checked class="peer sr-only">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </div>
                    </label>
                    <label class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-100 transition">
                        <div>
                            <span class="block text-sm font-bold text-slate-700">Featured</span>
                            <span class="block text-xs text-slate-500 mt-1">Show this item on the landing page</span>
                        </div>
                        <div class="relative">
                            <input type="checkbox" name="is_featured" value="1" class="peer sr-only">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </div>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all duration-300 shadow-xl shadow-indigo-200 transform hover:-translate-y-1">
                        Create Event & Continue &rarr;
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
