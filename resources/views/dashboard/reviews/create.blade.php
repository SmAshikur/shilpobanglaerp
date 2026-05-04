@extends('layouts.dashboard')

@section('header', 'Add Testimonial')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('dashboard.reviews') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Reviews
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
        <div class="p-8 md:p-12">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Add Feedback</h3>
                    <p class="text-slate-500">Log a new client testimonial manually</p>
                </div>
            </div>

            <form action="{{ route('dashboard.reviews') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Client Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="client_name" required placeholder="John Smith" 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-300">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Client Designation</label>
                        <input type="text" name="client_designation" placeholder="e.g. CEO at TechHub" 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-300">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Rating <span class="text-rose-500">*</span></label>
                        <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100" x-data="{ rating: 5 }">
                            <input type="hidden" name="rating" :value="rating">
                            <template x-for="i in 5">
                                <button type="button" @click="rating = i" class="transition-transform hover:scale-125 focus:outline-none">
                                    <svg class="w-8 h-8" :class="i <= rating ? 'text-amber-400 fill-current' : 'text-slate-300 fill-none stroke-current'" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="space-y-2" x-data="{ preview: null }">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Client Avatar</label>
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-slate-100 overflow-hidden border border-slate-200">
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!preview">
                                    <div class="w-full h-full flex items-center justify-center text-slate-300"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></div>
                                </template>
                            </div>
                            <input type="file" name="image_file" @change="preview = URL.createObjectURL($event.target.files[0])"
                                   class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700 ml-1">Review Content <span class="text-rose-500">*</span></label>
                    <textarea name="review_text" rows="5" required placeholder="What did the client say about your work?" 
                              class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-300 resize-none"></textarea>
                </div>

                <div class="pt-4 text-right">
                    <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all duration-300 shadow-xl shadow-indigo-200 transform hover:-translate-y-1">
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
