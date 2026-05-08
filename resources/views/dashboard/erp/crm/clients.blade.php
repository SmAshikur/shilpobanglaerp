@extends('layouts.dashboard')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 dark:text-white">Clients</h1>
            <p class="text-slate-500 mt-1 text-sm">Manage all your clients in one place</p>
        </div>
        <a href="{{ route('dashboard.erp.clients.create') }}"
           class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Client
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Filters --}}
    <form method="GET" action="{{ route('dashboard.erp.clients') }}"
          class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm p-5">
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email or company…"
                   class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <select name="status" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">All Status</option>
                <option value="active"   {{ request('status')==='active'   ? 'selected':'' }}>Active</option>
                <option value="inactive" {{ request('status')==='inactive' ? 'selected':'' }}>Inactive</option>
                <option value="prospect" {{ request('status')==='prospect' ? 'selected':'' }}>Prospect</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all">Search</button>
            <a href="{{ route('dashboard.erp.clients') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 text-slate-600 dark:text-slate-400 text-sm font-bold rounded-xl transition-all">Reset</a>
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-white/5 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 dark:text-white">
                All Clients
                <span class="ml-2 text-sm font-normal text-slate-400">({{ $clients->total() }})</span>
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-white/5">
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Name</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Company</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Contact</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Industry</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($clients as $client)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black text-sm shrink-0">
                                        {{ strtoupper(substr($client->name,0,1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 dark:text-white text-sm">{{ $client->name }}</p>
                                        @if($client->website)
                                            <a href="{{ $client->website }}" target="_blank" class="text-xs text-indigo-500 hover:underline">{{ $client->website }}</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                {{ $client->company_name ?: ($client->company->name ?? '—') }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-700 dark:text-slate-300">{{ $client->email ?? '—' }}</p>
                                <p class="text-xs text-slate-400">{{ $client->phone ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $client->industry ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @php $sc=['active'=>'emerald','inactive'=>'rose','prospect'=>'amber']; $c=$sc[$client->status]??'slate'; @endphp
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-{{ $c }}-100 dark:bg-{{ $c }}-500/20 text-{{ $c }}-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-{{ $c }}-500"></span>
                                    {{ ucfirst($client->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('dashboard.erp.clients.edit', $client) }}"
                                       class="p-1.5 text-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('dashboard.erp.clients.destroy', $client) }}" method="POST"
                                          onsubmit="return confirm('Delete {{ $client->name }}?')">
                                        @csrf @method('DELETE')
                                        <button class="p-1.5 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                No clients found.
                                <a href="{{ route('dashboard.erp.clients.create') }}" class="text-indigo-500 hover:underline ml-1">Add your first client →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-5 bg-slate-50 dark:bg-white/5">{{ $clients->links() }}</div>
    </div>
</div>
@endsection
