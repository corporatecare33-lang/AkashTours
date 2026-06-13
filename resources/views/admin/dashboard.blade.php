@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('extra_styles')
    <style>
        .admin-panel { display: none; }
        .admin-panel.active { display: block; }
        .admin-tab.active { background: #2563eb; color: #fff; box-shadow: 0 18px 35px rgba(37, 99, 235, .22); }
    </style>
@endsection

@section('content')
    <section class="bg-slate-950 text-white">
        <div class="container mx-auto px-6 py-14">
            <div class="flex flex-col xl:flex-row justify-between gap-10">
                <div class="max-w-3xl">
                    <p class="text-blue-300 text-xs font-black uppercase tracking-[0.3em] font-en">Akash Tours Admin</p>
                    <h1 class="mt-4 text-4xl lg:text-6xl font-black tracking-tight">Premium CMS Dashboard</h1>
                    <p class="mt-4 text-slate-300 text-lg leading-relaxed">Category wise content control. Banner, frontend headings, tour packages, destinations, payment logos and bookings are separated for easier editing.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 min-w-full xl:min-w-[560px]">
                    @foreach([
                        ['Bookings', $stats['bookings']],
                        ['Tours', $stats['tours']],
                        ['Users', $stats['users']],
                        ['Revenue', 'Tk ' . number_format($stats['revenue'])],
                    ] as [$label, $value])
                        <div class="bg-white/10 border border-white/10 rounded-3xl p-5">
                            <p class="text-xs text-slate-400 font-black uppercase tracking-widest font-en">{{ $label }}</p>
                            <p class="mt-2 text-3xl font-black font-en">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-10">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-100 text-green-700 p-5 rounded-3xl font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-100 text-red-700 p-5 rounded-3xl font-bold">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-[280px_1fr] gap-8 items-start">
            <aside class="xl:sticky xl:top-28 bg-white border border-gray-100 rounded-[34px] shadow-xl shadow-slate-200/60 p-4">
                <div class="p-4 border-b border-gray-100 mb-3">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest font-en">Categories</p>
                    <h2 class="text-2xl font-black mt-1">Content Manager</h2>
                </div>
                <div class="space-y-2">
                    @foreach([
                        'overview' => ['Overview', 'Stats and quick links'],
                        'banner' => ['Banner', 'Hero image and text'],
                        'sections' => ['Section Text', 'Frontend headings'],
                        'packages' => ['Tour Packages', 'Cards and details'],
                        'destinations' => ['Destinations', 'Top category images'],
                        'payments' => ['Payments', 'Logo methods'],
                        'bookings' => ['Bookings', 'Recent orders'],
                    ] as $key => [$title, $desc])
                        <button type="button" data-panel="{{ $key }}" class="admin-tab {{ $loop->first ? 'active' : '' }} w-full text-left p-4 rounded-2xl transition text-gray-700 hover:bg-blue-50">
                            <span class="block font-black">{{ $title }}</span>
                            <span class="block mt-1 text-xs font-bold opacity-60">{{ $desc }}</span>
                        </button>
                    @endforeach
                </div>
                <a href="{{ route('home') }}" target="_blank" class="mt-4 flex items-center justify-center bg-slate-950 text-white rounded-2xl px-5 py-4 font-black">View Frontend</a>
            </aside>

            <div class="space-y-8">
                <div id="panel-overview" class="admin-panel active">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8">
                            <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Overview</p>
                            <h2 class="text-4xl font-black mt-2">Everything is connected to your frontend</h2>
                            <p class="mt-4 text-gray-500 text-lg leading-relaxed">Use the category menu to edit each frontend section. Save korar sathe sathe local Laravel frontend update hobe. Vercel static frontend alada build output theke show hoy.</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                                <a href="#panel-banner" data-jump="banner" class="rounded-3xl bg-blue-50 p-6 font-black text-blue-700">Edit Banner</a>
                                <a href="#panel-packages" data-jump="packages" class="rounded-3xl bg-green-50 p-6 font-black text-green-700">Edit Packages</a>
                                <a href="#panel-payments" data-jump="payments" class="rounded-3xl bg-orange-50 p-6 font-black text-orange-700">Edit Payments</a>
                            </div>
                        </div>
                        <div class="bg-slate-950 text-white rounded-[36px] p-8 shadow-xl">
                            <p class="text-blue-300 text-xs font-black uppercase tracking-[0.25em] font-en">Admin Login</p>
                            <h3 class="text-2xl font-black mt-2">{{ $user->name }}</h3>
                            <p class="text-slate-300 mt-2">{{ $user->email }}</p>
                            <div class="mt-8 space-y-3 text-sm font-bold text-slate-300">
                                <p>Total destinations: {{ $destinations->count() }}</p>
                                <p>Total payment logos: {{ $paymentMethods->count() }}</p>
                                <p>Total packages: {{ $tours->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="panel-banner" class="admin-panel">
                    <form action="{{ route('admin.content.hero') }}" method="POST" class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-6">
                        @csrf
                        <div>
                            <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Banner</p>
                            <h2 class="text-3xl font-black mt-2">Hero title, description, buttons and images</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <x-admin.input name="eyebrow" label="Small Badge" :value="$hero['eyebrow'] ?? ''" />
                            <x-admin.input name="highlight" label="Highlight Word" :value="$hero['highlight'] ?? ''" />
                        </div>
                        <x-admin.input name="title" label="Main Title" :value="$hero['title'] ?? ''" required="true" />
                        <label class="space-y-2 block">
                            <span class="text-xs font-black text-gray-400 uppercase">Description</span>
                            <textarea name="description" rows="4" required class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100">{{ $hero['description'] ?? '' }}</textarea>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <x-admin.input name="primary_button" label="Primary Button" :value="$hero['primary_button'] ?? 'ট্যুর প্যাকেজ দেখুন'" required="true" />
                            <x-admin.input name="secondary_button" label="Secondary Button" :value="$hero['secondary_button'] ?? 'যোগাযোগ করুন'" required="true" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @for($i = 0; $i < 4; $i++)
                                <x-admin.input name="images[]" label="Banner Image {{ $i + 1 }}" :value="$hero['images'][$i] ?? ''" />
                            @endfor
                        </div>
                        <button class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-700">Save Banner</button>
                    </form>
                </div>

                <div id="panel-sections" class="admin-panel">
                    <form action="{{ route('admin.content.sections') }}" method="POST" class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-5">
                        @csrf
                        <div>
                            <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Section Text</p>
                            <h2 class="text-3xl font-black mt-2">Homepage category titles and descriptions</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach([
                                'packages_title' => 'Popular Package Title',
                                'packages_description' => 'Popular Package Description',
                                'destinations_title' => 'Top Destination Title',
                                'destinations_description' => 'Top Destination Description',
                                'payments_title' => 'Payment Title',
                                'payments_description' => 'Payment Description',
                            ] as $field => $label)
                                <x-admin.input :name="$field" :label="$label" :value="$sections[$field] ?? ''" required="true" />
                            @endforeach
                        </div>
                        <button class="bg-slate-950 text-white px-8 py-4 rounded-2xl font-black hover:bg-slate-800">Save Section Text</button>
                    </form>
                </div>

                <div id="panel-packages" class="admin-panel">
                    <div class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8">
                        <div class="mb-8">
                            <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Tour Packages</p>
                            <h2 class="text-3xl font-black mt-2">Package picture, name, price and description</h2>
                        </div>
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($tours as $tour)
                                <form action="{{ route('admin.content.tours.update', $tour) }}" method="POST" class="border border-gray-100 rounded-[28px] p-5 grid grid-cols-1 lg:grid-cols-[220px_1fr] gap-5">
                                    @csrf
                                    <img src="{{ $tour->image }}" alt="{{ $tour->title }}" class="w-full h-56 lg:h-full object-cover rounded-3xl">
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
                                        <div class="flex flex-wrap gap-3">
                                            <input name="total_seats" value="{{ $tour->total_seats }}" required type="number" class="w-32 bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none" placeholder="Seats">
                                            <button class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-black hover:bg-blue-700">Save Package</button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="panel-destinations" class="admin-panel">
                    <div class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-6">
                        <div>
                            <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Top Destinations</p>
                            <h2 class="text-3xl font-black mt-2">Destination category image and text</h2>
                        </div>
                        @include('admin.partials.destination-form', ['destinations' => $destinations])
                    </div>
                </div>

                <div id="panel-payments" class="admin-panel">
                    <div class="bg-white rounded-[36px] border border-gray-100 shadow-xl shadow-slate-200/60 p-8 space-y-6">
                        <div>
                            <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] font-en">Payment Methods</p>
                            <h2 class="text-3xl font-black mt-2">Payment logo picture and name</h2>
                        </div>
                        @include('admin.partials.payment-form', ['paymentMethods' => $paymentMethods])
                    </div>
                </div>

                <div id="panel-bookings" class="admin-panel">
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
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_scripts')
    <script>
        const activatePanel = (key) => {
            document.querySelectorAll('.admin-panel').forEach(panel => panel.classList.remove('active'));
            document.querySelectorAll('.admin-tab').forEach(tab => tab.classList.remove('active'));
            document.getElementById(`panel-${key}`)?.classList.add('active');
            document.querySelector(`[data-panel="${key}"]`)?.classList.add('active');
        };

        document.querySelectorAll('[data-panel]').forEach(tab => {
            tab.addEventListener('click', () => activatePanel(tab.dataset.panel));
        });

        document.querySelectorAll('[data-jump]').forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                activatePanel(link.dataset.jump);
                window.scrollTo({ top: document.querySelector('.admin-tab.active').getBoundingClientRect().top + window.scrollY - 120, behavior: 'smooth' });
            });
        });
    </script>
@endsection
