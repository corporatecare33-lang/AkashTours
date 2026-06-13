@extends('layouts.app')

@section('title', 'যোগাযোগ করুন')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[40vh] flex items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=2000" class="absolute inset-0 w-full h-full object-cover" alt="Contact Us">
        <div class="absolute inset-0 bg-blue-900/60 backdrop-blur-sm"></div>
        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-5xl md:text-7xl font-black tracking-tighter mb-4">যোগাযোগ করুন</h1>
            <p class="text-xl md:text-2xl font-medium opacity-90">যেকোনো প্রশ্ন বা বুকিংয়ের জন্য আমাদের সাথে যোগাযোগ করুন</p>
        </div>
    </section>

    <!-- Contact Info & Form -->
    <section class="py-24 container mx-auto px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20">
            <!-- Contact Info -->
            <div class="space-y-12">
                <div class="space-y-6">
                    <h2 class="text-4xl font-black text-gray-900 tracking-tighter">আমাদের সাথে যোগাযোগ করার মাধ্যম</h2>
                    <p class="text-gray-500 text-lg leading-relaxed">মাধবপুর বাজারেই আমাদের মূল অফিস। আপনি সরাসরি আমাদের অফিসে এসে অথবা নিচের ফোন নাম্বারে কল করে বিস্তারিত তথ্য জানতে পারেন।</p>
                </div>

                <div class="space-y-8">
                    <div class="flex items-start space-x-6 p-8 bg-white rounded-[40px] shadow-sm border border-gray-50 hover:border-blue-200 transition">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-gray-900 mb-2">আমাদের অবস্থান</h4>
                            <p class="text-gray-500">আমীর কমপ্লেক্স, মাধবপুর বাজার, হবিগঞ্জ</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6 p-8 bg-white rounded-[40px] shadow-sm border border-gray-50 hover:border-green-200 transition">
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-gray-900 mb-2">কল করুন</h4>
                            <p class="text-gray-500 font-en">01711662685, 01729650690</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6 p-8 bg-white rounded-[40px] shadow-sm border border-gray-50 hover:border-purple-200 transition">
                        <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-gray-900 mb-2">ইমেইল করুন</h4>
                            <p class="text-gray-500 font-en">akash@akashmadhabpur.org</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-12 lg:p-16 rounded-[60px] shadow-2xl shadow-blue-100/50 border border-gray-100">
                <form action="#" class="space-y-8">
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-gray-400 uppercase tracking-widest ml-2">আপনার নাম</label>
                        <input type="text" placeholder="পুরো নাম লিখুন" class="w-full px-8 py-5 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 transition">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-gray-400 uppercase tracking-widest ml-2">ফোন নাম্বার</label>
                        <input type="text" placeholder="আপনার ফোন নাম্বার" class="w-full px-8 py-5 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 transition font-en">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-gray-400 uppercase tracking-widest ml-2">আপনার বার্তা</label>
                        <textarea rows="5" placeholder="কি জানতে চান লিখুন..." class="w-full px-8 py-5 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 transition"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-6 rounded-3xl font-black text-xl hover:bg-blue-700 transition shadow-xl shadow-blue-200">বার্তা পাঠান</button>
                </form>
            </div>
        </div>
    </section>
@endsection
