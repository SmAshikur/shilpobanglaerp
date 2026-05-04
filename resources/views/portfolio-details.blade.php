@extends('layouts.app')

@section('content')

    <!-- Page Header Banner -->
    <div class="relative bg-slate-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-center bg-cover" style="background-image: url('{{ $profile->hero_bg ? asset('storage/'.$profile->hero_bg) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80' }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-slate-900/90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Portfolio Details</h1>
            <div class="flex justify-center items-center gap-3 text-sm font-medium text-blue-200">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <span>/</span>
                <a href="{{ route('home') }}#portfolio" class="hover:text-white transition">Portfolio</a>
                <span>/</span>
                <span class="text-white">{{ $project->title }}</span>
            </div>
        </div>
        <div class="absolute -bottom-1 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-12 text-white" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C52.16,93.8,105.52,85.2,156.4,72.47,211.75,58.59,266.3,42.5,321.39,56.44Z"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12 items-start">
                
                <!-- Left: Portfolio Image & Description -->
                <div class="lg:col-span-2">
                    <div class="rounded-2xl overflow-hidden shadow-2xl mb-10">
                        @if($project->image)
                            <img src="{{ asset('storage/'.$project->image) }}" class="w-full h-auto object-cover" alt="{{ $project->title }}">
                        @else
                            <div class="w-full aspect-video bg-slate-100 flex items-center justify-center">
                                <svg class="w-32 h-32 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>
                            </div>
                        @endif
                    </div>

                    <div class="prose prose-lg text-slate-600 max-w-none">
                        <h2 class="text-3xl font-bold text-slate-800 mb-6">{{ $project->title }}</h2>
                        <p>{!! nl2br(e($project->description)) !!}</p>
                    </div>
                </div>

                <!-- Right: Project Information Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-slate-50 rounded-2xl p-8 border border-gray-100 shadow-sm sticky top-28">
                        <h3 class="text-xl font-bold text-slate-800 mb-6 relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-1 after:bg-blue-600">Project Information</h3>
                        
                        <ul class="space-y-5">
                            <li class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <strong class="block text-slate-800 mb-1">Category:</strong> 
                                <span class="text-slate-600">{{ $project->service->title ?? 'General' }}</span>
                            </li>
                            <li class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <strong class="block text-slate-800 mb-1">Client:</strong> 
                                <span class="text-slate-600">{{ $project->client_name ?? 'Private Client' }}</span>
                            </li>
                            <li class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <strong class="block text-slate-800 mb-1">Project Date:</strong> 
                                <span class="text-slate-600">{{ $project->created_at->format('d M, Y') }}</span>
                            </li>
                            @if($project->project_url)
                            <li class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <strong class="block text-slate-800 mb-1">Project URL:</strong> 
                                <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">{{ $project->project_url }} <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>
                            </li>
                            @endif
                        </ul>

                        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                            <a href="{{ route('contact.page', ['portfolio_id' => $project->id]) }}" class="inline-block w-full bg-blue-600 text-white font-bold py-3 px-6 rounded hover:bg-blue-700 transition shadow-md">Discuss a similar project</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Projects Section -->
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
    <section class="py-16 bg-slate-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Related Projects</h3>
                    <div class="w-12 h-1 bg-blue-600 rounded mt-2"></div>
                </div>
                <a href="{{ route('home') }}#portfolio" class="hidden sm:flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-800 transition">View Portfolio <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedProjects as $rp)
                <div class="group relative overflow-hidden rounded-xl shadow-sm aspect-[4/3] bg-slate-100">
                    <a href="{{ route('portfolio.details', $rp->id) }}" class="block w-full h-full">
                        @if($rp->image)
                            <img src="{{ asset('storage/'.$rp->image) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $rp->title }}">
                        @endif
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-blue-900/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center text-center p-6">
                            <h4 class="text-xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition duration-300">{{ $rp->title }}</h4>
                            <span class="text-blue-200 text-sm translate-y-4 group-hover:translate-y-0 transition duration-300 delay-75">{{ $rp->service->title }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="mt-8 sm:hidden text-center">
                <a href="{{ route('home') }}#portfolio" class="inline-flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-800 transition">View Full Portfolio <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
            </div>
        </div>
    </section>
    @endif

@endsection
