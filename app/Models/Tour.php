<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'title', 'destination', 'price_per_person', 'date', 'duration', 'image', 'gallery', 'description', 'features', 'itinerary', 'inclusions', 'exclusions', 'policy', 'total_seats'
    ];

    protected $casts = [
        'features' => 'array',
        'gallery' => 'array',
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
