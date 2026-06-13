import { cpSync, existsSync, mkdirSync, readFileSync, rmSync, writeFileSync } from 'node:fs';
import { join } from 'node:path';

const publicDir = join(process.cwd(), 'public');
const distDir = join(process.cwd(), 'dist');
const manifestPath = join(publicDir, 'build', 'manifest.json');

rmSync(distDir, { force: true, recursive: true });
mkdirSync(distDir, { recursive: true });

if (existsSync(publicDir)) {
    cpSync(publicDir, distDir, { recursive: true });
}

const manifest = JSON.parse(readFileSync(manifestPath, 'utf8'));
const appEntry = manifest['resources/js/app.js'];
const cssFiles = appEntry?.css ?? [];
const jsFile = appEntry?.file;

const cssTags = cssFiles
    .map((file) => `<link rel="stylesheet" href="/build/${file}">`)
    .join('\n    ');
const jsTag = jsFile ? `<script type="module" src="/build/${jsFile}"></script>` : '';

const packages = [
    {
        title: 'Sylhet Sada Pathor Day Tour',
        destination: 'Bholaganj, Sylhet',
        price: 'Tk 1,350',
        duration: '1 Day',
        image: 'https://images.unsplash.com/photo-1581600140682-d4e68c8cde32?q=80&w=1200',
        description: 'A comfortable day tour from Madhabpur with boat ride, food, and guide support.',
    },
    {
        title: 'Kuakata Sea Beach Tour',
        destination: 'Kuakata, Patuakhali',
        price: 'Tk 4,500',
        duration: '3 Nights 2 Days',
        image: 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1200',
        description: 'Enjoy sunrise, sunset, beach activities, hotel stay, meals, and group sightseeing.',
    },
    {
        title: 'Rajshahi Mango Tour',
        destination: 'Rajshahi, Chapainawabganj',
        price: 'Tk 3,500',
        duration: '1 Night 2 Days',
        image: 'https://images.unsplash.com/photo-1622116208929-577779d732ff?q=80&w=1200',
        description: 'Visit mango orchards, Kansat mango market, Padma river bank, and historic spots.',
    },
    {
        title: 'Magic Paradise Park Family Day Tour',
        destination: 'Kotbari, Cumilla',
        price: 'Tk 1,650',
        duration: '1 Day',
        image: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200',
        description: 'Family-friendly day tour with transport, breakfast, lunch, and group management.',
    },
];

const cards = packages.map((tour) => `
                <article class="bg-white rounded-[32px] overflow-hidden shadow-xl shadow-blue-950/5 border border-gray-100">
                    <img src="${tour.image}" alt="${tour.title}" class="h-56 w-full object-cover">
                    <div class="p-7 space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-xs font-black uppercase tracking-widest text-blue-600">${tour.destination}</span>
                            <span class="text-xs font-black text-gray-400">${tour.duration}</span>
                        </div>
                        <h3 class="text-2xl font-black text-gray-950 leading-tight">${tour.title}</h3>
                        <p class="text-gray-500 font-medium leading-relaxed">${tour.description}</p>
                        <div class="flex items-center justify-between pt-3">
                            <strong class="text-2xl font-black text-blue-600">${tour.price}</strong>
                            <a href="tel:01711662685" class="bg-blue-600 text-white px-5 py-3 rounded-2xl font-black hover:bg-blue-700 transition">Call Now</a>
                        </div>
                    </div>
                </article>`).join('\n');

const html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akash Tours</title>
    ${cssTags}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>body{font-family:Poppins,sans-serif}</style>
</head>
<body class="bg-slate-50 text-gray-900">
    <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <span class="w-11 h-11 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl">A</span>
                <span class="text-2xl font-black">Akash<span class="text-blue-600">Tours</span></span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-gray-600">
                <a href="#packages" class="hover:text-blue-600">Packages</a>
                <a href="#contact" class="hover:text-blue-600">Contact</a>
                <a href="tel:01711662685" class="bg-blue-600 text-white px-5 py-3 rounded-2xl hover:bg-blue-700">Call Now</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="relative min-h-[88vh] pt-28 flex items-center overflow-hidden">
            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2000" alt="Travel" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-slate-950/60"></div>
            <div class="relative max-w-7xl mx-auto px-6 py-24 text-white">
                <p class="inline-flex bg-white/15 border border-white/20 rounded-full px-5 py-2 text-xs font-black uppercase tracking-widest mb-8">Madhabpur Travel Agency</p>
                <h1 class="max-w-4xl text-5xl md:text-7xl font-black leading-tight">Safe and joyful tours across Bangladesh</h1>
                <p class="max-w-2xl mt-7 text-lg md:text-xl text-white/85 font-medium leading-relaxed">Akash Tours arranges group tours, family trips, transport, food, guide support, and easy booking assistance.</p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="#packages" class="bg-white text-blue-700 px-8 py-4 rounded-2xl font-black">View Packages</a>
                    <a href="https://wa.me/8801711662685" class="bg-green-500 text-white px-8 py-4 rounded-2xl font-black">WhatsApp</a>
                </div>
            </div>
        </section>

        <section id="packages" class="max-w-7xl mx-auto px-6 py-24">
            <div class="max-w-3xl mb-12">
                <p class="text-blue-600 text-xs font-black uppercase tracking-[0.25em] mb-3">Tour Packages</p>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight">Popular packages ready for booking</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-7">
${cards}
            </div>
        </section>

        <section id="contact" class="bg-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                <div>
                    <p class="text-blue-100 font-bold uppercase tracking-widest text-xs mb-3">Contact</p>
                    <h2 class="text-4xl font-black">Book your next tour today</h2>
                    <p class="mt-4 text-blue-100 font-medium">Call or message Akash Tours for seat availability and payment details.</p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="tel:01711662685" class="bg-white text-blue-600 px-8 py-4 rounded-2xl font-black">01711662685</a>
                    <a href="https://wa.me/8801711662685" class="bg-green-500 text-white px-8 py-4 rounded-2xl font-black">WhatsApp</a>
                </div>
            </div>
        </section>
    </main>
    ${jsTag}
</body>
</html>`;

writeFileSync(join(distDir, 'index.html'), html);
