@extends('layouts.app')

@section('title', 'বুকিং - ' . $tour->title)

@section('extra_styles')
    <style>
        .seat { width: 50px; height: 40px; border-radius: 12px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; align-items: center; justify-content: center; font-weight: 800; border: 2px solid #f1f5f9; position: relative; font-size: 12px; font-family: var(--font-english); }
        .seat.available { background-color: white; color: #64748b; }
        .seat.available:hover { border-color: #2563eb; color: #2563eb; transform: translateY(-2px); shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.1); }
        .seat.selected { background-color: #2563eb; color: white; border-color: #2563eb; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.25); }
        .seat.booked { background-color: #f1f5f9; color: #cbd5e1; cursor: not-allowed; border-color: #f1f5f9; }
        .seat.booked::after { content: ''; position: absolute; width: 60%; height: 2px; background: #cbd5e1; transform: rotate(45deg); }
        .bus-container { background: #ffffff; border-radius: 40px; padding: 40px; border: 1px solid #f1f5f9; position: relative; max-width: 360px; margin: 0 auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05); }
        .bus-row { display: grid; grid-template-columns: repeat(2, 50px) 40px repeat(2, 50px); gap: 12px; margin-bottom: 15px; align-items: center; }
        .bus-row.last-row { grid-template-columns: repeat(5, 50px); gap: 12px; }
        .corridor { width: 40px; }
        .driver-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 2px dashed #f1f5f9; }
    </style>
@endsection

@section('content')
    <main class="container mx-auto px-6 py-12">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button & Progress -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                <a href="{{ route('tours.show', $tour->id) }}" class="flex items-center space-x-3 text-gray-500 font-bold hover:text-blue-600 transition group">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 group-hover:bg-blue-50 group-hover:border-blue-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </div>
                    <span>প্যাকেজ ডিটেইলসে ফিরে যান</span>
                </a>
                <div class="flex items-center space-x-6 bg-white px-8 py-4 rounded-3xl border border-gray-50 shadow-sm">
                    <span class="text-gray-400 font-black text-xs uppercase tracking-widest">বুকিং প্রসেস</span>
                    <div class="w-32 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="w-2/3 h-full bg-blue-600 animate-pulse"></div>
                    </div>
                    <span class="text-blue-600 font-black text-xs uppercase tracking-widest font-en">Step 2/3</span>
                </div>
            </div>

            <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                <input type="hidden" name="total_price" id="totalPriceInput" value="0">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Left: Seat Selection (5 cols) -->
                    <div class="lg:col-span-5 space-y-8">
                        <div class="bg-white p-12 rounded-[50px] shadow-2xl shadow-blue-100/20 border border-gray-50">
                            <h2 class="text-3xl font-black text-gray-900 mb-10 flex items-center tracking-tighter">
                                <div class="w-2 h-8 bg-blue-600 rounded-full mr-4"></div>
                                বাসের সিট পছন্দ করুন
                            </h2>
                            
                            <div class="grid grid-cols-3 gap-4 mb-12 bg-gray-50/50 p-8 rounded-[35px] border border-gray-100">
                                <div class="text-center space-y-3">
                                    <div class="seat available mx-auto border-gray-200"></div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">খালি</p>
                                </div>
                                <div class="text-center space-y-3">
                                    <div class="seat selected mx-auto"></div>
                                    <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">পছন্দ</p>
                                </div>
                                <div class="text-center space-y-3">
                                    <div class="seat booked mx-auto"></div>
                                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">বুকড</p>
                                </div>
                            </div>

                            <div class="bus-container">
                                <div class="driver-section">
                                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">Entry</div>
                                    <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 border border-gray-200">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-7.5 4a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path></svg>
                                    </div>
                                </div>

                                @php
                                    $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
                                @endphp

                                @foreach($rows as $row)
                                    <div class="bus-row">
                                        @for($i = 1; $i <= 2; $i++)
                                            @php $seatId = $row . '-' . $i; $isBooked = in_array($seatId, $bookedSeats); @endphp
                                            <div class="seat {{ $isBooked ? 'booked' : 'available' }}" data-seat="{{ $seatId }}" onclick="toggleSeat(this)">
                                                {{ $seatId }}
                                                <input type="checkbox" name="selected_seats[]" value="{{ $seatId }}" class="hidden" {{ $isBooked ? 'disabled' : '' }}>
                                            </div>
                                        @endfor
                                        
                                        <div class="corridor"></div>

                                        @for($i = 3; $i <= 4; $i++)
                                            @php $seatId = $row . '-' . $i; $isBooked = in_array($seatId, $bookedSeats); @endphp
                                            <div class="seat {{ $isBooked ? 'booked' : 'available' }}" data-seat="{{ $seatId }}" onclick="toggleSeat(this)">
                                                {{ $seatId }}
                                                <input type="checkbox" name="selected_seats[]" value="{{ $seatId }}" class="hidden" {{ $isBooked ? 'disabled' : '' }}>
                                            </div>
                                        @endfor
                                    </div>
                                @endforeach

                                <!-- Last Row (5 seats) -->
                                <div class="bus-row last-row">
                                    @for($i = 1; $i <= 5; $i++)
                                        @php $seatId = 'K-' . $i; $isBooked = in_array($seatId, $bookedSeats); @endphp
                                        <div class="seat {{ $isBooked ? 'booked' : 'available' }}" data-seat="{{ $seatId }}" onclick="toggleSeat(this)">
                                            {{ $seatId }}
                                            <input type="checkbox" name="selected_seats[]" value="{{ $seatId }}" class="hidden" {{ $isBooked ? 'disabled' : '' }}>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Summary & Payment (7 cols) -->
                    <div class="lg:col-span-7 space-y-8">
                        <!-- Tour Summary Card -->
                        <div class="bg-blue-600 p-12 rounded-[60px] text-white shadow-2xl shadow-blue-200 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-80 h-80 bg-white/10 rounded-full -mr-40 -mt-40 blur-[100px]"></div>
                            <div class="relative z-10 space-y-6">
                                <div>
                                    <p class="text-blue-200 font-black text-xs uppercase tracking-[0.3em] mb-3">বুকিং করা হচ্ছে</p>
                                    <h3 class="text-4xl font-black tracking-tighter leading-tight">{{ $tour->title }}</h3>
                                </div>
                                <div class="flex flex-wrap gap-6">
                                    <div class="flex items-center bg-white/10 px-6 py-3 rounded-2xl border border-white/20 backdrop-blur-md font-bold font-en">
                                        <svg class="w-5 h-5 mr-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $tour->date }}
                                    </div>
                                    <div class="flex items-center bg-white/10 px-6 py-3 rounded-2xl border border-white/20 backdrop-blur-md font-bold font-en">
                                        <svg class="w-5 h-5 mr-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $tour->duration }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Form Fields -->
                        <div class="bg-white p-12 rounded-[60px] shadow-2xl shadow-blue-100/10 border border-gray-50 space-y-12">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-4">
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">প্যাসেঞ্জার সংখ্যা</label>
                                    <div class="relative">
                                        <input type="number" name="passenger_count" id="passengerCount" readonly class="w-full px-8 py-6 bg-gray-50 border-none rounded-[30px] font-black text-3xl text-blue-600 outline-none font-en" value="0">
                                        <div class="absolute right-8 top-1/2 -translate-y-1/2 text-gray-300 font-bold">Pers.</div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">কুপন কোড</label>
                                    <div class="flex space-x-3">
                                        <input type="text" name="coupon_code" id="couponCode" class="w-full px-8 py-6 bg-gray-50 border-none rounded-[30px] font-bold text-xl outline-none focus:ring-2 focus:ring-blue-600/20 transition font-en uppercase" placeholder="SAVE10">
                                        <button type="button" onclick="applyCoupon()" class="bg-gray-950 text-white px-10 rounded-[25px] font-black hover:bg-black transition shadow-xl">Apply</button>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-8">
                                <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">পেমেন্ট মেথড পছন্দ করুন</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                    @foreach(['bkash' => 'বিকাশ', 'nagad' => 'নগদ', 'upai' => 'উপায়', 'rocket' => 'রকেট'] as $id => $name)
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="payment_method" value="{{ $id }}" class="hidden peer" required onclick="showPaymentInfo('{{ $id }}', '{{ $name }}')">
                                        <div class="p-8 border-2 border-gray-50 rounded-[40px] flex flex-col items-center peer-checked:border-blue-600 peer-checked:bg-blue-50/30 peer-checked:shadow-2xl peer-checked:shadow-blue-100 transition-all duration-300 group-hover:border-blue-200">
                                            <div class="w-16 h-16 bg-white rounded-2xl mb-4 flex items-center justify-center font-black text-2xl text-gray-300 peer-checked:text-blue-600 shadow-sm border border-gray-50 transition-all font-en">
                                                @if($id == 'bkash') b @elseif($id == 'nagad') n @elseif($id == 'upai') u @else r @endif
                                            </div>
                                            <span class="text-sm font-black text-gray-600 peer-checked:text-blue-900">{{ $name }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Dynamic Payment Info Section -->
                            <div id="paymentInfoBox" class="hidden bg-blue-600 p-10 rounded-[50px] text-white space-y-8 animate-in fade-in zoom-in-95 duration-500">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-2xl font-black tracking-tight flex items-center">
                                        <span id="selectedPaymentName" class="mr-2">বিকাশ</span> পেমেন্ট
                                    </h4>
                                    <div class="bg-white/20 backdrop-blur-md text-white px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest border border-white/30">Send Money</div>
                                </div>
                                
                                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[35px] border border-white/20">
                                    <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-2 opacity-80">আমাদের পার্সোনাল নাম্বার</p>
                                    <p class="text-4xl font-black tracking-[0.1em] font-en">01711662685</p>
                                </div>

                                <div class="space-y-6">
                                    <p class="text-sm text-blue-50 font-bold leading-relaxed opacity-90 italic">
                                        * আপনার টোটাল টাকার সাথে <span class="text-white font-black underline">১.৮% ক্যাশআউট চার্জ</span> অটোমেটিক যোগ করা হয়েছে।
                                    </p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-3">
                                            <label class="text-[10px] font-black text-blue-200 uppercase tracking-widest ml-2">আপনার নাম্বার</label>
                                            <input type="text" name="sender_number" id="senderNumber" class="w-full px-6 py-4 bg-white/10 border-2 border-white/20 rounded-2xl font-black text-white outline-none focus:border-white focus:bg-white/20 transition font-en" placeholder="017XXXXXXXX">
                                        </div>
                                        <div class="space-y-3">
                                            <label class="text-[10px] font-black text-blue-200 uppercase tracking-widest ml-2">ট্রানজেকশন আইডি</label>
                                            <input type="text" name="transaction_id" id="transactionId" class="w-full px-6 py-4 bg-white/10 border-2 border-white/20 rounded-2xl font-black text-white outline-none focus:border-white focus:bg-white/20 transition font-en uppercase" placeholder="8N7X2K9L">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Final Price & Submit -->
                            <div class="pt-12 border-t border-gray-50 flex flex-col md:flex-row justify-between items-center gap-10">
                                <div class="text-center md:text-left">
                                    <p class="text-gray-400 font-black text-xs uppercase tracking-[0.2em] mb-2">মোট পরিশোধযোগ্য</p>
                                    <div class="flex items-baseline justify-center md:justify-start space-x-3">
                                        <span class="text-6xl font-black text-gray-900 tracking-tighter font-en">৳<span id="displayTotalPrice">0</span></span>
                                        <span class="text-blue-600 font-black text-xs bg-blue-50 px-3 py-1 rounded-lg" id="discountText"></span>
                                    </div>
                                </div>
                                <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-16 py-8 rounded-[35px] font-black text-2xl hover:bg-blue-700 transition shadow-2xl shadow-blue-200 group">
                                    বুকিং কনফার্ম করুন
                                    <svg class="w-8 h-8 inline ml-4 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Policy Note -->
                        <div class="bg-amber-50 p-10 rounded-[45px] border border-amber-100 flex items-start space-x-6">
                            <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center shrink-0 border border-amber-200 shadow-sm">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div class="space-y-2">
                                <h4 class="font-black text-amber-900 uppercase tracking-widest text-xs">বুকিং সহায়িকা</h4>
                                <p class="text-amber-800 text-lg font-medium leading-relaxed">পছন্দমতো সিট সিলেক্ট করার পর আপনার মোট টাকা আপডেট হবে। কুপন কোড থাকলে ব্যবহার করুন ডিসকাউন্ট পেতে। পেমেন্ট ভেরিফাই হওয়ার পর বুকিং কনফার্ম হবে।</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @section('extra_scripts')
    <script>
        const pricePerPerson = Number("{{ $tour->price_per_person }}") || 0;
        let selectedSeats = [];
        let discountRate = 1;

        function toggleSeat(el) {
            if (el.classList.contains('booked')) return;
            const seatId = el.dataset.seat;
            const checkbox = el.querySelector('input');
            
            if (el.classList.contains('selected')) {
                el.classList.remove('selected');
                el.classList.add('available');
                checkbox.checked = false;
                selectedSeats = selectedSeats.filter(s => s !== seatId);
            } else {
                el.classList.remove('available');
                el.classList.add('selected');
                checkbox.checked = true;
                selectedSeats.push(seatId);
            }
            updatePrice();
        }

        function showPaymentInfo(id, name) {
            document.getElementById('paymentInfoBox').classList.remove('hidden');
            document.getElementById('selectedPaymentName').innerText = name;
            document.getElementById('senderNumber').required = true;
            document.getElementById('transactionId').required = true;
        }

        function updatePrice() {
            const count = selectedSeats.length;
            document.getElementById('passengerCount').value = count;
            const ppp = Number("{{ $tour->price_per_person }}") || 0;
            const baseWithCoupon = count * ppp * discountRate;
            const totalWithCharge = baseWithCoupon * 1.018;
            const finalPrice = Math.round(totalWithCharge);
            
            document.getElementById('displayTotalPrice').innerText = finalPrice.toLocaleString();
            document.getElementById('totalPriceInput').value = finalPrice;

            let discountLabel = '';
            if (count > 0) {
                if (discountRate < 1) discountLabel += '(১০% ডিসকাউন্ট) ';
                discountLabel += '+ ১.৮% চার্জ';
            }
            document.getElementById('discountText').innerText = discountLabel;
        }

        function applyCoupon() {
            const code = document.getElementById('couponCode').value;
            if (code === 'SAVE10') {
                discountRate = 0.9;
                alert('কুপন সফলভাবে যোগ হয়েছে! ১০% ডিসকাউন্ট পেয়েছেন।');
            } else {
                discountRate = 1;
                alert('ভুল কুপন কোড!');
            }
            updatePrice();
        }

        window.onload = updatePrice;

        document.getElementById('bookingForm').onsubmit = function() {
            if (selectedSeats.length === 0) { alert('দয়া করে অন্তত একটি সিট সিলেক্ট করুন!'); return false; }
            if (!document.querySelector('input[name="payment_method"]:checked')) { alert('দয়া করে পেমেন্ট মেথড পছন্দ করুন!'); return false; }
            if (!document.getElementById('senderNumber').value || !document.getElementById('transactionId').value) {
                alert('দয়া করে আপনার প্রেরক নাম্বার এবং ট্রানজেকশন আইডি প্রদান করুন!'); return false;
            }
            return true;
        };
    </script>
    @endsection
@endsection
