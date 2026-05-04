@extends('layouts.dashboard')

@section('header', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-8 mb-12">
    <!-- ... same ... -->
    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm flex flex-col justify-between transition-all hover:shadow-lg">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <span class="text-slate-500 dark:text-slate-400 font-bold text-sm">Services</span>
        </div>
        <div class="flex items-end justify-between">
            <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $serviceCount }}</span>
            <span class="text-xs bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 px-3 py-1 rounded-full font-bold">Live</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm flex flex-col justify-between transition-all hover:shadow-lg">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </div>
            <span class="text-slate-500 dark:text-slate-400 font-bold text-sm">Messages</span>
        </div>
        <div class="flex items-end justify-between">
            <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $contactCount }}</span>
            <span class="text-xs bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full font-bold">New</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm flex flex-col justify-between transition-all hover:shadow-lg">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <span class="text-slate-500 dark:text-slate-400 font-bold text-sm">Team</span>
        </div>
        <div class="flex items-end justify-between">
            <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $teamCount }}</span>
            <span class="text-xs bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 px-3 py-1 rounded-full font-bold">Active</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm flex flex-col justify-between transition-all hover:shadow-lg">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-orange-50 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
            </div>
            <span class="text-slate-500 dark:text-slate-400 font-bold text-sm">Reviews</span>
        </div>
        <div class="flex items-end justify-between">
            <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $reviewCount }}</span>
            <span class="text-xs bg-orange-50 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 px-3 py-1 rounded-full font-bold">Stars</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm flex flex-col justify-between transition-all hover:shadow-lg">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
            </div>
            <span class="text-slate-500 dark:text-slate-400 font-bold text-sm">Portfolio</span>
        </div>
        <div class="flex items-end justify-between">
            <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $portfolioCount }}</span>
            <span class="text-xs bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 px-3 py-1 rounded-full font-bold">Projects</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm flex flex-col justify-between transition-all hover:shadow-lg">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
            <span class="text-slate-500 dark:text-slate-400 font-bold text-sm">Gallery</span>
        </div>
        <div class="flex items-end justify-between">
            <span class="text-5xl font-extrabold text-slate-900 dark:text-white">{{ $eventCount }}</span>
            <span class="text-xs bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 px-3 py-1 rounded-full font-bold">Events</span>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-white/5 shadow-sm overflow-hidden transition-all">
    <div class="p-8 border-b border-slate-50 dark:border-white/5 flex justify-between items-center">
        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Recent Contact Messages</h3>
        <a href="{{ route('dashboard.messages') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:text-indigo-700 dark:hover:text-indigo-300 transition text-sm">View All</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="px-8 py-4">Sender</th>
                    <th class="px-8 py-4">Subject</th>
                    <th class="px-8 py-4">Date</th>
                    <th class="px-8 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-white/5 font-medium">
                @forelse($recentContacts as $contact)
                <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition">
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-slate-900 dark:text-white font-bold">{{ $contact->name }}</span>
                            <span class="text-slate-400 dark:text-slate-500 text-xs">{{ $contact->email }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-slate-600 dark:text-slate-300 text-sm">{{ $contact->subject ?? 'No Subject' }}</td>
                    <td class="px-8 py-6 text-slate-400 dark:text-slate-500 text-sm">{{ $contact->created_at->format('M d, Y') }}</td>
                    <td class="px-8 py-6 text-right">
                        <a href="{{ route('dashboard.messages') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-200 dark:hover:bg-indigo-600 dark:hover:text-white transition font-bold text-xs ring-1 ring-inset ring-slate-200 dark:ring-white/5">View Message</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-12 text-center text-slate-400 dark:text-slate-600 italic">No messages yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
