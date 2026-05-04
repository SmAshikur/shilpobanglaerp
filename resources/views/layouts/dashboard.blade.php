<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': darkMode }" x-data="{ darkMode: localStorage.getItem('dash_theme') === 'dark' }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Business Profile Builder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
        /* Smooth transitions for sidebar text */
        .sidebar-text { transition: opacity 0.2s, width 0.2s; white-space: nowrap; }
        
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100" x-data="{ 
    sidebarOpen: false, 
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('dash_theme', this.darkMode ? 'dark' : 'light');
    }
}" x-init="$watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val))">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false" 
             x-transition.opacity 
             class="fixed inset-0 z-20 bg-slate-900/50 backdrop-blur-sm lg:hidden"></div>

        <!-- Sidebar -->
        <aside :class="[
                sidebarOpen ? 'translate-x-0' : '-translate-x-full', 
                sidebarCollapsed ? 'lg:w-20' : 'lg:w-72'
               ]" 
               class="fixed inset-y-0 left-0 z-30 w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-white/5 flex flex-col transition-all duration-300 ease-in-out lg:static lg:translate-x-0 shadow-xl lg:shadow-none">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-20 px-4 lg:px-6 border-b border-slate-100 dark:border-white/5 overflow-hidden relative">
                <div class="flex items-center gap-3 w-full">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30">
                        B
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-800 dark:text-white sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:w-0' : 'opacity-100 w-auto'">Admin Panel</span>
                </div>
                <!-- Mobile Close Button -->
                <button @click="sidebarOpen = false" class="lg:hidden shrink-0 p-2 text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5 rounded-lg transition-colors absolute right-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto overflow-x-hidden custom-scrollbar" x-data="{ 
                activeMenu: '{{ 
                    request()->routeIs('dashboard.services*') ? 'services' : (
                    request()->routeIs('dashboard.team*') ? 'team' : (
                    request()->routeIs('dashboard.reviews*') ? 'reviews' : (
                    request()->routeIs('dashboard.portfolio*') ? 'portfolio' : (
                    request()->routeIs('dashboard.events*') ? 'events' : (
                    request()->routeIs('dashboard.section-settings*') ? 'sections' : ''
                ))))) }}'
            }">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group" :title="sidebarCollapsed ? 'Dashboard' : ''">
                    <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Dashboard</span>
                </a>

                <!-- Services Dropdown -->
                <div class="space-y-1">
                    <button @click="activeMenu = (activeMenu === 'services' ? '' : 'services')" class="w-full flex items-center justify-between px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.services*') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.services*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Services</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="activeMenu === 'services' ? 'rotate-180' : ''" :class="sidebarCollapsed ? 'lg:hidden' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeMenu === 'services' && !sidebarCollapsed" x-collapse class="pl-12 space-y-1">
                        <a href="{{ route('dashboard.services') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.services') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">List Services</a>
                        <a href="{{ route('dashboard.services.create') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.services.create') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Add Service</a>
                        <a href="{{ route('dashboard.section-settings', 'services') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'services')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Section Settings</a>
                    </div>
                </div>

                <!-- Team Dropdown -->
                <div class="space-y-1">
                    <button @click="activeMenu = (activeMenu === 'team' ? '' : 'team')" class="w-full flex items-center justify-between px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.team*') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.team*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Team</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="activeMenu === 'team' ? 'rotate-180' : ''" :class="sidebarCollapsed ? 'lg:hidden' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeMenu === 'team' && !sidebarCollapsed" x-collapse class="pl-12 space-y-1">
                        <a href="{{ route('dashboard.team') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.team') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">All Members</a>
                        <a href="{{ route('dashboard.team.create') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.team.create') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Add Member</a>
                        <a href="{{ route('dashboard.section-settings', 'team') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'team')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Section Settings</a>
                    </div>
                </div>

                <!-- Portfolio Dropdown -->
                <div class="space-y-1">
                    <button @click="activeMenu = (activeMenu === 'portfolio' ? '' : 'portfolio')" class="w-full flex items-center justify-between px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.portfolio*') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.portfolio*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
                            <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Portfolio</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="activeMenu === 'portfolio' ? 'rotate-180' : ''" :class="sidebarCollapsed ? 'lg:hidden' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeMenu === 'portfolio' && !sidebarCollapsed" x-collapse class="pl-12 space-y-1">
                        <a href="{{ route('dashboard.portfolio') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.portfolio') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">All Projects</a>
                        <a href="{{ route('dashboard.portfolio.create') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.portfolio.create') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Add Project</a>
                        <a href="{{ route('dashboard.section-settings', 'portfolio') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'portfolio')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Section Settings</a>
                    </div>
                </div>

                <!-- Reviews Dropdown -->
                <div class="space-y-1">
                    <button @click="activeMenu = (activeMenu === 'reviews' ? '' : 'reviews')" class="w-full flex items-center justify-between px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.reviews*') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.reviews*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                            <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Reviews</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="activeMenu === 'reviews' ? 'rotate-180' : ''" :class="sidebarCollapsed ? 'lg:hidden' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeMenu === 'reviews' && !sidebarCollapsed" x-collapse class="pl-12 space-y-1">
                        <a href="{{ route('dashboard.reviews') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.reviews') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">All Reviews</a>
                        <a href="{{ route('dashboard.reviews.create') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.reviews.create') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Add Review</a>
                        <a href="{{ route('dashboard.section-settings', 'reviews') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'reviews')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Section Settings</a>
                    </div>
                </div>

                <!-- Events Dropdown -->
                <div class="space-y-1">
                    <button @click="activeMenu = (activeMenu === 'events' ? '' : 'events')" class="w-full flex items-center justify-between px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.events*') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.events*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Events</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="activeMenu === 'events' ? 'rotate-180' : ''" :class="sidebarCollapsed ? 'lg:hidden' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeMenu === 'events' && !sidebarCollapsed" x-collapse class="pl-12 space-y-1">
                        <a href="{{ route('dashboard.events') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.events') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">All Events</a>
                        <a href="{{ route('dashboard.events.create') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard.events.create') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Add Event</a>
                        <a href="{{ route('dashboard.section-settings', 'events') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'events')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Section Settings</a>
                    </div>
                </div>

                <!-- Core Sections Settings -->
                <div class="pt-4 pb-2">
                    <span class="px-3 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Core Layout</span>
                </div>

                <div class="space-y-1">
                    <button @click="activeMenu = (activeMenu === 'sections' ? '' : 'sections')" class="w-full flex items-center justify-between px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.section-settings*') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.section-settings*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" /></svg>
                            <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Page Sections</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="activeMenu === 'sections' ? 'rotate-180' : ''" :class="sidebarCollapsed ? 'lg:hidden' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="activeMenu === 'sections' && !sidebarCollapsed" x-collapse class="pl-12 space-y-1">
                        <a href="{{ route('dashboard.section-settings', 'hero') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'hero')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Hero Section</a>
                        <a href="{{ route('dashboard.section-settings', 'header') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'header')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Header Top Bar</a>
                        <a href="{{ route('dashboard.section-settings', 'about') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'about')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">About Section</a>
                        <a href="{{ route('dashboard.section-settings', 'stats') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'stats')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Stats Section</a>
                        <a href="{{ route('dashboard.section-settings', 'contact') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'contact')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Contact Section</a>
                        <a href="{{ route('dashboard.section-settings', 'footer') }}" class="block py-2 text-sm {{ request()->fullUrlIs(route('dashboard.section-settings', 'footer')) ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">Footer Settings</a>
                    </div>
                </div>

                <!-- Messages -->
                <a href="{{ route('dashboard.messages') }}" class="flex items-center justify-between px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.messages') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group relative" :title="sidebarCollapsed ? 'Messages' : ''">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.messages') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                        <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Messages</span>
                    </div>
                    @php $unread = \App\Models\ContactSubmission::where('is_read', false)->count(); @endphp
                    @if($unread > 0)
                        <span :class="sidebarCollapsed ? 'lg:hidden' : ''" class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-rose-500 rounded-full">{{ $unread > 9 ? '9+' : $unread }}</span>
                        <span x-show="sidebarCollapsed" x-cloak class="hidden lg:block absolute top-2 right-2 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-white dark:border-slate-900"></span>
                    @endif
                </a>
                
                <!-- Site Config -->
                <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-3 py-3.5 text-sm font-semibold {{ request()->routeIs('dashboard.profile') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-slate-200' }} rounded-xl transition-all duration-200 group" :title="sidebarCollapsed ? 'Site Config' : ''">
                    <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard.profile') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Site Config</span>
                </a>

            </nav>
            
            <!-- Sidebar Footer (Logout) -->
            <div class="p-4 border-t border-slate-100 dark:border-white/5 flex justify-center">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center lg:justify-start gap-3 px-3 py-3.5 text-sm font-semibold text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10 hover:text-rose-700 rounded-xl transition-all duration-200 group" :title="sidebarCollapsed ? 'Logout' : ''">
                        <svg class="w-6 h-6 shrink-0 text-rose-500 group-hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-950 overflow-hidden">
            
            <!-- Top Header -->
            <header class="h-20 flex items-center justify-between px-4 lg:px-10 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-white/5 z-10 sticky top-0 shadow-sm">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <!-- Desktop Sidebar Toggle -->
                    <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:block p-2 -ml-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!sidebarCollapsed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            <path x-show="sidebarCollapsed" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div class="hidden sm:block">
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white tracking-tight">@yield('header')</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-500 font-medium mt-0.5">Manage your business profile content</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 sm:gap-5">
                    <!-- Theme Switcher -->
                    <button @click="toggleTheme()" class="p-2 rounded-lg bg-slate-50 dark:bg-white/5 text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-white/5 hover:bg-slate-100 dark:hover:bg-white/10 transition-all duration-300 shadow-sm" title="Toggle Theme">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                    </button>

                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex px-4 py-2 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-semibold text-sm rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-500/20 transition-colors items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        View Site
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="sm:hidden p-2 text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-500/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </a>
                    
                    <div class="h-8 w-px bg-slate-200 dark:bg-white/10"></div>
                    
                    <div class="flex items-center gap-3">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-500">Administrator</p>
                        </div>
                        <div class="w-10 h-10 shrink-0 rounded-full bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-700 dark:text-indigo-400 font-bold border-2 border-white dark:border-slate-800 shadow-sm overflow-hidden">
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('storage/'.auth()->user()->profile_image) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                            @endif
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 lg:p-10">
                <div class="sm:hidden mb-6">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">@yield('header')</h2>
                </div>

                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mb-8 p-4 bg-emerald-500 text-white rounded-2xl flex justify-between items-center shadow-lg shadow-emerald-500/20">
                        <div class="flex items-center gap-3">
                            <div class="p-1 bg-white/20 rounded-lg shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="font-semibold">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="p-1 hover:bg-white/20 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                @endif

                <div class="pb-10">
                    @yield('content')
                </div>
                
                <!-- Footer -->
                <footer class="mt-auto py-6 border-t border-slate-200/60 dark:border-white/5 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between text-sm text-slate-500 dark:text-slate-500">
                    <p>&copy; {{ date('Y') }} Business Profile Builder. All rights reserved.</p>
                    <p class="mt-2 sm:mt-0 flex items-center gap-1">
                        Crafted with <svg class="w-4 h-4 text-rose-500 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> for excellence
                    </p>
                </footer>
            </main>
        </div>
    </div>
</body>
</html>
