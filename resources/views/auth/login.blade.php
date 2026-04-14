<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Profile Builder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white p-10 rounded-[2rem] shadow-2xl border border-slate-100">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-slate-900">Sign In</h1>
            <p class="text-slate-500 mt-2">Access your profile builder dashboard</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition @error('email') border-red-500 @enderror" placeholder="admin@admin.com">
                @error('email') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:outline-none transition" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/20">Sign In</button>
        </form>
        
        <div class="mt-10 text-center">
            <a href="/" class="text-slate-400 hover:text-indigo-600 text-sm font-medium transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Back to Site
            </a>
        </div>
    </div>
</body>
</html>
