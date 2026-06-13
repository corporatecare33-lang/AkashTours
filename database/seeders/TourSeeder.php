<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Seed real starter tour packages for Akash Tours.
     */
    public function run(): void
    {
        Tour::query()->delete();

        $tours = [
            [
                'title' => 'Sylhet Sada Pathor Day Tour',
                'destination' => 'Bholaganj, Sylhet',
                'price_per_person' => '1350',
                'date' => '2026-07-15',
                'duration' => '1 Day',
                'image' => 'https://images.unsplash.com/photo-1581600140682-d4e68c8cde32?q=80&w=1200',
                'gallery' => [
                    'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=900',
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=900',
                ],
                'description' => 'A comfortable group tour from Madhabpur to Sylhet with Sada Pathor, boat ride, local food, and shrine visit.',
                'features' => ['AC/Non-AC transport', 'Boat ride included', 'Breakfast and lunch included'],
                'itinerary' => [
                    ['day' => '1', 'title' => 'Madhabpur to Sylhet', 'desc' => 'Start early morning, visit Sada Pathor, enjoy boat ride, lunch, and return at night.'],
                ],
                'inclusions' => ['Transport', 'Breakfast', 'Lunch', 'Boat fare', 'Guide support'],
                'exclusions' => ['Personal shopping', 'Extra snacks', 'Any ride not listed'],
                'policy' => 'Booking must be confirmed with advance payment. Cancellation charge applies within 3 days of travel.',
                'total_seats' => 40,
            ],
            [
                'title' => 'Kuakata Sea Beach Tour',
                'destination' => 'Kuakata, Patuakhali',
                'price_per_person' => '4500',
                'date' => '2026-08-30',
                'duration' => '3 Nights 2 Days',
                'image' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1200',
                'gallery' => [
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=900',
                    'https://images.unsplash.com/photo-1519046904884-53103b34b206?q=80&w=900',
                ],
                'description' => 'Enjoy sunrise and sunset from the same beach, sea fish, beach activities, and group sightseeing.',
                'features' => ['Hotel stay', '5 meals', 'Beach sightseeing'],
                'itinerary' => [
                    ['day' => '1', 'title' => 'Journey to Kuakata', 'desc' => 'Night journey from Madhabpur/Dhaka route to Kuakata.'],
                    ['day' => '2', 'title' => 'Beach and Sightseeing', 'desc' => 'Sunrise, beach activities, local market, and sunset point visit.'],
                    ['day' => '3', 'title' => 'Return Journey', 'desc' => 'Breakfast, checkout, and return journey.'],
                ],
                'inclusions' => ['Transport', 'Hotel stay', '5 meals', 'Tour guide'],
                'exclusions' => ['Personal expense', 'Optional bike/ride cost'],
                'policy' => 'Seats are limited. Minimum 50% advance is required to confirm booking.',
                'total_seats' => 40,
            ],
            [
                'title' => 'Rajshahi and Chapainawabganj Mango Tour',
                'destination' => 'Rajshahi, Chapainawabganj',
                'price_per_person' => '3500',
                'date' => '2026-06-25',
                'duration' => '1 Night 2 Days',
                'image' => 'https://images.unsplash.com/photo-1622116208929-577779d732ff?q=80&w=1200',
                'gallery' => [
                    'https://images.unsplash.com/photo-1553279768-865429fa0078?q=80&w=900',
                    'https://images.unsplash.com/photo-1590603740183-980e7f6920eb?q=80&w=900',
                ],
                'description' => 'Visit mango orchards, Kansat mango market, Padma river bank, and historic spots in Rajshahi region.',
                'features' => ['Mango orchard visit', 'AC bus option', 'Historic sightseeing'],
                'itinerary' => [
                    ['day' => '1', 'title' => 'Night Journey', 'desc' => 'Start from Madhabpur at night and travel to Rajshahi.'],
                    ['day' => '2', 'title' => 'Mango Market and Rajshahi', 'desc' => 'Visit Kansat, mango garden, Padma bank, and return journey.'],
                ],
                'inclusions' => ['Transport', 'Meals', 'Entry fees', 'Guide support'],
                'exclusions' => ['Mango purchase', 'Personal cost'],
                'policy' => 'Booking must be confirmed at least 3 days before the tour date.',
                'total_seats' => 40,
            ],
            [
                'title' => 'Magic Paradise Park Family Day Tour',
                'destination' => 'Kotbari, Cumilla',
                'price_per_person' => '1650',
                'date' => '2026-07-12',
                'duration' => '1 Day',
                'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200',
                'gallery' => [
                    'https://images.unsplash.com/photo-1513889961551-628c1e5e2ee9?q=80&w=900',
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=900',
                ],
                'description' => 'Family-friendly day tour to Magic Paradise Park with transport, food, and group management.',
                'features' => ['Family friendly', 'Breakfast and lunch', 'Group transport'],
                'itinerary' => [
                    ['day' => '1', 'title' => 'Park Day', 'desc' => 'Morning departure, park visit, lunch, free time, and evening return.'],
                ],
                'inclusions' => ['Transport', 'Breakfast', 'Lunch', 'Mineral water'],
                'exclusions' => ['Ride tickets', 'Personal expense'],
                'policy' => 'Park ride tickets are not included. Children policy depends on park authority rules.',
                'total_seats' => 45,
            ],
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}
