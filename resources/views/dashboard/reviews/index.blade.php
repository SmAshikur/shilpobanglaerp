@extends('layouts.dashboard')

@section('header', 'Client Reviews')

@section('content')
<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Testimonials</h3>
            <p class="text-sm text-slate-500">Manage feedback from your satisfied clients</p>
        </div>
        <a href="{{ route('dashboard.reviews.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
            Add New Review
        </a>
    </div>

    <!-- Reviews Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($reviews as $review)
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 group hover:shadow-xl transition-all duration-500 relative overflow-hidden">
            <!-- Decorative Quote Icon -->
            <div class="absolute -top-4 -right-4 w-24 h-24 text-slate-50 opacity-[0.03] group-hover:opacity-10 transition-opacity">
                <svg fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.899 14.899 16.017 16 16.017H19C19.552 16.017 20 15.569 20 15.017V10.017C20 9.465 19.552 9.017 19 9.017H15C14.448 9.017 14 8.569 14 8.017V4.017C14 3.465 14.448 3.017 15 3.017H21C21.552 3.017 22 3.465 22 4.017V15.017C22 18.33 19.33 21 16 21H14.017ZM3.017 21L3.017 18C3.017 16.899 3.899 16.017 5 16.017H8C8.552 16.017 9 15.569 9 15.017V10.017C9 9.465 8.552 9.017 8 9.017H4C3.448 9.017 3 8.569 3 8.017V4.017C3 3.465 3.448 3.017 4 3.017H10C10.552 3.017 11 3.465 11 4.017V15.017C11 18.33 8.33 21 5 21H3.017Z" /></svg>
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex gap-1 text-amber-400">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 {{ $i < $review->rating ? 'fill-current' : 'text-slate-200 fill-none stroke-current' }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                    @endfor
                </div>
                <form action="{{ route('dashboard.reviews.destroy', $review) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" onclick="return confirm('Remove this review?')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </form>
            </div>

            <div class="relative z-10">
                <p class="text-slate-600 italic leading-relaxed mb-8">"{{ $review->review_text }}"</p>
                
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white shadow-md bg-slate-50">
                        @if($review->client_image)
                            <img src="{{ asset('storage/'.$review->client_image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-indigo-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">{{ $review->client_name }}</h4>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $review->client_designation ?? 'Verified Client' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-[2rem] p-20 text-center border border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
            </div>
            <h4 class="text-lg font-bold text-slate-800">No Reviews Yet</h4>
            <p class="text-sm text-slate-500 mt-1">When clients leave feedback, they will appear here. You can also manually add them.</p>
            <a href="{{ route('dashboard.reviews.create') }}" class="mt-6 inline-block px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition">Add Your First Review</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
