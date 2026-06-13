import { cpSync, existsSync, mkdirSync, rmSync, writeFileSync } from 'node:fs';
import { join } from 'node:path';

const publicDir = join(process.cwd(), 'public');
const distDir = join(process.cwd(), 'dist');

rmSync(distDir, { force: true, recursive: true });
mkdirSync(distDir, { recursive: true });

if (existsSync(publicDir)) {
    cpSync(publicDir, distDir, { recursive: true });
}

const packages = [
    {
        title: 'সিলেট সাদা পাথর ডে ট্যুর',
        destination: 'ভোলাগঞ্জ, সিলেট',
        price: '৳১,৩৫০',
        duration: '১ দিন',
        image: 'https://images.unsplash.com/photo-1581600140682-d4e68c8cde32?q=80&w=1200',
        description: 'মাধবপুর থেকে আরামদায়ক ডে ট্যুর। নৌকা ভ্রমণ, সকালের নাস্তা, দুপুরের খাবার এবং গাইড সাপোর্টসহ।',
    },
    {
        title: 'কুয়াকাটা সমুদ্র সৈকত ট্যুর',
        destination: 'কুয়াকাটা, পটুয়াখালী',
        price: '৳৪,৫০০',
        duration: '৩ রাত ২ দিন',
        image: 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1200',
        description: 'সূর্যোদয়, সূর্যাস্ত, সমুদ্র সৈকত, হোটেল থাকা, খাবার এবং গ্রুপ সাইটসিয়িংসহ সুন্দর আয়োজন।',
    },
    {
        title: 'রাজশাহী ও চাঁপাইনবাবগঞ্জ আম ট্যুর',
        destination: 'রাজশাহী, চাঁপাইনবাবগঞ্জ',
        price: '৳৩,৫০০',
        duration: '১ রাত ২ দিন',
        image: 'https://images.unsplash.com/photo-1622116208929-577779d732ff?q=80&w=1200',
        description: 'আম বাগান, কানসাট আম বাজার, পদ্মা নদীর পাড় এবং ঐতিহাসিক দর্শনীয় স্থান ঘুরে দেখুন।',
    },
    {
        title: 'ম্যাজিক প্যারাডাইস পার্ক ফ্যামিলি ট্যুর',
        destination: 'কোটবাড়ি, কুমিল্লা',
        price: '৳১,৬৫০',
        duration: '১ দিন',
        image: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200',
        description: 'পরিবার নিয়ে আনন্দ করার জন্য পরিবহন, নাস্তা, দুপুরের খাবার এবং গ্রুপ ম্যানেজমেন্টসহ ট্যুর।',
    },
];

const destinations = [
    ['কাশ্মীর', '১০+ প্যাকেজ Available', 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=1000', 'large'],
    ['সিলেট', 'সাদা পাথর ও জাফলং', 'https://images.unsplash.com/photo-1582650625119-3a31f8fa2699?q=80&w=1000', 'small'],
    ['কক্সবাজার', 'সমুদ্র সৈকত ভ্রমণ', 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1000', 'tall'],
    ['রাজশাহী', 'আমের রাজধানী', 'https://images.unsplash.com/photo-1622116208929-577779d732ff?q=80&w=1000', 'small'],
    ['কেদারনাথ', 'পবিত্র তীর্থযাত্রা', 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?q=80&w=1000', 'large'],
];

const payments = [
    ['AMEX', '/images/payments/amex.svg'],
    ['Mastercard', '/images/payments/mastercard.svg'],
    ['Visa', '/images/payments/visa.svg'],
    ['bKash', '/images/payments/bkash.svg'],
    ['Nagad', '/images/payments/nagad.svg'],
    ['Rocket', '/images/payments/rocket.svg'],
    ['Upay', '/images/payments/upay.svg'],
    ['BRAC Bank', '/images/payments/brac-bank.svg'],
    ['City Bank', '/images/payments/city-bank.svg'],
    ['Sonali Bank', '/images/payments/sonali-bank.svg'],
];

const packageCards = packages.map((tour) => `
        <article class="tour-card">
            <div class="tour-image">
                <img src="${tour.image}" alt="${tour.title}">
                <span>${tour.duration}</span>
            </div>
            <div class="tour-content">
                <p class="eyebrow">${tour.destination}</p>
                <h3>${tour.title}</h3>
                <p>${tour.description}</p>
                <div class="card-footer">
                    <strong>${tour.price}</strong>
                    <a href="tel:01711662685">কল করুন</a>
                </div>
            </div>
        </article>`).join('');

const destinationCards = destinations.map(([name, subtitle, image, size]) => `
        <article class="destination ${size}">
            <img src="${image}" alt="${name}">
            <div>
                <h3>${name}</h3>
                <p>${subtitle}</p>
            </div>
        </article>`).join('');

const paymentCards = payments.map(([name, logo]) => `
        <div class="payment-logo">
            <img src="${logo}" alt="${name}">
        </div>`).join('');

const html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>আকাশ ট্যুরস</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;600;700;900&family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue: #2563eb;
            --blue-dark: #0f2f88;
            --ink: #071329;
            --muted: #64748b;
            --soft: #f4f7ff;
            --line: #e5eaf5;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: "Noto Sans Bengali", "Poppins", sans-serif;
            background: #fbfbff;
            color: var(--ink);
        }
        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }
        .container { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
        .nav {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255,255,255,.9);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }
        .nav-inner {
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }
        .brand { display: flex; align-items: center; gap: 12px; font-family: Poppins, sans-serif; }
        .brand-mark {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: var(--blue);
            color: white;
            font-weight: 900;
            font-size: 26px;
            box-shadow: 0 16px 30px rgba(37,99,235,.22);
        }
        .brand strong { display: block; font-size: 25px; line-height: 1; color: var(--blue-dark); }
        .brand strong span { color: var(--blue); }
        .brand small { display: block; margin-top: 4px; color: #94a3b8; font-size: 10px; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .nav-links { display: flex; align-items: center; gap: 28px; color: #475569; font-weight: 800; }
        .nav-links a:hover { color: var(--blue); }
        .nav-links .button { color: white; background: var(--blue); padding: 13px 20px; border-radius: 16px; }
        .hero {
            min-height: 88vh;
            position: relative;
            display: grid;
            align-items: center;
            overflow: hidden;
            color: white;
        }
        .hero-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .hero::after { content: ""; position: absolute; inset: 0; background: linear-gradient(90deg, rgba(3,7,18,.82), rgba(3,7,18,.42), rgba(3,7,18,.72)); }
        .hero-content { position: relative; z-index: 1; padding: 90px 0; max-width: 840px; }
        .badge { display: inline-flex; align-items: center; gap: 10px; padding: 10px 18px; border: 1px solid rgba(255,255,255,.2); border-radius: 999px; background: rgba(255,255,255,.1); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .badge::before { content: ""; width: 8px; height: 8px; border-radius: 50%; background: #38bdf8; }
        h1 { margin: 26px 0 0; font-size: clamp(44px, 8vw, 88px); line-height: 1.03; letter-spacing: -0.04em; font-weight: 900; }
        .hero p { max-width: 720px; margin: 26px 0 0; color: rgba(255,255,255,.86); font-size: clamp(18px, 2vw, 24px); line-height: 1.7; font-weight: 600; }
        .actions { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 38px; }
        .actions a { padding: 17px 25px; border-radius: 20px; font-weight: 900; }
        .actions .primary { background: white; color: var(--blue-dark); }
        .actions .secondary { background: var(--blue); color: white; }
        .section { padding: 96px 0; }
        .section.soft { background: var(--soft); border-radius: 70px; }
        .section-head { max-width: 720px; margin-bottom: 42px; }
        .eyebrow { color: var(--blue); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 900; letter-spacing: .2em; text-transform: uppercase; }
        h2 { margin: 10px 0 0; font-size: clamp(34px, 5vw, 56px); line-height: 1.08; letter-spacing: -0.04em; font-weight: 900; }
        .section-head p { color: var(--muted); font-size: 18px; line-height: 1.7; font-weight: 600; }
        .tour-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
        .tour-card { background: white; border: 1px solid var(--line); border-radius: 34px; overflow: hidden; box-shadow: 0 24px 60px rgba(15,23,42,.06); }
        .tour-image { height: 230px; position: relative; overflow: hidden; }
        .tour-image img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s ease; }
        .tour-card:hover .tour-image img { transform: scale(1.08); }
        .tour-image span { position: absolute; top: 18px; left: 18px; background: rgba(255,255,255,.86); color: var(--blue-dark); border-radius: 14px; padding: 8px 12px; font-family: Poppins, sans-serif; font-size: 12px; font-weight: 900; }
        .tour-content { padding: 24px; }
        .tour-content h3 { min-height: 72px; margin: 8px 0 12px; font-size: 23px; line-height: 1.12; letter-spacing: -0.03em; font-weight: 900; }
        .tour-content p:not(.eyebrow) { color: var(--muted); line-height: 1.65; font-weight: 600; }
        .card-footer { margin-top: 22px; padding-top: 18px; border-top: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .card-footer strong { color: var(--blue); font-family: Poppins, sans-serif; font-size: 24px; font-weight: 900; }
        .card-footer a { background: var(--blue); color: white; border-radius: 15px; padding: 12px 15px; font-weight: 900; white-space: nowrap; }
        .dest-grid { display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 230px; gap: 20px; }
        .destination { position: relative; overflow: hidden; border-radius: 34px; background: #111827; }
        .destination.large { grid-column: span 2; }
        .destination.tall { grid-row: span 2; }
        .destination img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s ease; }
        .destination:hover img { transform: scale(1.08); }
        .destination::after { content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,.05), rgba(0,0,0,.7)); }
        .destination div { position: absolute; left: 26px; right: 26px; bottom: 24px; z-index: 1; color: white; }
        .destination h3 { margin: 0 0 6px; font-size: 30px; font-weight: 900; letter-spacing: -0.03em; }
        .destination p { margin: 0; color: #93c5fd; font-weight: 900; }
        .payments { background: #0a0a0a; color: white; }
        .payments .section-head p { color: rgba(255,255,255,.68); }
        .payment-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; }
        .payment-logo { min-height: 74px; background: white; border-radius: 10px; display: grid; place-items: center; padding: 14px; }
        .payment-logo img { max-height: 44px; max-width: 130px; object-fit: contain; }
        .cta { background: var(--blue); color: white; border-radius: 48px; padding: 56px; display: flex; align-items: center; justify-content: space-between; gap: 30px; }
        .cta h2 { color: white; margin: 0; }
        .cta p { color: #dbeafe; font-weight: 600; line-height: 1.7; }
        .cta-actions { display: flex; flex-wrap: wrap; gap: 14px; }
        .cta-actions a { background: white; color: var(--blue); border-radius: 18px; padding: 16px 22px; font-weight: 900; white-space: nowrap; }
        .cta-actions a:last-child { background: #22c55e; color: white; }
        .site-footer { background: #020817; color: #94a3b8; padding: 76px 0 34px; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 64px; align-items: start; }
        .footer-brand { display: flex; align-items: center; gap: 12px; color: white; font-family: Poppins, sans-serif; }
        .footer-brand .brand-mark { width: 54px; height: 54px; border-radius: 20px; }
        .footer-brand strong { font-size: 34px; font-weight: 900; }
        .site-footer p { line-height: 1.8; font-weight: 600; }
        .socials { display: flex; gap: 12px; margin-top: 24px; }
        .socials a { width: 42px; height: 42px; border-radius: 14px; display: grid; place-items: center; background: rgba(255,255,255,.06); color: white; font-weight: 900; }
        .footer-title { color: white; font-size: 13px; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; margin-bottom: 24px; }
        .footer-list { list-style: none; padding: 0; margin: 0; display: grid; gap: 14px; font-weight: 800; }
        .footer-list a:hover { color: #60a5fa; }
        .footer-contact { list-style: none; padding: 0; margin: 0; display: grid; gap: 14px; font-weight: 800; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); margin-top: 52px; padding-top: 28px; text-align: center; font-size: 12px; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .footer-credit { margin-top: 10px; text-align: center; font-size: 13px; color: #64748b; }
        .footer-credit strong { color: white; }
        @media (max-width: 980px) {
            .nav-links { display: none; }
            .tour-grid { grid-template-columns: repeat(2, 1fr); }
            .dest-grid { grid-template-columns: repeat(2, 1fr); height: auto; }
            .destination.large, .destination.tall { grid-column: span 1; grid-row: span 1; }
            .payment-grid { grid-template-columns: repeat(3, 1fr); }
            .cta { align-items: flex-start; flex-direction: column; padding: 34px; }
            .footer-grid { grid-template-columns: 1fr; gap: 38px; }
        }
        @media (max-width: 640px) {
            .brand small { display: none; }
            .hero-content { padding: 64px 0; }
            .tour-grid, .dest-grid, .payment-grid { grid-template-columns: 1fr; }
            .section.soft { border-radius: 38px; }
            .payment-logo { min-height: 82px; }
        }
    </style>
</head>
<body>
    <header class="nav">
        <nav class="container nav-inner">
            <a href="/" class="brand">
                <span class="brand-mark">A</span>
                <span>
                    <strong>Akash<span>Tours</span></strong>
                    <small>Premium Travel Service</small>
                </span>
            </a>
            <div class="nav-links">
                <a href="#packages">ট্যুর প্যাকেজ</a>
                <a href="#destinations">গন্তব্য</a>
                <a href="#payments">পেমেন্ট</a>
                <a href="#contact" class="button">কল করুন</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <img class="hero-bg" src="https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?q=80&w=2000" alt="আকাশ ট্যুরস">
            <div class="container hero-content">
                <span class="badge">Bangladesh's Top Rated Agency</span>
                <h1>ভ্রমণ হোক নিরাপদ ও আনন্দময়</h1>
                <p>মাধবপুর থেকে নিয়মিত আকর্ষণীয় সব ট্যুর প্যাকেজ আয়োজন করা হয়। আপনার আস্থার প্রতীক - আকাশ ট্যুরস এন্ড ট্রাভেলস।</p>
                <div class="actions">
                    <a class="primary" href="#packages">ট্যুর প্যাকেজ দেখুন</a>
                    <a class="secondary" href="https://wa.me/8801711662685">যোগাযোগ করুন</a>
                </div>
            </div>
        </section>

        <section id="packages" class="section soft">
            <div class="container">
                <div class="section-head">
                    <span class="eyebrow">Popular Tour Packages</span>
                    <h2>জনপ্রিয় ট্যুর প্যাকেজ</h2>
                    <p>পছন্দের গন্তব্যটি বেছে নিন এবং বুকিং করুন খুব সহজেই।</p>
                </div>
                <div class="tour-grid">
${packageCards}
                </div>
            </div>
        </section>

        <section id="destinations" class="section">
            <div class="container">
                <div class="section-head">
                    <span class="eyebrow">Top Travel Destinations</span>
                    <h2>টপ ট্রাভেল ডেস্টিনেশন</h2>
                    <p>দেশ-বিদেশের সবচেয়ে সুন্দর জায়গাগুলোতে ঘুরে আসুন।</p>
                </div>
                <div class="dest-grid">
${destinationCards}
                </div>
            </div>
        </section>

        <section id="payments" class="section payments">
            <div class="container">
                <div class="section-head">
                    <span class="eyebrow">Payment Partners</span>
                    <h2>পেমেন্ট মাধ্যমসমূহ</h2>
                    <p>মোবাইল ব্যাংকিং, ব্যাংক ও কার্ড পেমেন্ট গ্রহণযোগ্য।</p>
                </div>
                <div class="payment-grid">
${paymentCards}
                </div>
            </div>
        </section>

        <section id="contact" class="section">
            <div class="container">
                <div class="cta">
                    <div>
                        <h2>আপনার পরবর্তী ভ্রমণ শুরু হোক আজই</h2>
                        <p>সিট, প্যাকেজ এবং পেমেন্ট সম্পর্কে জানতে এখনই আকাশ ট্যুরসের সাথে যোগাযোগ করুন।</p>
                    </div>
                    <div class="cta-actions">
                        <a href="tel:01711662685">01711662685</a>
                        <a href="https://wa.me/8801711662685">WhatsApp</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a href="/" class="footer-brand">
                        <span class="brand-mark">A</span>
                        <strong>Akash<span style="color:#2563eb">Tours</span></strong>
                    </a>
                    <p>আপনার বিশ্বস্ত ভ্রমণ সঙ্গী। আপনাদের জন্য সব সময় সেরা ট্যুর প্যাকেজ নিশ্চিত করা হয়। মাধবপুর থেকে পথচলা শুরু।</p>
                    <div class="socials">
                        <a href="https://facebook.com/akashtours" aria-label="Facebook">f</a>
                        <a href="#" aria-label="Instagram">◎</a>
                        <a href="#" aria-label="YouTube">▶</a>
                    </div>
                </div>

                <div>
                    <h3 class="footer-title">প্রয়োজনীয় লিংক</h3>
                    <ul class="footer-list">
                        <li><a href="#packages">ট্যুর প্যাকেজ</a></li>
                        <li><a href="#destinations">গন্তব্য</a></li>
                        <li><a href="#payments">পেমেন্ট মাধ্যম</a></li>
                        <li><a href="#contact">যোগাযোগ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer-title">যোগাযোগ</h3>
                    <ul class="footer-contact">
                        <li>আমীর কমপ্লেক্স, মাধবপুর বাজার, হবিগঞ্জ</li>
                        <li>01711662685</li>
                        <li>akash@akashmadhabpur.org</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">© 2026 Akash Tours and Travels. All rights reserved.</div>
            <div class="footer-credit">Design and Developed By <strong>Digital Webars</strong></div>
        </div>
    </footer>
</body>
</html>`;

writeFileSync(join(distDir, 'index.html'), html);
