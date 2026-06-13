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
            ['ShurjoPay', '/images/payments/shurjopay.svg'],
            ['DBBL Nexus', '/images/payments/dbbl-nexus.svg'],
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
