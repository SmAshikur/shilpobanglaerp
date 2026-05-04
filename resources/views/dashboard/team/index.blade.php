@extends('layouts.dashboard')

@section('header', 'Team Management')

@section('content')
<div class="space-y-6">
    <!-- Action Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Team Members</h3>
            <p class="text-sm text-slate-500">Manage your experts and professional staff members</p>
        </div>
        <a href="{{ route('dashboard.team.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            Add Team Member
        </a>
    </div>

    <!-- Team Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($team as $member)
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
            <div class="relative h-64 overflow-hidden">
                @if($member->image)
                    <img src="{{ asset('storage/'.$member->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                    <div class="flex gap-2">
                        @if($member->facebook_url) <span class="w-8 h-8 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center text-white"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></span> @endif
                        @if($member->linkedin_url) <span class="w-8 h-8 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center text-white"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0z"/></svg></span> @endif
                    </div>
                </div>
            </div>
            <div class="p-8 relative">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-xl font-bold text-slate-800">{{ $member->name }}</h4>
                        <p class="text-indigo-600 font-semibold text-sm">{{ $member->position }}</p>
                    </div>
                    <form action="{{ route('dashboard.team.destroy', $member) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" onclick="return confirm('Remove this team member?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
                <p class="text-sm text-slate-500 mt-4 line-clamp-2 leading-relaxed">{{ $member->bio }}</p>
                <div class="mt-6 pt-6 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Added on {{ $member->created_at->format('M d, Y') }}</span>
                    <a href="#" class="text-xs font-bold text-indigo-600 hover:underline">Edit Profile</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-[2rem] p-20 text-center border border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <h4 class="text-lg font-bold text-slate-800">No Team Members</h4>
            <p class="text-sm text-slate-500 mt-1">Add your team members to introduce your experts to the world.</p>
            <a href="{{ route('dashboard.team.create') }}" class="mt-6 inline-block px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition">Add Member Now</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
