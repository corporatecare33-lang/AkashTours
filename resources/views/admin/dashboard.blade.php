<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Akash Tours</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800;900&family=Poppins:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Noto Sans Bengali', sans-serif; background: #f7f6f4; }
        .font-en { font-family: 'Poppins', sans-serif; }
        .admin-panel { display: none; }
        .admin-panel.active { display: block; }
        .admin-tab.active { background: #f05a28; color: #fff; box-shadow: 0 12px 22px rgba(240, 90, 40, .22); }
        .admin-tab.active svg { color: #fff; }
        .admin-card { background: #fff; border: 1px solid #dedbd5; border-radius: 14px; box-shadow: 0 1px 0 rgba(15, 23, 42, .02); }
        .admin-input { width: 100%; border-radius: 12px; background: #f8fafc; border: 1px solid #e2e8f0; padding: 13px 15px; font-weight: 700; outline: none; }
        .admin-input:focus { border-color: #f05a28; box-shadow: 0 0 0 3px rgba(240, 90, 40, .12); }
        .field-label { display: block; color: #94a3b8; font-size: 11px; font-weight: 900; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 7px; }
        .soft-panel { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; }
        .table-head { color: #64748b; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: .08em; }
    </style>
</head>
<body class="text-slate-950">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-[256px_1fr]">
        <aside class="bg-white border-r border-slate-200 lg:min-h-screen">
            <div class="h-16 px-4 flex items-center gap-3 border-b border-slate-200">
                <div class="w-9 h-9 bg-[#f05a28] text-white rounded-xl flex items-center justify-center font-black font-en">A</div>
                <div>
                    <h1 class="text-[#f05a28] font-black leading-none">Admin Panel</h1>
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest font-en mt-1">Akash Tours</p>
                </div>
            </div>

            <nav class="p-3 space-y-1">
                @foreach([
                    'overview' => ['ড্যাশবোর্ড', 'M4 6h16M4 12h16M4 18h16'],
                    'banner' => ['ব্যানার', 'M3 5h18v14H3z M8 13l2-2 3 3 2-2 3 4'],
                    'sections' => ['ফ্রন্টেন্ড টেক্সট', 'M4 6h16M4 12h10M4 18h16'],
                    'packages' => ['ট্যুর প্যাকেজ', 'M3 7h18M6 7v13m12-13v13M5 20h14'],
                    'destinations' => ['গন্তব্য ক্যাটাগরি', 'M12 21s7-4.438 7-11a7 7 0 10-14 0c0 6.562 7 11 7 11z M12 10.5h.01'],
                    'payments' => ['পেমেন্ট লোগো', 'M3 7h18v10H3z M3 10h18'],
                    'bookings' => ['অর্ডার/বুকিং', 'M6 6h15l-1.5 9h-12z M6 6L5 3H2'],
                ] as $key => [$label, $icon])
                    <button type="button" data-panel="{{ $key }}" class="admin-tab {{ $loop->first ? 'active' : '' }} w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left font-black text-slate-700 hover:bg-orange-50 transition">
                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                        <span>{{ $label }}</span>
                    </button>
                @endforeach
            </nav>
        </aside>

        <div class="min-w-0">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6">
                <h2 class="font-black">Admin Panel</h2>
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-orange-200 text-[#f05a28] font-black text-sm">
                        লাইভ সাইট
                    </a>
                    <span class="text-sm text-slate-500 font-en">{{ $user->email }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="px-3 py-2 bg-red-50 text-red-500 rounded-lg font-black text-sm">Logout</button>
                    </form>
                </div>
            </header>

            <main class="p-4 md:p-8 space-y-6">
                @if(session('success'))
                    <div class="admin-card p-4 bg-green-50 border-green-200 text-green-700 font-bold">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="admin-card p-4 bg-red-50 border-red-200 text-red-700 font-bold">{{ $errors->first() }}</div>
                @endif

                <section id="panel-overview" class="admin-panel active space-y-6">
                    <div>
                        <h1 class="text-3xl font-black">ড্যাশবোর্ড</h1>
                        <p class="text-slate-500 mt-1 font-bold">সাইটের সব ফ্রন্টেন্ড কনটেন্ট ক্যাটাগরি অনুযায়ী এখান থেকে পরিবর্তন করা যাবে।</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                        @foreach([
                            ['মোট বুকিং', $stats['bookings'], 'bg-blue-500', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2 8m2-8l2 8m8-8l2 8'],
                            ['মোট সেলস', '৳' . number_format($stats['revenue']), 'bg-green-500', 'M12 8c-2 0-3 1-3 2s1 2 3 2 3 1 3 2-1 2-3 2m0-10v14'],
                            ['মোট ইউজার', $stats['users'], 'bg-purple-500', 'M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z'],
                            ['মোট প্যাকেজ', $stats['tours'], 'bg-orange-500', 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10'],
                        ] as [$label, $value, $color, $icon])
                            <div class="admin-card p-5 flex items-center gap-4">
                                <div class="w-12 h-12 {{ $color }} text-white rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-black font-en">{{ $value }}</p>
                                    <p class="text-xs text-slate-500 font-bold">{{ $label }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-1 xl:grid-cols-[2fr_1fr] gap-4">
                        <div class="admin-card p-6">
                            <h3 class="font-black text-lg mb-5 text-[#f05a28]">সাইট কনটেন্ট ম্যানেজমেন্ট</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach([
                                    ['banner', 'ব্যানার', 'Hero title, button, image'],
                                    ['packages', 'ট্যুর প্যাকেজ', 'Package name, price, image'],
                                    ['payments', 'পেমেন্ট লোগো', 'Payment logo add/edit'],
                                ] as [$key, $title, $desc])
                                    <button data-jump="{{ $key }}" class="text-left bg-orange-50 hover:bg-orange-100 rounded-2xl p-5 transition">
                                        <span class="block font-black text-[#f05a28]">{{ $title }}</span>
                                        <span class="block text-sm text-slate-500 mt-2 font-bold">{{ $desc }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <div class="admin-card p-6">
                            <h3 class="font-black text-lg mb-4">কুইক সেটিংস</h3>
                            <div class="space-y-3 text-sm font-bold">
                                <div class="flex justify-between border-b pb-3"><span>Active destinations</span><span>{{ $destinations->where('is_active', true)->count() }}</span></div>
                                <div class="flex justify-between border-b pb-3"><span>Payment logos</span><span>{{ $paymentMethods->where('is_active', true)->count() }}</span></div>
                                <div class="flex justify-between"><span>Packages</span><span>{{ $tours->count() }}</span></div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="panel-banner" class="admin-panel">
                    <form action="{{ route('admin.content.hero') }}" method="POST" class="admin-card p-6 space-y-5">
                        @csrf
                        <div>
                            <h2 class="text-2xl font-black">ব্যানার ম্যানেজমেন্ট</h2>
                            <p class="text-slate-500 font-bold">Hero title, description, button এবং background image পরিবর্তন করুন।</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-admin.input name="eyebrow" label="Small Badge" :value="$hero['eyebrow'] ?? ''" />
                            <x-admin.input name="highlight" label="Highlight Word" :value="$hero['highlight'] ?? ''" />
                        </div>
                        <x-admin.input name="title" label="Main Title" :value="$hero['title'] ?? ''" required="true" />
                        <label class="space-y-2 block">
                            <span class="text-xs font-black text-gray-400 uppercase">Description</span>
                            <textarea name="description" rows="4" required class="admin-input">{{ $hero['description'] ?? '' }}</textarea>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-admin.input name="primary_button" label="Primary Button" :value="$hero['primary_button'] ?? 'ট্যুর প্যাকেজ দেখুন'" required="true" />
                            <x-admin.input name="secondary_button" label="Secondary Button" :value="$hero['secondary_button'] ?? 'যোগাযোগ করুন'" required="true" />
                        </div>
                        <div class="space-y-3">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <span class="field-label">Banner Images</span>
                                    <p class="text-sm text-slate-500 font-bold">Image URL add/remove kore save korlei frontend hero slider update hobe.</p>
                                </div>
                                <button type="button" id="addHeroImage" class="px-4 py-2 rounded-xl bg-orange-50 text-[#f05a28] font-black">+ Add Image</button>
                            </div>
                            <div id="heroImageRows" class="space-y-3">
                                @php($heroImages = array_values(array_filter($hero['images'] ?? [])))
                                @forelse($heroImages as $image)
                                    <div class="soft-panel p-3 grid grid-cols-1 lg:grid-cols-[150px_1fr_auto] gap-3 items-center hero-image-row">
                                        <img src="{{ $image }}" alt="Banner preview" class="w-full h-24 object-cover rounded-xl bg-slate-100">
                                        <input name="images[]" value="{{ $image }}" required class="admin-input" placeholder="https://example.com/banner.jpg">
                                        <button type="button" class="remove-hero-image px-4 py-3 rounded-xl bg-red-50 text-red-600 font-black">Delete</button>
                                    </div>
                                @empty
                                    <div class="soft-panel p-3 grid grid-cols-1 lg:grid-cols-[150px_1fr_auto] gap-3 items-center hero-image-row">
                                        <div class="w-full h-24 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 font-black">Preview</div>
                                        <input name="images[]" value="" required class="admin-input" placeholder="https://example.com/banner.jpg">
                                        <button type="button" class="remove-hero-image px-4 py-3 rounded-xl bg-red-50 text-red-600 font-black">Delete</button>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <button class="bg-[#f05a28] text-white px-7 py-3 rounded-xl font-black">Save Banner</button>
                    </form>
                </section>

                <section id="panel-sections" class="admin-panel">
                    <form action="{{ route('admin.content.sections') }}" method="POST" class="admin-card p-6 space-y-5">
                        @csrf
                        <div>
                            <h2 class="text-2xl font-black">ফ্রন্টেন্ড টেক্সট</h2>
                            <p class="text-slate-500 font-bold">Homepage এর heading, description, section title পরিবর্তন করুন।</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                        <button class="bg-[#f05a28] text-white px-7 py-3 rounded-xl font-black">Save Text</button>
                    </form>
                </section>

                <section id="panel-packages" class="admin-panel">
                    <div class="space-y-5">
                        <div class="admin-card p-6">
                            <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
                                <div>
                                    <h2 class="text-2xl font-black">ট্যুর প্যাকেজ ম্যানেজমেন্ট</h2>
                                    <p class="text-slate-500 font-bold">নতুন package create, existing package update/delete, image/title/price সব এখান থেকে change হবে।</p>
                                </div>
                                <div class="px-4 py-2 rounded-xl bg-orange-50 text-[#f05a28] font-black">{{ $tours->count() }} Packages</div>
                            </div>

                            <form action="{{ route('admin.content.tours.store') }}" method="POST" class="soft-panel p-4 space-y-4">
                                @csrf
                                <div class="flex items-center justify-between gap-3">
                                    <h3 class="font-black text-lg">নতুন প্যাকেজ যোগ করুন</h3>
                                    <button class="bg-[#f05a28] text-white px-5 py-3 rounded-xl font-black">Create Package</button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-3">
                                    <label><span class="field-label">Package Name</span><input name="title" required class="admin-input" placeholder="Sylhet Sada Pathor Day Tour"></label>
                                    <label><span class="field-label">Destination</span><input name="destination" required class="admin-input" placeholder="Bholaganj, Sylhet"></label>
                                    <label><span class="field-label">Duration</span><input name="duration" class="admin-input" placeholder="1 Day"></label>
                                    <label><span class="field-label">Price</span><input name="price_per_person" required type="number" min="0" class="admin-input" placeholder="1350"></label>
                                    <label><span class="field-label">Date</span><input name="date" required class="admin-input" placeholder="2026-07-15"></label>
                                    <label><span class="field-label">Total Seats</span><input name="total_seats" required type="number" min="1" value="40" class="admin-input"></label>
                                    <label class="md:col-span-2"><span class="field-label">Image URL</span><input name="image" required type="url" class="admin-input" placeholder="https://images.unsplash.com/..."></label>
                                    <label class="md:col-span-2 xl:col-span-4"><span class="field-label">Description</span><textarea name="description" rows="3" class="admin-input" placeholder="Package details"></textarea></label>
                                </div>
                            </form>
                        </div>

                        <div class="admin-card p-0 overflow-hidden">
                            <div class="hidden xl:grid grid-cols-[72px_1fr_150px_120px_120px_110px_210px] gap-4 px-5 py-4 border-b table-head bg-slate-50">
                                <span>Image</span>
                                <span>Package</span>
                                <span>Destination</span>
                                <span>Price</span>
                                <span>Date</span>
                                <span>Seats</span>
                                <span>Action</span>
                            </div>
                            @foreach($tours as $tour)
                                @php($bookedSeats = $tour->bookings->sum('passenger_count'))
                                <form id="update-tour-{{ $tour->id }}" action="{{ route('admin.content.tours.update', $tour) }}" method="POST" class="grid grid-cols-1 xl:grid-cols-[72px_1fr_150px_120px_120px_110px_210px] gap-4 p-5 border-b border-slate-100 items-start">
                                    @csrf
                                    <img src="{{ $tour->image }}" alt="{{ $tour->title }}" class="w-16 h-16 object-cover rounded-xl bg-slate-100">
                                    <div class="space-y-2">
                                        <label><span class="field-label xl:hidden">Package</span><input name="title" value="{{ $tour->title }}" required class="admin-input font-black"></label>
                                        <input name="duration" value="{{ $tour->duration }}" class="admin-input" placeholder="Duration">
                                        <input name="image" value="{{ $tour->image }}" required type="url" class="admin-input text-sm" placeholder="Image URL">
                                        <textarea name="description" rows="2" class="admin-input text-sm" placeholder="Description">{{ $tour->description }}</textarea>
                                    </div>
                                    <label><span class="field-label xl:hidden">Destination</span><input name="destination" value="{{ $tour->destination }}" required class="admin-input"></label>
                                    <label><span class="field-label xl:hidden">Price</span><input name="price_per_person" value="{{ $tour->price_per_person }}" required type="number" min="0" class="admin-input"></label>
                                    <label><span class="field-label xl:hidden">Date</span><input name="date" value="{{ $tour->date }}" required class="admin-input"></label>
                                    <label>
                                        <span class="field-label xl:hidden">Seats</span>
                                        <input name="total_seats" value="{{ $tour->total_seats }}" required type="number" min="1" class="admin-input">
                                        <span class="block text-xs text-slate-400 font-bold mt-2">{{ $bookedSeats }} booked</span>
                                    </label>
                                    <div class="flex flex-wrap gap-2">
                                        <button form="update-tour-{{ $tour->id }}" class="bg-[#f05a28] text-white px-4 py-3 rounded-xl font-black">Update</button>
                                        <a href="{{ route('tours.show', $tour->id) }}" target="_blank" class="px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-black">View</a>
                                        <button type="submit" form="delete-tour-{{ $tour->id }}" onclick="return confirm('Delete this package?')" class="px-4 py-3 rounded-xl bg-red-50 text-red-600 font-black">Delete</button>
                                    </div>
                                </form>
                                <form id="delete-tour-{{ $tour->id }}" action="{{ route('admin.content.tours.delete', $tour) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                            @if($tours->isEmpty())
                                <div class="p-10 text-center text-slate-400 font-bold">No package found. Add your first package above.</div>
                            @endif
                        </div>
                    </div>
                </section>

                <section id="panel-destinations" class="admin-panel">
                    <div class="admin-card p-6 space-y-5">
                        <h2 class="text-2xl font-black">গন্তব্য ক্যাটাগরি</h2>
                        <p class="text-slate-500 font-bold">Top Travel Destination section এর image, name, subtitle, layout edit করুন।</p>
                        @include('admin.partials.destination-form', ['destinations' => $destinations])
                    </div>
                </section>

                <section id="panel-payments" class="admin-panel">
                    <div class="admin-card p-6 space-y-5">
                        <h2 class="text-2xl font-black">পেমেন্ট লোগো</h2>
                        <p class="text-slate-500 font-bold">Payment method logo, name, active status edit করুন।</p>
                        @include('admin.partials.payment-form', ['paymentMethods' => $paymentMethods])
                    </div>
                </section>

                <section id="panel-bookings" class="admin-panel">
                    <div class="admin-card p-6">
                        <h2 class="text-2xl font-black mb-5">সাম্প্রতিক বুকিং</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="text-xs uppercase tracking-widest text-slate-400">
                                    <tr>
                                        <th class="py-3">User</th>
                                        <th>Tour</th>
                                        <th>Seats</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($bookings as $booking)
                                        <tr>
                                            <td class="py-4 font-bold">{{ $booking->user->name ?? 'Guest' }}<br><span class="text-xs text-slate-400">{{ $booking->user->email ?? '' }}</span></td>
                                            <td class="font-bold">{{ $booking->tour->title ?? 'Deleted tour' }}</td>
                                            <td class="font-en">{{ $booking->passenger_count }}</td>
                                            <td class="font-en font-black text-[#f05a28]">Tk {{ number_format($booking->total_price) }}</td>
                                            <td><span class="px-3 py-1 rounded-xl bg-orange-50 text-orange-600 text-xs font-black">{{ $booking->payment_status }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="py-10 text-center text-slate-400 font-bold">No bookings yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

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

        document.querySelectorAll('[data-jump]').forEach(button => {
            button.addEventListener('click', () => activatePanel(button.dataset.jump));
        });

        const heroRows = document.getElementById('heroImageRows');
        const makeHeroRow = () => {
            const row = document.createElement('div');
            row.className = 'soft-panel p-3 grid grid-cols-1 lg:grid-cols-[150px_1fr_auto] gap-3 items-center hero-image-row';
            row.innerHTML = `
                <div class="w-full h-24 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 font-black">Preview</div>
                <input name="images[]" value="" required class="admin-input" placeholder="https://example.com/banner.jpg">
                <button type="button" class="remove-hero-image px-4 py-3 rounded-xl bg-red-50 text-red-600 font-black">Delete</button>
            `;
            return row;
        };

        document.getElementById('addHeroImage')?.addEventListener('click', () => {
            heroRows?.appendChild(makeHeroRow());
        });

        heroRows?.addEventListener('click', (event) => {
            if (!event.target.classList.contains('remove-hero-image')) return;
            const rows = heroRows.querySelectorAll('.hero-image-row');
            const row = event.target.closest('.hero-image-row');
            if (rows.length > 1) {
                row?.remove();
            } else {
                row.querySelector('input')?.setAttribute('value', '');
                row.querySelector('input').value = '';
            }
        });
    </script>
</body>
</html>
