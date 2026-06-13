<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\PaymentMethod;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::setValue('hero', [
            'eyebrow' => "Bangladesh's Top Rated Agency",
            'title' => 'ভ্রমণ হোক নিরাপদ ও আনন্দময়',
            'highlight' => 'নিরাপদ',
            'description' => 'মাধবপুর থেকে নিয়মিত আকর্ষণীয় সব ট্যুর প্যাকেজ আয়োজন করা হয়। আপনার আস্থার প্রতীক - আকাশ ট্যুরস এন্ড ট্রাভেলস।',
            'primary_button' => 'ট্যুর প্যাকেজ দেখুন',
            'secondary_button' => 'যোগাযোগ করুন',
            'images' => [
                'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?q=80&w=2000',
                'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=2000',
                'https://images.unsplash.com/photo-1582650625119-3a31f8fa2699?q=80&w=2000',
                'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=2000',
            ],
        ]);

        SiteSetting::setValue('sections', [
            'packages_title' => 'জনপ্রিয় ট্যুর প্যাকেজ',
            'packages_description' => 'পছন্দের গন্তব্যটি বেছে নিন এবং বুকিং করুন খুব সহজেই।',
            'destinations_title' => 'টপ ট্রাভেল ডেস্টিনেশন',
            'destinations_description' => 'দেশ-বিদেশের সবচেয়ে সুন্দর জায়গাগুলোতে ঘুরে আসুন।',
            'payments_title' => 'পেমেন্ট মাধ্যমসমূহ',
            'payments_description' => 'মোবাইল ব্যাংকিং, ব্যাংক ও কার্ড পেমেন্ট গ্রহণযোগ্য',
        ]);

        Destination::query()->delete();
        foreach ([
            ['কাশ্মীর', '10+ Packages Available', 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=1000', 'wide', 1],
            ['সিলেট', 'সাদা পাথর ও জাফলং', 'https://images.unsplash.com/photo-1582650625119-3a31f8fa2699?q=80&w=1000', 'normal', 2],
            ['কক্সবাজার', 'সমুদ্র সৈকত ভ্রমণ', 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1000', 'tall', 3],
            ['রাজশাহী', 'আমের রাজধানী', 'https://images.unsplash.com/photo-1622116208929-577779d732ff?q=80&w=1000', 'normal', 4],
            ['কেদারনাথ', 'পবিত্র তীর্থযাত্রা', 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?q=80&w=1000', 'wide', 5],
        ] as [$name, $subtitle, $image, $layout, $order]) {
            Destination::create([
                'name' => $name,
                'subtitle' => $subtitle,
                'image' => $image,
                'layout' => $layout,
                'sort_order' => $order,
                'is_active' => true,
            ]);
        }

        PaymentMethod::query()->delete();
        foreach ([
            ['AMEX', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/American_Express_logo_%282018%29.svg/1200px-American_Express_logo_%282018%29.svg.png'],
            ['Mastercard', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png'],
            ['Visa', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png'],
            ['bKash', 'https://upload.wikimedia.org/wikipedia/en/thumb/8/8c/BKash_logo.svg/1200px-BKash_logo.svg.png'],
            ['Nagad', 'https://download.logo.wine/logo/Nagad/Nagad-Logo.wine.png'],
            ['Rocket', 'https://raw.githubusercontent.com/manas-p-mishra/payment-icons/master/icons/rocket.png'],
            ['Upay', 'https://seeklogo.com/images/U/upai-logo-F2134044A1-seeklogo.com.png'],
            ['BRAC Bank', 'https://www.bracbank.com/assets/images/logo.png'],
            ['City Bank', 'https://www.thecitybank.com/img/citybank-logo.png'],
            ['Sonali Bank', 'https://www.sonalibank.com.bd/images/logo.png'],
            ['ShurjoPay', 'https://shurjopay.com.bd/dev/images/shurjopay-logo.png'],
            ['DBBL Nexus', 'https://www.dutchbanglabank.com/img/dbbl-logo.png'],
        ] as $index => [$name, $logo]) {
            PaymentMethod::create([
                'name' => $name,
                'logo' => $logo,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
