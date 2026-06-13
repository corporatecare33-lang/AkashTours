<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Akash Tours</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-950 flex items-center justify-center p-6">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1800')] bg-cover bg-center opacity-25"></div>
    <div class="absolute inset-0 bg-slate-950/70"></div>

    <main class="relative w-full max-w-md bg-white rounded-[32px] p-8 shadow-2xl">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl">A</div>
                <h1 class="text-3xl font-black text-gray-900">Akash<span class="text-blue-600">Tours</span></h1>
            </a>
            <h2 class="mt-6 text-2xl font-black text-gray-900">Admin Login</h2>
            <p class="mt-2 text-sm font-bold text-gray-500">Use your admin email and password.</p>
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', 'admin@akashtours.com') }}"
                    required
                    autofocus
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl font-bold text-gray-800 outline-none focus:ring-2 focus:ring-blue-600/20"
                    placeholder="admin@akashtours.com"
                >
                @error('email') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl font-bold text-gray-800 outline-none focus:ring-2 focus:ring-blue-600/20"
                    placeholder="Admin@12345"
                >
                @error('password') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-lg hover:bg-blue-700 transition shadow-xl shadow-blue-600/30">
                Login to Dashboard
            </button>
        </form>
    </main>
</body>
</html>
