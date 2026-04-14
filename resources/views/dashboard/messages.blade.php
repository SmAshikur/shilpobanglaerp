@extends('layouts.dashboard')

@section('header', 'Messages Inbox')

@section('content')
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-6 text-sm font-bold text-slate-600 uppercase tracking-widest">Sender</th>
                    <th class="px-8 py-6 text-sm font-bold text-slate-600 uppercase tracking-widest">Subject</th>
                    <th class="px-8 py-6 text-sm font-bold text-slate-600 uppercase tracking-widest">Message</th>
                    <th class="px-8 py-6 text-sm font-bold text-slate-600 uppercase tracking-widest">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($messages as $msg)
                <tr class="{{ $msg->is_read ? 'opacity-60' : 'bg-indigo-50/30' }} hover:bg-slate-50 transition">
                    <td class="px-8 py-6">
                        <div class="font-bold text-slate-900">{{ $msg->name }}</div>
                        <div class="text-xs text-slate-500">{{ $msg->email }}</div>
                    </td>
                    <td class="px-8 py-6 font-medium text-slate-700">{{ $msg->subject }}</td>
                    <td class="px-8 py-6 text-slate-600 text-sm max-w-md">{{ $msg->message }}</td>
                    <td class="px-8 py-6 text-slate-400 text-xs">{{ $msg->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-8 border-t border-slate-100">
        {{ $messages->links() }}
    </div>
</div>
@endsection
