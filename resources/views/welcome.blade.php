@extends('layouts.app')

@section('title', 'Home')

@section('extra_styles')
    <style>
        .hero-slider-container { position: absolute; inset: 0; z-index: 0; }
        .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 2s ease-in-out; overflow: hidden; }
        .hero-slide.active { opacity: 1; }
        .hero-slide img { transform: scale(1); transition: transform 10s linear; }
        .hero-slide.active img { transform: scale(1.2); }
        
        .destination-card { position: relative; overflow: hidden; border-radius: 40px; cursor: pointer; }
        .destination-overlay { 
            position: absolute; inset: 0; 
            background: rgba(0,0,0,0.3); 
            backdrop-filter: blur(0px);
            transition: all 0.5s ease;
            display: flex; flex-direction: column; justify-content: flex-end; padding: 2.5rem;
        }
        .destination-card:hover .destination-overlay { 
            background: rgba(37, 99, 235, 0.2); 
            backdrop-filter: blur(8px);
        }
        
        /* Service box white theme */
        .service-box {
            background: white;
            padding: 2.5rem;
            border-radius: 40px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
        }
        .service-box:hover {
            transform: translateY(-10px);
            border-color: #2563eb;
            box-shadow: 0 20px 40px -15px rgba(37, 99, 235, 0.1);
        }

        /* Testimonial Slider */
        .testimonial-container { overflow: hidden; position: relative; padding: 20px 0; }
        .testimonial-track { display: flex; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        .testimonial-card { min-width: 100%; padding: 0 12px; }
        @media (min-width: 768px) { .testimonial-card { min-width: 33.333%; } }

        .payment-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem; }
        @media (max-width: 1024px) { .payment-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 640px) { .payment-grid { grid-template-columns: repeat(2, 1fr); } }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
    </style>
@endsection

@section('content')
    <!-- Section 2: Hero Section -->
    <section id="home" class="relative h-[92vh] flex items-center justify-center overflow-hidden">
        <div class="hero-slider-container">
            @foreach(($hero['images'] ?? []) as $image)
                <div class="hero-slide {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ $image }}" class="w-full h-full object-cover" alt="Akash Tours Banner">
                </div>
            @endforeach
        </div>
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="relative z-20 text-center px-6 max-w-5xl">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-2 rounded-full mb-8 border border-white/20">
                <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                <span class="text-white text-xs font-black uppercase tracking-[0.2em] font-en">{{ $hero['eyebrow'] ?? "Bangladesh's Top Rated Agency" }}</span>
            </div>
            <h2 class="text-6xl md:text-8xl font-black text-white mb-8 leading-[1.05] tracking-tighter">{{ $hero['title'] ?? 'ভ্রমণ হোক নিরাপদ ও আনন্দময়' }}</h2>
            <p class="text-xl md:text-2xl text-gray-200 mb-12 font-medium max-w-3xl mx-auto leading-relaxed opacity-90">{{ $hero['description'] ?? '' }}</p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="#packages" class="bg-white text-blue-900 px-10 py-5 rounded-3xl font-black text-xl hover:bg-blue-50 transition shadow-2xl">{{ $hero['primary_button'] ?? 'ট্যুর প্যাকেজ দেখুন' }}</a>
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-10 py-5 rounded-3xl font-black text-xl hover:bg-blue-700 transition shadow-2xl shadow-blue-900/40">{{ $hero['secondary_button'] ?? 'যোগাযোগ করুন' }}</a>
            </div>
        </div>
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-30 animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <!-- Section 3: Quick Search & Filter (Floating) -->
    <section class="relative z-40 -mt-16 container mx-auto px-6">
        <form action="{{ route('home') }}" method="GET" class="bg-white rounded-[40px] shadow-2xl p-8 lg:p-10 border border-gray-50 flex flex-wrap lg:flex-nowrap gap-8 items-center">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">গন্তব্য পছন্দ করুন</label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    <select name="destination" class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl font-bold text-gray-700 outline-none appearance-none cursor-pointer focus:ring-2 focus:ring-blue-600/20">
                        <option value="">সবগুলো গন্তব্য</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->name }}" {{ request('destination') == $destination->name ? 'selected' : '' }}>{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">ভ্রমণের মাস</label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-600 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <select name="month" class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl font-bold text-gray-700 outline-none appearance-none cursor-pointer focus:ring-2 focus:ring-blue-600/20">
                        <option value="">ভ্রমণের মাস সিলেক্ট করুন</option>
                        @php
                            $months = [
                                '01' => 'জানুয়ারি', '02' => 'ফেব্রুয়ারি', '03' => 'মার্চ', 
                                '04' => 'এপ্রিল', '05' => 'মে', '06' => 'জুন', 
                                '07' => 'জুলাই', '08' => 'আগস্ট', '09' => 'সেপ্টেম্বর', 
                                '10' => 'অক্টোবর', '11' => 'নভেম্বর', '12' => 'ডিসেম্বর'
                            ];
                            $currentYear = date('Y');
                        @endphp
                        @foreach($months as $num => $name)
                            <option value="{{ $currentYear }}-{{ $num }}" {{ request('month') == "$currentYear-$num" ? 'selected' : '' }}>{{ $name }} {{ $currentYear }}</option>
                        @endforeach
                        @foreach($months as $num => $name)
                            <option value="{{ $currentYear + 1 }}-{{ $num }}" {{ request('month') == ($currentYear + 1)."-$num" ? 'selected' : '' }}>{{ $name }} {{ $currentYear + 1 }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="w-full lg:w-auto bg-blue-600 text-white px-12 py-4 rounded-2xl font-black text-lg hover:bg-blue-700 transition shadow-xl shadow-blue-100 flex items-center justify-center space-x-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span>সার্চ করুন</span>
            </button>
        </form>
    </section>

    <!-- Section 4: Why Choose Us -->
    <section id="about" class="py-32 container mx-auto px-6">
        <div class="flex flex-wrap lg:flex-nowrap gap-20 items-stretch">
            <div class="w-full lg:w-1/2 flex flex-col justify-between">
                <div class="space-y-4 mb-12">
                    <h3 class="text-blue-600 font-black text-xs uppercase tracking-[0.3em]">কেন সাথে যাবেন?</h3>
                    <h2 class="text-5xl font-black text-gray-900 tracking-tighter leading-tight">সেরা ভ্রমণ অভিজ্ঞতার নিশ্চয়তা দিচ্ছি</h2>
                    <p class="text-gray-500 text-lg leading-relaxed">মাধবপুর উপজেলার সবচেয়ে বড় এবং নির্ভরযোগ্য ট্রাভেল পার্টনার হিসেবে প্রতিটি ট্যুর আয়োজন করা হয় সর্বোচ্চ গুরুত্ব দিয়ে।</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Benefit 1 -->
                    <div class="group p-6 bg-white rounded-[40px] shadow-sm border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-500">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mb-6">
                            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=300" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Safety">
                        </div>
                        <h4 class="font-black text-xl text-gray-900 mb-2">নিরাপদ ভ্রমণ</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">যাত্রীদের নিরাপত্তা আমাদের প্রধান অগ্রাধিকার। দক্ষ গাইড ও নিরাপদ পরিবহনের নিশ্চয়তা।</p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="group p-6 bg-white rounded-[40px] shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-xl transition-all duration-500">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mb-6">
                            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=300" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Budget">
                        </div>
                        <h4 class="font-black text-xl text-gray-900 mb-2">সাশ্রয়ী প্যাকেজ</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">আপনার সাধ্যের মধ্যে সেরা মানের হোটেল এবং যাতায়াত সুবিধা নিশ্চিত করি আমরা।</p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="group p-6 bg-white rounded-[40px] shadow-sm border border-gray-100 hover:border-green-200 hover:shadow-xl transition-all duration-500">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mb-6">
                            <img src="https://images.unsplash.com/photo-1517400508447-f8dd518b86db?q=80&w=300" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Guide">
                        </div>
                        <h4 class="font-black text-xl text-gray-900 mb-2">অভিজ্ঞ গাইড</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">প্রতিটি ট্যুরে থাকেন অভিজ্ঞ গাইড, যারা আপনাকে জায়গার ইতিহাস ও গুরুত্ব বুঝিয়ে দেবেন।</p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="group p-6 bg-white rounded-[40px] shadow-sm border border-gray-100 hover:border-purple-200 hover:shadow-xl transition-all duration-500">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mb-6">
                            <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=300" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Support">
                        </div>
                        <h4 class="font-black text-xl text-gray-900 mb-2">২৪/৭ সহায়তা</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">ট্যুর চলাকালীন বা বুকিং সংক্রান্ত যেকোনো সমস্যায় আমরা আছি আপনার পাশে।</p>
                    </div>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 relative min-h-[600px]">
                <div class="absolute -top-10 -left-10 w-64 h-64 bg-blue-600/10 rounded-full blur-[100px]"></div>
                <div class="relative h-full">
                    <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=1200" class="rounded-[80px] shadow-2xl relative z-10 w-full h-full object-cover" alt="Travel Experience">
                    <div class="absolute -bottom-10 -right-10 bg-white p-10 rounded-[50px] shadow-2xl z-20 border border-gray-50 text-center min-w-[220px]">
                        <div class="text-5xl font-black text-blue-600 font-en mb-2">500+</div>
                        <p class="text-xs text-gray-400 font-black uppercase tracking-[0.2em]">সফল ট্যুর সম্পন্ন</p>
                        <div class="flex justify-center -space-x-3 mt-6">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=100&h=100&fit=crop" class="w-10 h-10 rounded-full border-2 border-white object-cover" alt="Male Traveler">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=100&h=100&fit=crop" class="w-10 h-10 rounded-full border-2 border-white object-cover" alt="Female Traveler">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=100&h=100&fit=crop" class="w-10 h-10 rounded-full border-2 border-white object-cover" alt="Male Traveler">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-blue-600 flex items-center justify-center text-[10px] text-white font-bold">+</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Featured Tour Packages -->
    <section id="packages" class="py-32 bg-[#F4F7FF] rounded-[100px]">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-between items-end mb-20 gap-8">
                <div class="max-w-2xl space-y-4">
                    <h2 class="text-5xl font-black text-gray-900 tracking-tighter">{{ $sections['packages_title'] ?? 'জনপ্রিয় ট্যুর প্যাকেজ' }}</h2>
                    <p class="text-gray-500 text-lg">{{ $sections['packages_description'] ?? 'পছন্দের গন্তব্যটি বেছে নিন এবং বুকিং করুন খুব সহজেই।' }}</p>
                </div>
                <a href="{{ route('home') }}" class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-blue-700 transition shadow-xl shadow-blue-100 flex items-center">
                    <span>সবগুলো প্যাকেজ দেখুন</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($packages as $package)
                <div class="group bg-white rounded-[45px] shadow-sm hover:shadow-2xl transition duration-500 border border-gray-100 overflow-hidden flex flex-col h-full card-hover">
                    <div class="relative h-72 overflow-hidden">
                        <img src="{{ $package->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $package->title }}">
                        <div class="absolute top-6 left-6 bg-white/20 backdrop-blur-md px-4 py-2 rounded-2xl text-white text-xs font-black uppercase border border-white/30 font-en">
                            {{ $package->duration }}
                        </div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="bg-white px-4 py-2 rounded-2xl font-black text-blue-900 shadow-xl inline-block font-en">
                                <span class="text-lg">৳</span>{{ is_numeric($package->price_per_person) ? number_format($package->price_per_person) : $package->price_per_person }}
                            </div>
                        </div>
                    </div>
                    <div class="p-10 flex flex-col flex-1">
                        <p class="text-blue-500 font-black text-xs uppercase tracking-widest mb-3">{{ $package->destination }}</p>
                        <h3 class="text-2xl font-black text-gray-900 leading-tight mb-6 h-16 overflow-hidden">{{ $package->title }}</h3>
                        <div class="pt-8 border-t border-gray-50 flex justify-between items-center mt-auto">
                            <div class="flex items-center text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-wider font-en">{{ $package->date }}</span>
                            </div>
                            <a href="{{ route('tours.show', $package->id) }}" class="px-6 py-3 bg-blue-50 text-blue-600 rounded-2xl font-black text-sm hover:bg-blue-600 hover:text-white transition duration-300">
                                বিস্তারিত ও বুকিং করুন
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 text-xl font-bold">দুঃখিত, কোনো প্যাকেজ পাওয়া যায়নি।</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section 6: Popular Destinations -->
    <section id="destinations" class="py-32 container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
            <h2 class="text-5xl font-black text-gray-900 tracking-tighter">{{ $sections['destinations_title'] ?? 'টপ ট্রাভেল ডেস্টিনেশন' }}</h2>
            <p class="text-gray-500 text-lg">{{ $sections['destinations_description'] ?? 'দেশ-বিদেশের সবচেয়ে সুন্দর জায়গাগুলোতে ঘুরে আসুন।' }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 h-[600px]">
            @foreach($destinations as $destination)
                <div class="destination-card {{ $destination->layout === 'wide' ? 'md:col-span-2' : '' }} {{ $destination->layout === 'tall' ? 'row-span-2' : '' }}">
                    <img src="{{ $destination->image }}" class="w-full h-full object-cover" alt="{{ $destination->name }}">
                    <div class="destination-overlay">
                        <h4 class="{{ $destination->layout === 'wide' ? 'text-3xl' : 'text-2xl' }} font-black text-white mb-2">{{ $destination->name }}</h4>
                        <p class="text-blue-400 font-bold">{{ $destination->subtitle }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Section 7: Services & Support -->
    <section id="services" class="py-32 bg-white relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20 space-y-6">
                <h3 class="text-blue-600 font-black text-xs uppercase tracking-[0.4em] font-en">Exclusive Services</h3>
                <h2 class="text-5xl font-black text-gray-900 tracking-tighter">ভ্রমণ সংক্রান্ত সব সেবা এক জায়গায়</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $special_services = [
                        ['title' => 'স্কুল • কলেজ • ইউনিভার্সিটি ট্যুর', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.083 0 01.665-6.479L12 14z', 'desc' => 'শিক্ষা প্রতিষ্ঠানের জন্য বিশেষ প্যাকেজ'],
                        ['title' => 'ফ্যামিলি ট্যুর', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'desc' => 'পরিবারের সাথে নিরাপদ ও আরামদায়ক ভ্রমণ'],
                        ['title' => 'সাপ্তাহিক গ্রুপ ট্যুর', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'desc' => 'প্রতি সপ্তাহে দেশের বিভিন্ন প্রান্তে গ্রুপ ট্যুর'],
                        ['title' => 'কারখানা ও ফ্যাক্টরী বনভোজন ট্যুর', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'desc' => 'কর্পোরেট ও ফ্যাক্টরী পিকনিকের জন্য সেরা আয়োজন']
                    ];
                @endphp
                @foreach($special_services as $s)
                <div class="service-box">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $s['icon'] }}"></path></svg>
                        </div>
                        <h4 class="text-xl font-black text-gray-900 leading-snug mb-3">{{ $s['title'] }}</h4>
                        <p class="text-gray-500 text-sm">{{ $s['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 8: Testimonials Slider -->
    <section class="py-32 container mx-auto px-6 overflow-hidden">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-black text-gray-900 tracking-tighter">আমাদের ট্যুরিস্টদের কথা</h2>
        </div>
        
        <div class="testimonial-container">
            <div id="testimonialTrack" class="testimonial-track">
                @php
                    $reviews = [
                        ['name' => 'মোঃ রহমান', 'loc' => 'মাধবপুর, হবিগঞ্জ', 'text' => 'আকাশ ট্যুরসের সাথে কাশ্মীর ট্যুরটি ছিল আমার জীবনের সেরা ভ্রমণ। সবকিছুই খুব গোছানো ছিল।'],
                        ['name' => 'আব্দুল্লাহ আল মামুন', 'loc' => 'হবিগঞ্জ', 'text' => 'খুবই প্রফেশনাল সার্ভিস। বাসের সিট থেকে শুরু করে খাবার, সবকিছুর মান ছিল চমৎকার।'],
                        ['name' => 'সাজ্জাদ হোসেন', 'loc' => 'মাধবপুর', 'text' => 'কম খরচেই এত সুন্দর ট্যুর আয়োজন করার জন্য আকাশ ট্যুরসকে অনেক ধন্যবাদ জানাই।'],
                        ['name' => 'তানভীর আহমেদ', 'loc' => 'সিলেট', 'text' => 'কেদারনাথ যাত্রাটি ছিল অত্যন্ত আধ্যাত্মিক এবং আরামদায়ক। গাইড অনেক হেল্পফুল ছিল।'],
                        ['name' => 'রাশেদ খান', 'loc' => 'ঢাকা', 'text' => 'রাজশাহীর আম বাগান ট্যুরটি ফ্যামিলি নিয়ে খুব এনজয় করেছি।'],
                        ['name' => 'কামরুল হাসান', 'loc' => 'মাধবপুর', 'text' => 'সিলেটের সাদা পাথর ট্যুরটি ছিল দারুণ। নৌকায় ঘোরাঘুরি অনেক মজা হয়েছে।'],
                        ['name' => 'মোরশেদ আলম', 'loc' => 'কুমিল্লা', 'text' => 'ম্যাজিক প্যারাডাইস ট্যুরে ফ্যামিলি নিয়ে গিয়েছিলাম। আকাশ ট্যুরসের গাইড আমাদের অনেক সাহায্য করেছে।'],
                        ['name' => 'নাসির উদ্দিন', 'loc' => 'হবিগঞ্জ', 'text' => 'কুয়াকাটা সমুদ্র সৈকতে সূর্যোদয় দেখা ছিল এক অপূর্ব অভিজ্ঞতা।'],
                        ['name' => 'আরিফ রহমান', 'loc' => 'মাধবপুর', 'text' => 'কাশ্মীর ট্যুরে আমাদের হোটেল এবং খাবার ছিল ফাইভ স্টার মানের।'],
                        ['name' => 'জাহিদ হাসান', 'loc' => 'ব্রাহ্মণবাড়িয়া', 'text' => 'খুবই বিশ্বস্ত প্রতিষ্ঠান। টাকা লেনদেন থেকে শুরু করে ট্যুর শেষ হওয়া পর্যন্ত নিশ্চিন্ত ছিলাম।'],
                        ['name' => 'সোহেল রানা', 'loc' => 'মাধবপুর', 'text' => 'গ্রুপ ট্যুরগুলোতে নতুন নতুন মানুষের সাথে পরিচয় হওয়াটা দারুণ ব্যাপার।'],
                        ['name' => 'ফারুক আহমেদ', 'loc' => 'সিলেট', 'text' => 'রাজশাহীর আম বাগান ট্যুর ছিল একদম অন্যরকম। তাজা আম খাওয়ার মজাই আলাদা।'],
                        ['name' => 'রুবেল মিয়া', 'loc' => 'মাধবপুর', 'text' => 'বাজেটের মধ্যে এত ভালো সার্ভিস অন্য কোথাও পাওয়া যাবে না।'],
                        ['name' => 'আনিসুর রহমান', 'loc' => 'ঢাকা', 'text' => 'আকাশ ট্যুরসের ম্যানেজমেন্ট অনেক ভালো। সবকিছু একদম সময়মতো হয়।'],
                        ['name' => 'সাইফুল ইসলাম', 'loc' => 'মাধবপুর', 'text' => 'পরবর্তী ট্যুরও আকাশ ট্যুরসের সাথেই যাওয়ার ইচ্ছা আছে।'],
                    ];
                    // Duplicate reviews for infinite loop
                    $displayReviews = array_merge($reviews, $reviews);
                @endphp
                @foreach($displayReviews as $r)
                <div class="testimonial-card">
                    <div class="bg-white p-10 rounded-[45px] shadow-sm border border-gray-100 h-full flex flex-col space-y-6 hover:shadow-xl transition-shadow">
                        <div class="flex text-orange-400">
                            @for($i=0; $i<5; $i++)<svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>@endfor
                        </div>
                        <p class="text-gray-600 text-lg leading-relaxed flex-1 italic">{{ $r['text'] }}</p>
                        <div class="flex items-center space-x-4 pt-6 border-t border-gray-50">
                            <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center font-black text-blue-600 text-xl font-en">{{ substr($r['name'], 0, 1) }}</div>
                            <div>
                                <h5 class="font-black text-gray-900">{{ $r['name'] }}</h5>
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest font-en">{{ $r['loc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Slider Controls -->
        <div class="flex justify-center space-x-4 mt-12">
            <button onclick="prevSlide()" class="w-14 h-14 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all group">
                <svg class="w-6 h-6 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="nextSlide()" class="w-14 h-14 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all group">
                <svg class="w-6 h-6 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </section>

    <!-- Section 9: Payment Partners -->
    <section class="py-24 bg-[#F8F9FF]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 space-y-2">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">{{ $sections['payments_title'] ?? 'পেমেন্ট মাধ্যমসমূহ' }}</h2>
                <p class="text-gray-500 font-medium">{{ $sections['payments_description'] ?? 'মোবাইল ব্যাংকিং, ব্যাংক ও কার্ড পেমেন্ট গ্রহণযোগ্য' }}</p>
                <div class="w-12 h-1 bg-blue-500 mx-auto rounded-full mt-4"></div>
            </div>
            
            <div class="bg-white p-10 lg:p-16 rounded-[50px] shadow-2xl shadow-blue-100/50 border border-gray-100">
                <div class="payment-grid">
                    @foreach($paymentPartners as $partner)
                    <div class="h-24 bg-gray-50/50 rounded-2xl border border-gray-100 flex items-center justify-center p-6 hover:bg-white hover:shadow-xl hover:border-blue-100 transition duration-300 group">
                        <img src="{{ $partner->logo }}" class="max-h-12 w-auto grayscale group-hover:grayscale-0 transition duration-300" alt="{{ $partner->name }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Section 10: FAQ -->
    <section class="py-32 container mx-auto px-6">
        <div class="max-w-4xl mx-auto space-y-12">
            <h2 class="text-4xl font-black text-center text-gray-900 tracking-tighter">সাধারণ কিছু জিজ্ঞাসা</h2>
            <div class="space-y-4">
                <div class="faq-item group bg-white p-6 md:p-8 rounded-[35px] border border-gray-100 shadow-sm cursor-pointer hover:shadow-md transition-all duration-300" onclick="this.classList.toggle('active')">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-black text-gray-800">কিভাবে বুকিং করব?</h4>
                        <div class="faq-icon w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-500 text-lg leading-relaxed pt-2">পছন্দের প্যাকেজে গিয়ে 'বুকিং করুন' বাটনে ক্লিক করে আপনার সিট সিলেক্ট করুন এবং পেমেন্ট সম্পন্ন করে ট্রানজেকশন আইডি দিন। আমাদের টিম ভেরিফাই করে আপনাকে কনফার্মেশন জানিয়ে দিবে।</p>
                    </div>
                </div>
                
                <div class="faq-item group bg-white p-6 md:p-8 rounded-[35px] border border-gray-100 shadow-sm cursor-pointer hover:shadow-md transition-all duration-300" onclick="this.classList.toggle('active')">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-black text-gray-800">টাকা রিফান্ড পাওয়া যাবে?</h4>
                        <div class="faq-icon w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-500 text-lg leading-relaxed pt-2">হ্যাঁ, আমাদের রিফান্ড পলিসি অনুযায়ী ভ্রমণের নির্দিষ্ট সময় (সাধারণত ৭ দিন) আগে আমাদের জানালে সার্ভিস চার্জ বাদে বাকি টাকা রিফান্ড করা হবে।</p>
                    </div>
                </div>

                <div class="faq-item group bg-white p-6 md:p-8 rounded-[35px] border border-gray-100 shadow-sm cursor-pointer hover:shadow-md transition-all duration-300" onclick="this.classList.toggle('active')">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-black text-gray-800">মাধবপুর ছাড়া অন্য জায়গা থেকে কি জয়েন করা যাবে?</h4>
                        <div class="faq-icon w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <p class="text-gray-500 text-lg leading-relaxed pt-2">হ্যাঁ, আমাদের অধিকাংশ ট্যুর সিলেট বা ঢাকা রুটে হয়ে থাকে। আপনি রুটের যেকোনো সুবিধাজনক পয়েন্ট থেকে আমাদের সাথে যুক্ত হতে পারবেন। বিস্তারিত জানতে আমাদের কল করুন।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 11: Final CTA & Newsletter -->
    <section class="container mx-auto px-6 py-20">
        <div class="bg-blue-600 rounded-[60px] p-12 lg:p-20 text-center text-white relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="relative z-10 space-y-6">
                <h2 class="text-4xl lg:text-5xl font-black tracking-tighter">আপনার পরবর্তী অ্যাডভেঞ্চার শুরু হোক আজই</h2>
                <p class="text-lg text-blue-100 max-w-2xl mx-auto">মাধবপুর থেকে সেরা ট্যুর প্যাকেজগুলো মিস করবেন না। এখনই আমাদের সাথে যোগাযোগ করুন।</p>
                <div class="flex flex-wrap justify-center gap-6 pt-4">
                    <a href="tel:01711662685" class="bg-white text-blue-600 px-10 py-4 rounded-3xl font-black text-lg hover:shadow-2xl transition font-en">Call Now</a>
                    <a href="https://wa.me/8801711662685" class="bg-green-500 text-white px-10 py-4 rounded-3xl font-black text-lg hover:shadow-2xl transition font-en">WhatsApp</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_scripts')
    <script>
        // Hero Slider
        let currentHeroSlide = 0;
        const heroSlides = document.querySelectorAll('.hero-slide');
        function nextHeroSlide() {
            heroSlides[currentHeroSlide].classList.remove('active');
            currentHeroSlide = (currentHeroSlide + 1) % heroSlides.length;
            heroSlides[currentHeroSlide].classList.add('active');
        }
        setInterval(nextHeroSlide, 5000);

        // Testimonial Slider
        let currentIdx = 0;
        const track = document.getElementById('testimonialTrack');
        const cards = document.querySelectorAll('.testimonial-card');
        const totalCards = cards.length / 2; // Original count

        function updateSlider() {
            const cardWidth = cards[0].offsetWidth;
            track.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            track.style.transform = `translateX(-${currentIdx * cardWidth}px)`;
            
            // Infinite loop logic
            if (currentIdx >= totalCards) {
                setTimeout(() => {
                    track.style.transition = 'none';
                    currentIdx = 0;
                    track.style.transform = `translateX(0px)`;
                }, 600);
            }
        }
        
        function nextSlide() {
            currentIdx++;
            updateSlider();
        }
        
        function prevSlide() {
            if (currentIdx <= 0) {
                currentIdx = totalCards;
                track.style.transition = 'none';
                const cardWidth = cards[0].offsetWidth;
                track.style.transform = `translateX(-${currentIdx * cardWidth}px)`;
                setTimeout(() => {
                    currentIdx--;
                    updateSlider();
                }, 10);
            } else {
                currentIdx--;
                updateSlider();
            }
        }
        
        // Auto slide testimonials every 2 seconds
        setInterval(nextSlide, 2000);
        
        window.addEventListener('resize', updateSlider);
    </script>
@endsection
