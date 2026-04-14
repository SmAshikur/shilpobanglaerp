<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $profile->meta_title ?? (($profile->company_name ?? 'Dynamic') . ' | Professional Business Profile') }}</title>
        <meta name="description" content="{{ $profile->meta_description ?? 'Professional business profile and services' }}">
        <meta name="keywords" content="{{ $profile->meta_keywords ?? 'business, services, creative' }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
            .dark-glass { background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900 scroll-smooth">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed bottom-10 right-10 z-[100] bg-indigo-600 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 transition-all" x-transition:enter="translate-y-20 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="translate-y-10 opacity-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span class="font-bold">{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 opacity-70 hover:opacity-100">&times;</button>
            </div>
        @endif
        @yield('content')
    </body>
</html>
