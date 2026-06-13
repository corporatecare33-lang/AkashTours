@extends('layouts.app')

@section('title', $tour->title)

@section('extra_styles')
    <style>
        .sticky-sidebar { position: sticky; top: 100px; }
    </style>
@endsection

@section('content')
    <main class="container mx-auto px-6 py-10">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-sm text-gray-400 mb-8 font-bold uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">হোম</a>
            <span>/</span>
            <a href="{{ route('home') }}#packages" class="hover:text-blue-600 transition">ট্যুর প্যাকেজ</a>
            <span>/</span>
            <span class="text-gray-600">{{ $tour->title }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Content (8 cols) -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Gallery Section -->
                <section class="space-y-4">
                    <div class="relative rounded-[50px] overflow-hidden shadow-2xl h-[500px]">
                        <img src="{{ $tour->image }}" class="w-full h-full object-cover" alt="{{ $tour->title }}">
                        <div class="absolute bottom-8 left-8 bg-white/20 backdrop-blur-md px-6 py-2 rounded-full text-white text-sm font-black border border-white/30 font-en">
                            {{ count($tour->gallery ?? []) + 1 }} Photos
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        @foreach($tour->gallery ?? [] as $img)
                        <div class="h-40 rounded-[30px] overflow-hidden shadow-md group">
                            <img src="{{ $img }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 cursor-pointer" alt="Gallery">
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Overview -->
                <section id="overview" class="bg-white p-12 rounded-[50px] shadow-sm border border-gray-100 space-y-8">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight tracking-tighter">{{ $tour->title }}</h1>
                    
                    <div class="flex flex-wrap gap-8 py-8 border-y border-gray-50">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">সময়কাল</p>
                                <p class="font-black text-gray-800">{{ $tour->duration }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">গন্তব্য</p>
                                <p class="font-black text-gray-800">{{ $tour->destination }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">তারিখ</p>
                                <p class="font-black text-gray-800">{{ $tour->date }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed text-lg font-medium">
                        {{ $tour->description }}
                    </div>
                </section>

                <!-- Itinerary -->
                <section id="itinerary" class="space-y-10">
                    <h2 class="text-4xl font-black text-gray-900 tracking-tighter flex items-center">
                        <span class="w-12 h-1.5 bg-blue-600 mr-4 rounded-full"></span>
                        ভ্রমণ পরিকল্পনা
                    </h2>
                    <div class="space-y-8">
                        @foreach($tour->itinerary ?? [] as $step)
                        <div class="relative pl-14 pb-10 border-l-2 border-blue-100 last:border-0 last:pb-0">
                            <div class="absolute -left-[11px] top-0 w-5 h-5 bg-white border-4 border-blue-600 rounded-full"></div>
                            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                                <span class="inline-block bg-blue-600 text-white text-xs font-black px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest font-en">Day {{ $step['day'] }}</span>
                                <h4 class="text-2xl font-black text-gray-900 mb-3 tracking-tight">{{ $step['title'] }}</h4>
                                <p class="text-gray-600 text-lg leading-relaxed">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Inclusions & Exclusions -->
                <section class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-green-50/50 p-12 rounded-[50px] border border-green-100">
                        <h3 class="text-2xl font-black text-green-900 mb-8 flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            প্যাকেজে যা থাকছে
                        </h3>
                        <ul class="space-y-5">
                            @foreach($tour->inclusions ?? [] as $item)
                            <li class="flex items-center text-green-800 font-bold text-lg">
                                <div class="w-2.5 h-2.5 bg-green-500 rounded-full mr-4 shrink-0"></div>
                                {{ $item }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="bg-red-50/50 p-12 rounded-[50px] border border-red-100">
                        <h3 class="text-2xl font-black text-red-900 mb-8 flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            প্যাকেজে যা থাকছে না
                        </h3>
                        <ul class="space-y-5">
                            @foreach($tour->exclusions ?? [] as $item)
                            <li class="flex items-center text-red-800 font-bold text-lg">
                                <div class="w-2.5 h-2.5 bg-red-500 rounded-full mr-4 shrink-0"></div>
                                {{ $item }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </section>

                <!-- Policy -->
                <section id="policy" class="bg-gray-950 p-16 rounded-[60px] text-white space-y-8 shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full -mr-48 -mt-48 blur-[100px]"></div>
                    <h2 class="text-4xl font-black tracking-tighter">বুকিং পলিসি</h2>
                    <p class="text-gray-400 leading-relaxed text-xl italic font-medium">"{{ $tour->policy }}"</p>
                    <div class="pt-8 border-t border-white/10 flex flex-wrap gap-10">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600/20 rounded-2xl flex items-center justify-center text-blue-400">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <span class="font-black text-lg">১০০% নিরাপদ ভ্রমণ</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600/20 rounded-2xl flex items-center justify-center text-blue-400">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="font-black text-lg">সেরা মূল্যের নিশ্চয়তা</span>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Sidebar (4 cols) -->
            <div class="lg:col-span-4">
                <div class="sticky-sidebar space-y-8">
                    <div class="bg-white p-12 rounded-[50px] shadow-2xl border border-gray-50 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-blue-50 rounded-full -mr-20 -mt-20"></div>
                        
                        <div class="relative z-10 space-y-10">
                            <div>
                                <p class="text-gray-400 font-black uppercase tracking-[0.2em] text-xs mb-3">প্যাকেজ শুরু</p>
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-5xl font-black text-blue-600 font-en">৳{{ is_numeric($tour->price_per_person) ? number_format($tour->price_per_person) : $tour->price_per_person }}</span>
                                    <span class="text-gray-400 font-bold text-lg">/জন</span>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <a href="{{ route('bookings.create', $tour->id) }}" class="flex items-center justify-center w-full bg-blue-600 text-white py-6 rounded-[30px] font-black text-2xl hover:bg-blue-700 transition shadow-2xl shadow-blue-100 group">
                                    বুকিং করুন
                                    <svg class="w-7 h-7 ml-3 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                                <p class="text-center text-xs text-gray-400 font-black uppercase tracking-widest">সীমিত আসন - এখনই বুক করুন!</p>
                            </div>

                            <div class="pt-10 border-t border-gray-50 space-y-8">
                                <div class="flex items-center space-x-5">
                                    <div class="w-14 h-14 bg-gray-50 text-gray-400 rounded-2xl flex items-center justify-center border border-gray-100">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042) 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">সরাসরি কল</p>
                                        <p class="font-black text-xl text-gray-800 font-en">01711662685</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-5">
                                    <div class="w-14 h-14 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center border border-green-100">
                                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .015 5.398.01 12.038c0 2.123.554 4.197 1.608 6.06L0 24l6.104-1.602a11.834 11.834 0 005.937 1.598h.005c6.637 0 12.036-5.398 12.041-12.038a11.824 11.824 0 00-3.574-8.508"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">হোয়াটসঅ্যাপ</p>
                                        <a href="https://wa.me/8801711662685" class="font-black text-xl text-green-600 hover:underline">চ্যাট করুন</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-600 p-10 rounded-[50px] text-white shadow-2xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-black/10 translate-y-full group-hover:translate-y-0 transition duration-500"></div>
                        <div class="relative z-10">
                            <h4 class="text-2xl font-black mb-4 italic tracking-tighter">Akash Tours</h4>
                            <p class="text-blue-100 text-lg leading-relaxed mb-8">মাধবপুর থেকে পরিচালিত সেরা ট্রাভেল এজেন্সি। আপনার প্রতিটি ভ্রমণ হোক আনন্দময়।</p>
                            <div class="flex -space-x-4">
                                <div class="w-12 h-12 rounded-full border-4 border-blue-600 bg-gray-200 overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" alt="User">
                                </div>
                                <div class="w-12 h-12 rounded-full border-4 border-blue-600 bg-gray-200 overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop" alt="User">
                                </div>
                                <div class="w-12 h-12 rounded-full border-4 border-blue-600 bg-gray-200 overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="User">
                                </div>
                                <div class="w-12 h-12 rounded-full border-4 border-blue-600 bg-gray-200 overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1531123897727-8f129e16fd3c?w=100&h=100&fit=crop" alt="User">
                                </div>
                                <div class="w-12 h-12 rounded-full border-4 border-blue-600 bg-gray-200 overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="User">
                                </div>
                                <div class="w-12 h-12 rounded-full border-4 border-blue-600 bg-blue-800 flex items-center justify-center text-xs font-black shadow-lg">+500</div>
                            </div>
                            <p class="mt-6 text-sm font-black text-blue-200 uppercase tracking-[0.2em]">৫০০+ খুশি ট্রাভেলার্স</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
