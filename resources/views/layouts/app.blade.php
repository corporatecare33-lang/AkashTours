<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akash Tours and Travels - @yield('title', 'Your Trusted Travel Partner')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --font-bengali: 'Noto Sans Bengali', sans-serif;
            --font-english: 'Poppins', sans-serif;
        }
        body { font-family: var(--font-bengali); overflow-x: hidden; }
        .font-en { font-family: var(--font-english); }
        
        .hero-gradient { background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.85) 100%); }
        .glass-nav { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-12px); box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.15); }
        
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-slow { animation: pulse-slow 8s ease-in-out infinite; }
        
        /* FAQ Styles */
        .faq-answer { max-height: 0; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; }
        .faq-item.active .faq-answer { max-height: 500px; opacity: 1; margin-top: 1rem; }
        .faq-item.active .faq-icon { transform: rotate(180deg); }
        .faq-item { transition: all 0.3s ease; }
        .faq-item.active { border-color: #2563eb; background: #f8faff; }

        @yield('extra_styles')
    </style>
</head>
<body class="bg-[#FBFBFF] text-gray-900 selection:bg-blue-100 selection:text-blue-900">

    <!-- Navigation -->
    <header class="glass-nav sticky top-0 z-[100]">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-xl shadow-blue-100 group-hover:rotate-6 transition duration-300 font-en">A</div>
                <div>
                    <h1 class="text-2xl font-black text-blue-900 leading-none tracking-tighter font-en">Akash<span class="text-blue-600">Tours</span></h1>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest font-en">Premium Travel Service</p>
                </div>
            </a>
            <div class="hidden lg:flex space-x-10 font-bold text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">হোম</a>
                <a href="{{ route('home') }}#packages" class="hover:text-blue-600 transition">ট্যুর প্যাকেজ</a>
                <a href="{{ route('home') }}#destinations" class="hover:text-blue-600 transition">গন্তব্য</a>
                <a href="{{ route('about') }}" class="hover:text-blue-600 transition">সম্পর্কে</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-600 transition">যোগাযোগ</a>
            </div>
            <div class="flex items-center space-x-6">
                @auth
                    <div class="flex items-center space-x-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest leading-none mb-1 font-en">Welcome</p>
                            <a href="{{ route('dashboard') }}" class="text-sm font-black text-blue-900 hover:text-blue-600 transition">{{ Auth::user()->name }}</a>
                        </div>
                        <a href="{{ route('dashboard') }}" class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1h8M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 font-bold hover:text-blue-600 transition">লগইন</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-blue-700 transition shadow-xl shadow-blue-200">রেজিস্টার</a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-950 text-gray-500 py-20 mt-20">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-16">
            <div class="md:col-span-2 space-y-8">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-blue-600 rounded-[20px] flex items-center justify-center text-white font-bold text-3xl shadow-2xl shadow-blue-900/50 font-en">A</div>
                    <span class="text-white font-black text-4xl tracking-tighter font-en">Akash<span class="text-blue-600">Tours</span></span>
                </div>
                <p class="text-lg leading-relaxed max-w-md">আপনার বিশ্বস্ত ভ্রমণ সঙ্গী। আপনাদের জন্য সব সময় সেরা ট্যুর প্যাকেজ নিশ্চিত করা হয়। মাধবপুর থেকে পথচলা শুরু।</p>
                <div class="flex space-x-4">
                    <a href="https://facebook.com/akashtours" class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center hover:bg-blue-600 transition text-white group">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center hover:bg-blue-600 transition text-white group">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center hover:bg-blue-600 transition text-white group">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    </a>
                </div>
            </div>
            <div class="space-y-8">
                <h5 class="text-white font-black uppercase tracking-widest text-sm">প্রয়োজনীয় লিংক</h5>
                <ul class="space-y-4 font-bold">
                    <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition flex items-center"><svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>আমাদের সম্পর্কে</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition flex items-center"><svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>প্রাইভেসি পলিসি</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition flex items-center"><svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>শর্তাবলী</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition flex items-center"><svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>রিফান্ড পলিসি</a></li>
                </ul>
            </div>
            <div class="space-y-8">
                <h5 class="text-white font-black uppercase tracking-widest text-sm">যোগাযোগ</h5>
                <ul class="space-y-4 font-bold">
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-blue-600 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>আমীর কমপ্লেক্স, মাধবপুর বাজার, হবিগঞ্জ</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span class="font-en">01711662685</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span class="font-en">akash@akashmadhabpur.org</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container mx-auto px-6 pt-20 text-center border-t border-white/5 mt-16">
            <p class="text-xs font-black uppercase tracking-[0.4em] mb-4">&copy; 2026 Akash Tours and Travels. All rights reserved.</p>
            <p class="text-sm font-medium text-gray-600">Design and Developed By <a href="https://digitalwebars.com" target="_blank" class="text-white font-black hover:text-blue-500 transition font-en">Digital Webars</a></p>
        </div>
    </footer>

    @yield('extra_scripts')
</body>
</html>
