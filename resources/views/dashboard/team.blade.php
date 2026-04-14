@extends('layouts.dashboard')

@section('header', 'Manage Team')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
    <!-- Add Team Member Form -->
    <div class="lg:col-span-1">
        <div class="bg-white p-10 rounded-[2rem] border border-slate-100 shadow-xl sticky top-8">
            <h3 class="text-xl font-bold text-indigo-900 mb-8 flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-11-5a4 4 0 118 0 4 4 0 01-8 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                Add Member
            </h3>
            
            <form action="{{ route('dashboard.team') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Member Photo</label>
                    <input type="file" name="image_file" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Full Name</label>
                    <input type="text" name="name" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition" placeholder="John Doe">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Position</label>
                    <input type="text" name="position" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition" placeholder="CEO / Designer">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">Facebook URL</label>
                    <input type="url" name="facebook_url" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition">
                </div>
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/20">Add Member</button>
            </form>
        </div>
    </div>

    <!-- Team Members List -->
    <div class="lg:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($team as $member)
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col items-center">
                <div class="w-24 h-24 bg-indigo-50 rounded-full mb-6 overflow-hidden border-4 border-slate-50">
                    @if($member->image)
                        <img src="{{ asset('storage/'.$member->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-indigo-600 text-2xl font-bold">{{ substr($member->name, 0, 1) }}</div>
                    @endif
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-1">{{ $member->name }}</h4>
                <p class="text-indigo-600 text-sm font-bold mb-6 tracking-widest uppercase">{{ $member->position }}</p>
                <form action="{{ route('dashboard.team.destroy', $member) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-50 text-red-500 rounded-full text-xs font-bold uppercase transition hover:bg-red-500 hover:text-white" onclick="return confirm('Wait! are you sure?')">Remove</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
