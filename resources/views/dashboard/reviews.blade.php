@extends('layouts.dashboard')

@section('header', 'Client Reviews')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
    <!-- Add Review Form -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-slate-900 p-10 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-xl sticky top-8 transition-all">
            <h3 class="text-xl font-bold text-indigo-900 dark:text-white mb-8 flex items-center gap-3">
                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                Add Review
            </h3>
            
            <form action="{{ route('dashboard.reviews') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Client Photo</label>
                    <input type="file" name="image_file" class="w-full px-5 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:outline-none transition dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Client Name</label>
                    <input type="text" name="client_name" required class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition dark:text-white" placeholder="Jane Smith">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Designation</label>
                    <input type="text" name="client_designation" required class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition dark:text-white" placeholder="CEO, TechCorp">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Rating (1-5)</label>
                    <select name="rating" required class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition dark:text-white">
                        <option value="5" class="bg-white dark:bg-slate-900">5 - Excellent</option>
                        <option value="4" class="bg-white dark:bg-slate-900">4 - Very Good</option>
                        <option value="3" class="bg-white dark:bg-slate-900">3 - Good</option>
                        <option value="2" class="bg-white dark:bg-slate-900">2 - Fair</option>
                        <option value="1" class="bg-white dark:bg-slate-900">1 - Poor</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 dark:text-slate-300 mb-2">Review Message</label>
                    <textarea name="review_text" rows="4" required class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-white/5 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition dark:text-white resize-none"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/20 dark:shadow-none">Add Review</button>
            </form>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="lg:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($reviews as $review)
            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-sm flex flex-col items-start transition-all hover:shadow-lg">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-500/10 rounded-full overflow-hidden border-2 border-slate-50 dark:border-slate-800 ring-1 ring-slate-100 dark:ring-white/5">
                        @if($review->client_image)
                            <img src="{{ asset('storage/'.$review->client_image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-xl font-bold italic">{{ substr($review->client_name, 0, 1) }}</div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white leading-tight">{{ $review->client_name }}</h4>
                        <p class="text-xs text-indigo-600 dark:text-indigo-400 font-bold uppercase tracking-widest">{{ $review->client_designation }}</p>
                    </div>
                </div>
                
                <div class="flex gap-1 mb-4">
                    @for($i=1; $i<=$review->rating; $i++)
                        <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                    @endfor
                </div>

                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-8 flex-grow">"{{ $review->review_text }}"</p>
                
                <div class="w-full flex items-center justify-between pt-6 border-t border-slate-50 dark:border-white/5">
                    <span class="text-[10px] font-bold tracking-widest text-slate-300 dark:text-slate-500 uppercase">{{ $review->created_at->diffForHumans() }}</span>
                    <form action="{{ route('dashboard.reviews.destroy', $review) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-rose-400 hover:text-rose-600 dark:text-rose-500/50 dark:hover:text-rose-400 transition transform hover:scale-110" onclick="return confirm('Remove review?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
