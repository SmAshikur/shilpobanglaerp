@extends('layouts.app')

@section('content')

    <!-- Page Header Banner -->
    <div class="relative bg-slate-900 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-center bg-cover" style="background-image: url('{{ $profile->hero_bg ? asset('storage/'.$profile->hero_bg) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80' }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-slate-900/90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">{{ $sectionSettings->get('contact')?->title ?? 'Contact Us' }}</h1>
            <div class="flex justify-center items-center gap-3 text-sm font-medium text-blue-200">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <span>/</span>
                <span class="text-white">{{ $sectionSettings->get('contact')?->title ?? 'Contact Us' }}</span>
            </div>
        </div>
        <div class="absolute -bottom-1 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-12 text-white" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C52.16,93.8,105.52,85.2,156.4,72.47,211.75,58.59,266.3,42.5,321.39,56.44Z"></path>
            </svg>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white relative overflow-hidden">
        <!-- Subtle Background Pattern -->
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCI+PHBhdGggZD0iTTMwIDBMMzAgNjBNMCAzMEw2MCAzMCIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEiLz48L3N2Zz4=')"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 font-bold tracking-widest uppercase text-xs rounded-full mb-4">Get In Touch</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">{{ $sectionSettings->get('contact')?->title ?? 'Contact Us' }}</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
                <p class="mt-6 text-slate-500 text-lg max-w-2xl mx-auto font-medium">{{ $sectionSettings->get('contact')?->description ?? 'We are here to help and answer any question you might have. We look forward to hearing from you.' }}</p>
            </div>

            <!-- Centered Map -->
            <div class="mb-20 max-w-5xl mx-auto h-[450px] bg-slate-100 rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white relative group">
                @if($profile->google_map_url)
                    @if(str_contains($profile->google_map_url, '<iframe'))
                        {!! $profile->google_map_url !!}
                    @else
                        <iframe class="w-full h-full grayscale-[0.5] group-hover:grayscale-0 transition-all duration-1000 scale-105 group-hover:scale-100" src="{{ $profile->google_map_url }}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @endif
                @else
                    <iframe class="w-full h-full grayscale-[0.5] group-hover:grayscale-0 transition-all duration-1000 scale-105 group-hover:scale-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9024424301355!2d90.3912033!3d23.7508665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8bd55555555%3A0x1234567890abcdef!2sDhaka!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                @endif
                <div class="absolute inset-0 pointer-events-none shadow-[inset_0_0_100px_rgba(0,0,0,0.1)]"></div>
            </div>

            <div class="grid lg:grid-cols-12 gap-16 items-start">
                <!-- Contact Info Cards -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 hover:border-blue-200 transition-all duration-500 group">
                        <div class="w-16 h-16 bg-white text-blue-600 rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition duration-500 transform group-hover:rotate-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h4 class="font-black text-slate-900 text-xl mb-3 tracking-tight">Our Headquarters</h4>
                        <p class="text-slate-500 leading-relaxed font-medium">{{ $profile->address ?? 'A108 Adam Street, New York, NY 535022' }}</p>
                    </div>

                    <div class="p-8 bg-slate-900 rounded-[2rem] text-white shadow-xl shadow-slate-200 relative overflow-hidden group">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600 rounded-full blur-3xl opacity-20"></div>
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-blue-600/20 transform group-hover:-rotate-6 transition duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="font-black text-white text-xl mb-3 tracking-tight">Quick Connect</h4>
                        <div class="space-y-2">
                            <p class="text-slate-400 font-medium break-all">{{ $profile->email ?? 'info@example.com' }}</p>
                            <p class="text-slate-400 font-medium">{{ $profile->phone ?? '+1 5589 55488 55' }}</p>
                        </div>
                    </div>

                    @if(isset($referenceProject) && $referenceProject)
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-blue-200 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                        </div>
                        <h4 class="font-bold text-xl mb-4 relative z-10">Inquiry Reference</h4>
                        <div class="flex items-center gap-5 relative z-10 bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20">
                            @if($referenceProject->image)
                                <img src="{{ asset('storage/'.$referenceProject->image) }}" class="w-20 h-20 rounded-xl object-cover shadow-lg border-2 border-white/30">
                            @endif
                            <div>
                                <h5 class="font-bold text-white text-lg">{{ $referenceProject->title }}</h5>
                                <p class="text-blue-100 text-sm mt-1">Ref ID: #PRJ-{{ $referenceProject->id }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-8">
                    <div class="bg-white p-8 md:p-14 rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50">
                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Your Full Name</label>
                                    <input type="text" name="name" required placeholder="e.g. John Doe" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                                    <input type="email" name="email" required placeholder="e.g. john@example.com" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Message Subject</label>
                                @php
                                    $defaultSubject = isset($referenceProject) && $referenceProject ? "Discussing similar project: " . $referenceProject->title : "";
                                @endphp
                                <input type="text" name="subject" value="{{ $defaultSubject }}" required placeholder="What are you inquiring about?" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Detailed Message</label>
                                <textarea name="message" rows="5" required placeholder="Write your message here..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition duration-500 font-medium resize-none"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white font-black py-5 rounded-2xl hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-blue-600/25 flex items-center justify-center gap-3 group">
                                <span class="tracking-widest uppercase text-sm">Send Your Message</span>
                                <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
