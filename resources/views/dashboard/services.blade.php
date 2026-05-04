@extends('layouts.dashboard')

@section('header', 'Manage Services')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
    <!-- Add Service Form -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-slate-900 p-10 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl sticky top-8 transition-all">
            <h3 class="text-xl font-bold text-indigo-900 dark:text-white mb-8 flex items-center gap-3">
                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Add Service
            </h3>
            
            <form action="{{ route('dashboard.services') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Service Title</label>
                    <input type="text" name="title" required class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Service Image</label>
                    <input type="file" name="image_file" class="w-full px-5 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:outline-none transition dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Icon Name (Optional)</label>
                    <input type="text" name="icon" class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Description</label>
                    <textarea name="description" rows="4" required class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition dark:text-white resize-none"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/20 dark:shadow-none">Add Service</button>
            </form>
        </div>
    </div>

    <!-- Services List -->
    <div class="lg:col-span-3">
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-sm overflow-hidden transition-all">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-white/5">
                        <th class="px-8 py-6 text-sm font-bold text-slate-600 dark:text-slate-400 uppercase tracking-widest">Image</th>
                        <th class="px-8 py-6 text-sm font-bold text-slate-600 dark:text-slate-400 uppercase tracking-widest">Service Name</th>
                        <th class="px-8 py-6 text-sm font-bold text-slate-600 dark:text-slate-400 uppercase tracking-widest">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                    @foreach($services as $service)
                    <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition group">
                        <td class="px-8 py-6">
                            <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-500/10 rounded-xl overflow-hidden ring-1 ring-slate-100 dark:ring-white/5">
                                @if($service->image)
                                    <img src="{{ asset('storage/'.$service->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-6 font-bold text-slate-700 dark:text-white">{{ $service->title }}</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <form action="{{ route('dashboard.services.destroy', $service) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-400 hover:text-rose-600 dark:text-rose-500/50 dark:hover:text-rose-400 transition transform hover:scale-110" onclick="return confirm('Are you sure?')">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
