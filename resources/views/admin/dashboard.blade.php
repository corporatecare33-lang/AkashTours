@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <section class="bg-slate-950 text-white">
        <div class="container mx-auto px-6 py-16">
            <div class="flex flex-col lg:flex-row justify-between gap-8">
                <div>
                    <p class="text-blue-300 text-xs font-black uppercase tracking-[0.3em] font-en">Akash Tours CMS</p>
                    <h1 class="mt-4 text-4xl lg:text-6xl font-black tracking-tight">Admin Dashboard</h1>
                    <p class="mt-4 text-slate-300 max-w-2xl">Homepage er banner, tour packages, top destinations, payment logos, title and description sob ekhane edit kora jabe.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white/10 border border-white/10 rounded-3xl p-5">
                        <p class="text-xs text-slate-400 font-black uppercase">Bookings</p>
                        <p class="text-3xl font-black font-en">{{ $stats['bookings'] }}</p>
                    </div>
                    <div class="bg-white/10 border border-white/10 rounded-3xl p-5">
                        <p class="text-xs text-slate-400 font-black uppercase">Tours</p>
                        <p class="text-3xl font-black font-en">{{ $stats['tours'] }}</p>
                    </div>
                    <div class="bg-white/10 border border-white/10 rounded-3xl p-5">
                        <p class="text-xs text-slate-400 font-black uppercase">Users</p>
                        <p class="text-3xl font-black font-en">{{ $stats['users'] }}</p>
                    </div>
                    <div class="bg-white/10 border border-white/10 rounded-3xl p-5">
                        <p class="text-xs text-slate-400 font-black uppercase">Revenue</p>
                        <p class="text-3xl font-black font-en">Tk {{ number_format($stats['revenue']) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-12 space-y-10">
        @if(session('success'))
            <div class="bg-green-50 border border-green-100 text-green-700 p-5 rounded-3xl font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-700 p-5 rounded-3xl font-bold">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <form action="{{ route('admin.content.hero') }}" method="POST" class="xl:col-span-2 bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-6">
                @csrf
                <div>
                    <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Hero Banner</p>
                    <h2 class="text-3xl font-black mt-2">Banner title, description, button and images</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="space-y-2">
                        <span class="text-xs font-black text-gray-400 uppercase">Small Badge</span>
                        <input name="eyebrow" value="{{ $hero['eyebrow'] ?? '' }}" class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100">
                    </label>
                    <label class="space-y-2">
                        <span class="text-xs font-black text-gray-400 uppercase">Highlight Word</span>
                        <input name="highlight" value="{{ $hero['highlight'] ?? '' }}" class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100">
                    </label>
                </div>

                <label class="space-y-2 block">
                    <span class="text-xs font-black text-gray-400 uppercase">Main Title</span>
                    <input name="title" value="{{ $hero['title'] ?? '' }}" required class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold text-xl outline-none focus:ring-2 focus:ring-blue-100">
                </label>

                <label class="space-y-2 block">
                    <span class="text-xs font-black text-gray-400 uppercase">Description</span>
                    <textarea name="description" rows="4" required class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100">{{ $hero['description'] ?? '' }}</textarea>
                </label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="space-y-2">
                        <span class="text-xs font-black text-gray-400 uppercase">Primary Button</span>
                        <input name="primary_button" value="{{ $hero['primary_button'] ?? 'ট্যুর প্যাকেজ দেখুন' }}" required class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100">
                    </label>
                    <label class="space-y-2">
                        <span class="text-xs font-black text-gray-400 uppercase">Secondary Button</span>
                        <input name="secondary_button" value="{{ $hero['secondary_button'] ?? 'যোগাযোগ করুন' }}" required class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100">
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @for($i = 0; $i < 4; $i++)
                        <label class="space-y-2">
                            <span class="text-xs font-black text-gray-400 uppercase">Banner Image {{ $i + 1 }}</span>
                            <input name="images[]" value="{{ $hero['images'][$i] ?? '' }}" class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100" placeholder="https://...">
                        </label>
                    @endfor
                </div>

                <button class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-700">Save Banner</button>
            </form>

            <form action="{{ route('admin.content.sections') }}" method="POST" class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-5">
                @csrf
                <div>
                    <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Section Text</p>
                    <h2 class="text-3xl font-black mt-2">Frontend headings</h2>
                </div>
                @foreach([
                    'packages_title' => 'Popular Package Title',
                    'packages_description' => 'Popular Package Description',
                    'destinations_title' => 'Top Destination Title',
                    'destinations_description' => 'Top Destination Description',
                    'payments_title' => 'Payment Title',
                    'payments_description' => 'Payment Description',
                ] as $field => $label)
                    <label class="space-y-2 block">
                        <span class="text-xs font-black text-gray-400 uppercase">{{ $label }}</span>
                        <input name="{{ $field }}" value="{{ $sections[$field] ?? '' }}" required class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100">
                    </label>
                @endforeach
                <button class="bg-slate-950 text-white px-8 py-4 rounded-2xl font-black hover:bg-slate-800">Save Text</button>
            </form>
        </div>

        <div class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8">
            <div class="flex flex-col md:flex-row justify-between gap-4 mb-8">
                <div>
                    <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Popular Tours</p>
                    <h2 class="text-3xl font-black mt-2">Package picture, name, price and description</h2>
                </div>
                <a href="{{ route('home') }}#packages" target="_blank" class="self-start bg-blue-50 text-blue-600 px-5 py-3 rounded-2xl font-black">View Frontend</a>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                @foreach($tours as $tour)
                    <form action="{{ route('admin.content.tours.update', $tour) }}" method="POST" class="border border-gray-100 rounded-[28px] p-5 grid grid-cols-1 md:grid-cols-[160px_1fr] gap-5">
                        @csrf
                        <img src="{{ $tour->image }}" alt="{{ $tour->title }}" class="w-full h-44 md:h-full object-cover rounded-3xl">
                        <div class="space-y-4">
                            <input name="title" value="{{ $tour->title }}" required class="w-full bg-gray-50 rounded-2xl px-4 py-3 font-black outline-none">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input name="destination" value="{{ $tour->destination }}" required class="w-full bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Destination">
                                <input name="duration" value="{{ $tour->duration }}" class="w-full bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Duration">
                                <input name="price_per_person" value="{{ $tour->price_per_person }}" required type="number" class="w-full bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Price">
                                <input name="date" value="{{ $tour->date }}" required class="w-full bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Date">
                            </div>
                            <input name="image" value="{{ $tour->image }}" required class="w-full bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Image URL">
                            <textarea name="description" rows="3" class="w-full bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Description">{{ $tour->description }}</textarea>
                            <div class="flex gap-3">
                                <input name="total_seats" value="{{ $tour->total_seats }}" required type="number" class="w-32 bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Seats">
                                <button class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-black hover:bg-blue-700">Save Package</button>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <div class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-6">
                <div>
                    <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Top Destinations</p>
                    <h2 class="text-3xl font-black mt-2">Category image and text</h2>
                </div>

                <form action="{{ route('admin.content.destinations.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3 bg-blue-50 p-4 rounded-3xl">
                    @csrf
                    <input name="name" required placeholder="Name" class="rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="subtitle" placeholder="Subtitle" class="rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="image" required placeholder="Image URL" class="md:col-span-2 rounded-2xl px-4 py-3 font-bold outline-none">
                    <select name="layout" class="rounded-2xl px-4 py-3 font-bold outline-none">
                        <option value="normal">Normal</option>
                        <option value="wide">Wide</option>
                        <option value="tall">Tall</option>
                    </select>
                    <input name="sort_order" type="number" value="10" class="rounded-2xl px-4 py-3 font-bold outline-none">
                    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" checked> Active</label>
                    <button class="bg-blue-600 text-white rounded-2xl px-4 py-3 font-black">Add Destination</button>
                </form>

                <div class="space-y-4">
                    @foreach($destinations as $destination)
                        <div class="border border-gray-100 rounded-3xl p-4">
                            <form action="{{ route('admin.content.destinations.update', $destination) }}" method="POST" class="grid grid-cols-1 md:grid-cols-[120px_1fr] gap-4">
                                @csrf
                                <img src="{{ $destination->image }}" class="w-full h-32 object-cover rounded-2xl" alt="{{ $destination->name }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <input name="name" value="{{ $destination->name }}" required class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                    <input name="subtitle" value="{{ $destination->subtitle }}" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                    <input name="image" value="{{ $destination->image }}" required class="md:col-span-2 bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                    <select name="layout" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                        @foreach(['normal', 'wide', 'tall'] as $layout)
                                            <option value="{{ $layout }}" @selected($destination->layout === $layout)>{{ ucfirst($layout) }}</option>
                                        @endforeach
                                    </select>
                                    <input name="sort_order" type="number" value="{{ $destination->sort_order }}" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" @checked($destination->is_active)> Active</label>
                                    <button class="bg-slate-950 text-white rounded-2xl px-4 py-3 font-black">Save</button>
                                </div>
                            </form>
                            <form action="{{ route('admin.content.destinations.delete', $destination) }}" method="POST" class="mt-3 text-right">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 font-black text-sm">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-6">
                <div>
                    <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Payment Methods</p>
                    <h2 class="text-3xl font-black mt-2">Logo picture and name</h2>
                </div>

                <form action="{{ route('admin.content.payments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3 bg-blue-50 p-4 rounded-3xl">
                    @csrf
                    <input name="name" required placeholder="Name" class="rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="sort_order" type="number" value="20" class="rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="logo" required placeholder="Logo URL" class="md:col-span-2 rounded-2xl px-4 py-3 font-bold outline-none">
                    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" checked> Active</label>
                    <button class="bg-blue-600 text-white rounded-2xl px-4 py-3 font-black">Add Payment</button>
                </form>

                <div class="space-y-4">
                    @foreach($paymentMethods as $method)
                        <div class="border border-gray-100 rounded-3xl p-4">
                            <form action="{{ route('admin.content.payments.update', $method) }}" method="POST" class="grid grid-cols-1 md:grid-cols-[120px_1fr] gap-4">
                                @csrf
                                <div class="bg-gray-50 rounded-2xl p-4 flex items-center justify-center">
                                    <img src="{{ $method->logo }}" class="max-h-16 max-w-full" alt="{{ $method->name }}">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <input name="name" value="{{ $method->name }}" required class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                    <input name="sort_order" type="number" value="{{ $method->sort_order }}" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                    <input name="logo" value="{{ $method->logo }}" required class="md:col-span-2 bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                                    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" @checked($method->is_active)> Active</label>
                                    <button class="bg-slate-950 text-white rounded-2xl px-4 py-3 font-black">Save</button>
                                </div>
                            </form>
                            <form action="{{ route('admin.content.payments.delete', $method) }}" method="POST" class="mt-3 text-right">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 font-black text-sm">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8">
            <h2 class="text-3xl font-black mb-6">Recent Bookings</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-xs uppercase tracking-widest text-gray-400">
                        <tr>
                            <th class="py-4">User</th>
                            <th>Tour</th>
                            <th>Seats</th>
                            <th>Total</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="py-4 font-bold">{{ $booking->user->name ?? 'Guest' }}<br><span class="text-xs text-gray-400">{{ $booking->user->email ?? '' }}</span></td>
                                <td class="font-bold">{{ $booking->tour->title ?? 'Deleted tour' }}</td>
                                <td class="font-en">{{ $booking->passenger_count }}</td>
                                <td class="font-en font-black text-blue-600">Tk {{ number_format($booking->total_price) }}</td>
                                <td><span class="px-3 py-1 rounded-xl bg-orange-50 text-orange-600 text-xs font-black">{{ $booking->payment_status }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-10 text-center text-gray-400 font-bold">No bookings yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
