@extends('layouts.app')

@section('title', 'আমাদের সম্পর্কে')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1503220317375-aaad61436b1b?q=80&w=2000" class="absolute inset-0 w-full h-full object-cover" alt="About Us">
        <div class="absolute inset-0 bg-blue-900/60 backdrop-blur-sm"></div>
        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-5xl md:text-7xl font-black tracking-tighter mb-4">আকাশ ট্যুরস এন্ড ট্রাভেলস</h1>
            <p class="text-xl md:text-2xl font-medium opacity-90">আপনার স্বপ্নের গন্তব্যে আমাদের সাথে</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-24 container mx-auto px-6">
        <div class="max-w-4xl mx-auto space-y-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="space-y-6">
                    <h2 class="text-4xl font-black text-gray-900 tracking-tighter">আমাদের গল্প</h2>
                    <p class="text-gray-600 text-lg leading-relaxed">মাধবপুর উপজেলার একটি ছোট উদ্যোগ থেকে আজ আমরা হবিগঞ্জ জেলার অন্যতম নির্ভরযোগ্য ট্রাভেল এজেন্সিতে পরিণত হয়েছি। আমাদের মূল লক্ষ্য হলো সাধারণ মানুষের সাধ্যের মধ্যে প্রিমিয়াম মানের ভ্রমণ অভিজ্ঞতা নিশ্চিত করা।</p>
                    <p class="text-gray-600 text-lg leading-relaxed">বিগত ১৫ বছর ধরে আমরা নিরলসভাবে কাজ করে যাচ্ছি পর্যটকদের নিরাপত্তা এবং স্বাচ্ছন্দ্য বজায় রাখতে। আমাদের প্রতিটি ট্যুর প্ল্যান করা হয় অত্যন্ত যত্ন সহকারে যাতে আপনি ফিরে পান আপনার ব্যয় করা সময়ের শ্রেষ্ঠ মূল্য।</p>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?q=80&w=1000" class="rounded-[40px] shadow-2xl animate-float" alt="Travel Team">
                    <div class="absolute -bottom-6 -right-6 bg-blue-600 text-white p-8 rounded-3xl shadow-xl">
                        <span class="text-4xl font-black font-en">15+</span>
                        <p class="text-sm font-bold uppercase tracking-widest mt-1">Years Experience</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-12 lg:p-16 rounded-[60px] border border-gray-100 grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div class="space-y-4">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto shadow-lg shadow-blue-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black text-gray-900">৫০০০+ সুখী ট্রাভেলার্স</h4>
                    <p class="text-gray-500">আমাদের সাথে ভ্রমণ করেছেন কয়েক হাজার পর্যটক।</p>
                </div>
                <div class="space-y-4">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto shadow-lg shadow-blue-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black text-gray-900">১০০+ গন্তব্য</h4>
                    <p class="text-gray-500">দেশ ও বিদেশের অসংখ্য দর্শনীয় স্থানে আমাদের প্যাকেজ রয়েছে।</p>
                </div>
                <div class="space-y-4">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto shadow-lg shadow-blue-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black text-gray-900">২৪/৭ কাস্টমার সাপোর্ট</h4>
                    <p class="text-gray-500">যেকোনো প্রয়োজনে আমরা আছি আপনার পাশে সব সময়।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotions Section -->
    <section class="py-24 bg-[#F4F7FF] rounded-[100px]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-4xl font-black text-gray-900 tracking-tighter">আমাদের বিশেষ কিছু অফার</h2>
                <p class="text-gray-500 text-lg">এখনই বুকিং করুন এবং পান আকর্ষণীয় ডিসকাউন্ট</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($promo_packages as $package)
                <div class="group bg-white rounded-[45px] shadow-sm hover:shadow-2xl transition duration-500 border border-gray-100 overflow-hidden flex flex-col h-full card-hover">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $package->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $package->title }}">
                        <div class="absolute top-6 left-6 bg-white/20 backdrop-blur-md px-4 py-2 rounded-2xl text-white text-xs font-black uppercase border border-white/30 font-en">
                            {{ $package->duration }}
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="text-xl font-black text-gray-900 leading-tight mb-4">{{ $package->title }}</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <div class="font-black text-blue-600 font-en">৳{{ is_numeric($package->price_per_person) ? number_format($package->price_per_person) : $package->price_per_person }}</div>
                            <a href="{{ route('tours.show', $package->id) }}" class="text-blue-600 font-bold hover:underline">বিস্তারিত</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
