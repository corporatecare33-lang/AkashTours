<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Akash Tours</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700;900&family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Noto Sans Bengali', 'Poppins', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .video-bg { position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); z-index: -1; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">
    <video autoplay muted loop playsinline class="video-bg">
        <source src="https://assets.mixkit.co/videos/preview/mixkit-top-view-of-a-winding-road-in-the-mountains-32865-preview.mp4" type="video/mp4">
    </video>
    <div class="overlay"></div>

    <div class="glass w-full max-w-md p-10 rounded-[50px] shadow-2xl space-y-8">
        <div class="text-center space-y-4">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 mb-4">
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-xl shadow-blue-500/50">A</div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tighter">Akash<span class="text-blue-600">Tours</span></h1>
            </a>
            <h2 class="text-2xl font-black text-gray-800">ফিরে আসায় স্বাগতম!</h2>
            <p class="text-gray-500 font-medium">আপনার অ্যাকাউন্টে লগইন করুন</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-2">ইমেইল অ্যাড্রেস</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-8 py-4 bg-white/50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 transition font-en" placeholder="example@mail.com">
                @error('email') <p class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-2">পাসওয়ার্ড</label>
                <input type="password" name="password" required class="w-full px-8 py-4 bg-white/50 border-none rounded-3xl font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-600/20 transition font-en" placeholder="••••••••">
                @error('password') <p class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between px-2">
                <label class="flex items-center text-sm font-bold text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 mr-2">
                    মনে রাখুন
                </label>
                <a href="#" class="text-sm font-bold text-blue-600 hover:underline">পাসওয়ার্ড ভুলে গেছেন?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-3xl font-black text-xl hover:bg-blue-700 transition shadow-xl shadow-blue-500/40">লগইন করুন</button>
        </form>

        <p class="text-center text-gray-500 font-bold">অ্যাকাউন্ট নেই? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">রেজিস্টার করুন</a></p>
    </div>
</body>
</html>
