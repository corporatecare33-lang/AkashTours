<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বুকিং কনফার্মেশন - Akash Tours and Travels</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden text-center">
        <div class="bg-blue-600 p-12 text-white">
            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h1 class="text-3xl font-bold mb-2">অভিনন্দন! আপনার বুকিং সম্পন্ন হয়েছে</h1>
            <p class="text-blue-100 italic">Akash Tours and Travels এর সাথে থাকার জন্য ধন্যবাদ</p>
        </div>

        <div class="p-12 space-y-8">
            <div class="grid grid-cols-2 gap-6 text-left">
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-gray-500 text-xs mb-1 uppercase tracking-wider font-bold">বুকিং আইডি</p>
                    <p class="text-xl font-bold text-gray-800">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-gray-500 text-xs mb-1 uppercase tracking-wider font-bold">ট্যুর প্যাকেজ</p>
                    <p class="text-xl font-bold text-gray-800">{{ $booking->tour->title }}</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-gray-500 text-xs mb-1 uppercase tracking-wider font-bold">সিট নাম্বার</p>
                    <p class="text-xl font-bold text-blue-600">{{ implode(', ', $booking->selected_seats) }}</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-gray-500 text-xs mb-1 uppercase tracking-wider font-bold">মোট খরচ</p>
                    <p class="text-xl font-bold text-green-600">৳{{ number_format($booking->total_price) }}</p>
                </div>
            </div>

            <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100 text-left">
                <h4 class="font-bold text-blue-800 mb-2">পরবর্তী করণীয়:</h4>
                <ul class="text-sm text-blue-700 space-y-2">
                    <li class="flex items-start"><svg class="w-4 h-4 mr-2 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg> আপনার নির্বাচিত পেমেন্ট মেথড ({{ strtoupper($booking->payment_method) }}) এর মাধ্যমে পেমেন্ট সম্পন্ন করুন।</li>
                    <li class="flex items-start"><svg class="w-4 h-4 mr-2 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg> পেমেন্ট করার পর ট্রানজিশন আইডি আমাদের হোয়াটসঅ্যাপে পাঠান।</li>
                    <li class="flex items-start"><svg class="w-4 h-4 mr-2 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg> আমাদের প্রতিনিধি আপনাকে কল করে নিশ্চিত করবেন।</li>
                </ul>
            </div>

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                <a href="{{ route('home') }}" class="flex-1 bg-gray-900 text-white py-4 rounded-xl font-bold hover:bg-gray-800 transition">হোমে ফিরে যান</a>
                <a href="https://wa.me/8801711662685" target="_blank" class="flex-1 bg-green-600 text-white py-4 rounded-xl font-bold hover:bg-green-700 transition">হোয়াটসঅ্যাপে জানান</a>
            </div>
        </div>
    </div>
</body>
</html>
