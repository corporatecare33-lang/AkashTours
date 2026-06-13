<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'tour_id', 'passenger_count', 'selected_seats', 'total_price', 'coupon_code', 'payment_method', 'sender_number', 'transaction_id', 'payment_status', 'booking_status'
    ];

    protected $casts = [
        'selected_seats' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
