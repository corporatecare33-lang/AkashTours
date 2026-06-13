@extends('layouts.app')

@section('title', 'ইউজার ড্যাশবোর্ড')

@section('content')
    <!-- Header -->
    <section class="bg-blue-600 pt-32 pb-24 text-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center text-4xl font-black font-en">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-4xl font-black tracking-tighter">{{ $user->name }}</h1>
                        <p class="text-blue-100 font-medium opacity-80">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('home') }}" class="bg-white text-blue-600 px-8 py-4 rounded-2xl font-black hover:bg-blue-50 transition">নতুন ট্যুর খুঁজুন</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Content -->
    <section class="py-20 container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Stats -->
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 flex items-center space-x-6">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black text-gray-900 font-en">{{ $bookings->count() }}</h4>
                        <p class="text-gray-500 font-bold uppercase text-[10px] tracking-widest">মোট বুকিং</p>
                    </div>
                </div>
                
                <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-100 space-y-6">
                    <h5 class="text-lg font-black text-gray-900 border-b pb-4">অ্যাকাউন্ট সেটিংস</h5>
                    @if(session('success'))
                        <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-sm font-bold">
                            {{ session('success') }}
                        </div>
                    @endif
                    <ul class="space-y-4">
                        <li><button onclick="toggleModal('profileModal')" class="text-gray-600 font-bold hover:text-blue-600 transition flex items-center w-full">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> প্রোফাইল আপডেট
                        </button></li>
                        <li><button onclick="toggleModal('passwordModal')" class="text-gray-600 font-bold hover:text-blue-600 transition flex items-center w-full">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg> পাসওয়ার্ড পরিবর্তন
                        </button></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 font-bold hover:text-red-700 transition flex items-center w-full">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1h8M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> লগআউট
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[45px] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-10 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-2xl font-black text-gray-900 tracking-tighter">আমার বুকিংসমূহ</h3>
                        <span class="px-4 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest font-en">Recent</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">ট্যুর</th>
                                    <th class="px-6 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">সিট</th>
                                    <th class="px-6 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">মোট টাকা</th>
                                    <th class="px-6 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">পেমেন্ট</th>
                                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">স্ট্যাটাস</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($bookings as $booking)
                                <tr class="hover:bg-gray-50/30 transition">
                                    <td class="px-10 py-8">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ $booking->tour->image }}" class="w-12 h-12 rounded-xl object-cover" alt="">
                                            <div>
                                                <h5 class="font-black text-gray-900 leading-none mb-1">{{ $booking->tour->title }}</h5>
                                                <p class="text-[10px] text-gray-400 font-bold uppercase font-en">{{ $booking->tour->date }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-8 font-bold text-gray-600 font-en">
                                        {{ is_array($booking->selected_seats) ? count($booking->selected_seats) : 0 }} Seats
                                    </td>
                                    <td class="px-6 py-8 font-black text-blue-600 font-en">
                                        ৳{{ number_format($booking->total_price) }}
                                    </td>
                                    <td class="px-6 py-8">
                                        <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $booking->payment_status == 'confirmed' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                                            {{ $booking->payment_status }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8 text-right">
                                        <a href="{{ route('bookings.confirmation', $booking->id) }}" class="text-blue-600 font-black hover:underline">রিসিপ্ট</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-10 py-20 text-center text-gray-400 font-bold">আপনি এখনো কোনো ট্যুর বুকিং করেননি।</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Modal -->
    <div id="profileModal" class="fixed inset-0 z-[200] hidden flex items-center justify-center p-6 bg-gray-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-[45px] p-10 shadow-2xl animate-float">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-black text-gray-900">প্রোফাইল আপডেট করুন</h3>
                <button onclick="toggleModal('profileModal')" class="text-gray-400 hover:text-gray-600"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <form action="{{ route('dashboard.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-2">আপনার নাম</label>
                    <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-8 py-4 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-2">ইমেইল অ্যাড্রেস</label>
                    <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-8 py-4 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 font-en">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-3xl font-black text-xl hover:bg-blue-700 transition shadow-xl shadow-blue-500/40">সংরক্ষণ করুন</button>
            </form>
        </div>
    </div>

    <!-- Password Modal -->
    <div id="passwordModal" class="fixed inset-0 z-[200] hidden flex items-center justify-center p-6 bg-gray-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-[45px] p-10 shadow-2xl animate-float">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-black text-gray-900">পাসওয়ার্ড পরিবর্তন করুন</h3>
                <button onclick="toggleModal('passwordModal')" class="text-gray-400 hover:text-gray-600"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <form action="{{ route('dashboard.password.update') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-2">বর্তমান পাসওয়ার্ড</label>
                    <input type="password" name="current_password" required class="w-full px-8 py-4 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 font-en" placeholder="••••••••">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-2">নতুন পাসওয়ার্ড</label>
                    <input type="password" name="password" required class="w-full px-8 py-4 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 font-en" placeholder="••••••••">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-2">পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input type="password" name="password_confirmation" required class="w-full px-8 py-4 bg-gray-50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 font-en" placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-3xl font-black text-xl hover:bg-blue-700 transition shadow-xl shadow-blue-500/40">পাসওয়ার্ড আপডেট করুন</button>
            </form>
        </div>
    </div>
@endsection

@section('extra_scripts')
    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-gray-900/60')) {
                event.target.classList.add('hidden');
            }
        }
    </script>
@endsection
