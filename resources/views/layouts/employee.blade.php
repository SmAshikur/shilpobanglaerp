<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': darkMode }" x-data="{ darkMode: localStorage.getItem('dash_theme') === 'dark' }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Portal - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-text { transition: opacity 0.2s, width 0.2s; white-space: nowrap; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100" x-data="{ 
    sidebarOpen: false, 
    sidebarCollapsed: localStorage.getItem('emp_sidebarCollapsed') === 'true',
    darkMode: localStorage.getItem('dash_theme') === 'dark',
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('dash_theme', this.darkMode ? 'dark' : 'light');
    }
}" x-init="$watch('sidebarCollapsed', val => localStorage.setItem('emp_sidebarCollapsed', val))">
    
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
               class="fixed inset-y-0 left-0 z-30 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-white/5 flex flex-col transition-all duration-300 ease-in-out lg:static lg:translate-x-0 shadow-xl lg:shadow-none overflow-hidden">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-20 px-4 lg:px-6 border-b border-slate-100 dark:border-white/5 overflow-hidden relative">
                <div class="flex items-center gap-3 w-full">
                    @if($motherCompany?->logo || ($profileInfo->logo ?? null) || ($profile->logo ?? null))
                        <img src="{{ asset('storage/'.($motherCompany?->logo ?? $profileInfo->logo ?? $profile->logo)) }}" class="w-10 h-10 rounded-xl object-cover shadow-lg" :class="sidebarCollapsed ? 'mx-auto' : ''">
                    @else
                        <div class="w-10 h-10 shrink-0 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30">
                            E
                        </div>
                    @endif
                    <span class="text-xl font-bold tracking-tight text-slate-800 dark:text-white sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Portal</span>
                </div>
                
                <button @click="sidebarOpen = false" class="lg:hidden p-2 text-slate-400 hover:text-slate-600 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
                <p x-show="!sidebarCollapsed" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-4">Main Menu</p>
                
                <a href="{{ route('employee.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 text-sm font-semibold {{ request()->routeIs('employee.dashboard') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl transition-all group" :title="sidebarCollapsed ? 'My Dashboard' : ''">
                    <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('employee.dashboard') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">My Dashboard</span>
                </a>

                <a href="{{ route('employee.attendance') }}" class="flex items-center gap-3 px-4 py-3.5 text-sm font-semibold {{ request()->routeIs('employee.attendance*') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl transition-all group" :title="sidebarCollapsed ? 'Attendance' : ''">
                    <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('employee.attendance*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">Attendance</span>
                </a>

                <a href="{{ route('employee.profile') }}" class="flex items-center gap-3 px-4 py-3.5 text-sm font-semibold {{ request()->routeIs('employee.profile') ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5' }} rounded-xl transition-all group" :title="sidebarCollapsed ? 'My Profile' : ''">
                    <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('employee.profile') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    <span class="sidebar-text" :class="sidebarCollapsed ? 'lg:opacity-0 lg:hidden' : 'opacity-100'">My Profile</span>
                </a>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-100 dark:border-white/5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3.5 text-sm font-semibold text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-xl transition-all" :title="sidebarCollapsed ? 'Logout' : ''">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
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
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-white/5 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    
                    <!-- Desktop Toggle Button -->
                    <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-white/5 rounded-xl border border-slate-200 dark:border-white/10 transition-all">
                        <svg class="w-5 h-5 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </button>

                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white tracking-tight">@yield('header', 'Employee Dashboard')</h2>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- Theme Switcher -->
                    <button @click="toggleTheme()" class="p-2 rounded-lg bg-slate-50 dark:bg-white/5 text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-white/5 hover:bg-slate-100 transition-all">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                    </button>

                    <div class="flex items-center gap-3">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 font-medium">Employee</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-700 font-bold border-2 border-white dark:border-slate-800 shadow-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-10">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-500 text-white rounded-2xl flex items-center gap-3 shadow-lg shadow-emerald-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
