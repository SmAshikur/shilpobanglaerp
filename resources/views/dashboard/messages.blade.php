@extends('layouts.dashboard')

@section('header', 'Messages Inbox')

@section('content')
<div class="space-y-6">
    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-xl overflow-hidden transition-all">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-white/5">
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Sender Details</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Subject & Topic</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Message Content</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                    @forelse($messages as $msg)
                    <tr class="{{ $msg->is_read ? 'bg-white dark:bg-slate-900' : 'bg-indigo-50/30 dark:bg-indigo-500/5' }} hover:bg-slate-50/80 dark:hover:bg-white/5 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 font-bold text-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                    {{ substr($msg->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-white">{{ $msg->name }}</div>
                                    <div class="text-[10px] font-medium text-slate-400 dark:text-slate-500">{{ $msg->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-tighter rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition">
                                {{ $msg->subject }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-1 max-w-sm group-hover:line-clamp-none transition-all duration-300">{{ $msg->message }}</p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase">{{ $msg->created_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-200 dark:text-slate-700">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <h4 class="font-bold text-slate-800 dark:text-white">Your inbox is empty</h4>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">New messages from your website contact form will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
        <div class="p-8 border-t border-slate-100 dark:border-white/5 bg-slate-50/30 dark:bg-slate-800/50">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
