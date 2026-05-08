@extends('layouts.dashboard')

@section('header', 'Team Member Profile')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ route('dashboard.team') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Team
        </a>
        <div class="flex gap-3">
            <a href="{{ route('dashboard.team.edit', $member) }}" class="px-6 py-2.5 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition shadow-lg shadow-amber-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Edit Profile
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
        <div class="grid lg:grid-cols-12">
            <!-- Profile Info -->
            <div class="lg:col-span-5 bg-slate-50/50 p-10 lg:p-14 border-r border-slate-100 flex flex-col items-center text-center">
                <div class="relative mb-8">
                    <div class="w-48 h-48 rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white ring-1 ring-slate-100">
                        @if($member->image)
                            <img src="{{ asset('storage/'.$member->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-indigo-100 flex items-center justify-center text-indigo-400">
                                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                            </div>
                        @endif
                    </div>
                    <!-- Status Badge -->
                    <div class="absolute -bottom-2 -right-2 px-4 py-1.5 rounded-2xl text-[10px] font-black uppercase tracking-widest {{ $member->is_active ? 'bg-emerald-500 shadow-emerald-200' : 'bg-slate-400 shadow-slate-200' }} text-white shadow-lg">
                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                    </div>
                </div>

                <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $member->name }}</h3>
                <p class="text-indigo-600 font-bold mt-2 uppercase tracking-widest text-sm">{{ $member->position }}</p>

                <div class="flex gap-4 mt-8">
                    @if($member->facebook_url)
                        <a href="{{ $member->facebook_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-blue-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if($member->linkedin_url)
                        <a href="{{ $member->linkedin_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-blue-700 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif
                    @if($member->twitter_url)
                        <a href="{{ $member->twitter_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-sky-500 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                </div>

                <div class="w-full mt-10 pt-10 border-t border-slate-200/60 grid grid-cols-2 gap-4">
                    <div class="text-left">
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Added Date</span>
                        <span class="text-sm font-bold text-slate-700">{{ $member->created_at->format('d M, Y') }}</span>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Visibility</span>
                        <span class="text-sm font-bold text-slate-700">{{ $member->is_featured ? 'Home Page' : 'Internal Only' }}</span>
                    </div>
                </div>
            </div>

            <!-- Biography Area -->
            <div class="lg:col-span-7 p-10 lg:p-14">
                <h4 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Biography & Experience</h4>
                <div class="prose prose-slate prose-lg max-w-none">
                    <p class="text-slate-600 leading-relaxed italic">
                        @if($member->bio)
                            {!! nl2br(e($member->bio)) !!}
                        @else
                            No biography has been added for this team member yet.
                        @endif
                    </p>
                </div>

                @include('dashboard.partials.extra-details', ['model' => $member])

                <div class="mt-12 p-8 bg-indigo-50/50 rounded-3xl border border-indigo-100/50">
                    <h5 class="text-indigo-900 font-bold mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Admin Note
                    </h5>
                    <p class="text-sm text-indigo-700 leading-relaxed">
                        This profile is currently <strong>{{ $member->is_active ? 'Visible' : 'Hidden' }}</strong> on the frontend. 
                        @if($member->is_featured)
                            It is also marked as <strong>Featured</strong> and will appear on the landing page team section.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
