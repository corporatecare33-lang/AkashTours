<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($tour_id)
    {
        $tour = Tour::findOrFail($tour_id);
        // Fetch already booked seats for this tour
        $bookedSeats = Booking::where('tour_id', $tour_id)
            ->get()
            ->pluck('selected_seats')
            ->flatten()
            ->toArray();

        return view('bookings.create', compact('tour', 'bookedSeats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'passenger_count' => 'required|integer|min:1',
            'selected_seats' => 'required|array',
            'payment_method' => 'required',
            'sender_number' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        $tour = Tour::find($request->tour_id);
        $base_price = (float)$tour->price_per_person * $request->passenger_count;

        // Simple coupon logic (demo)
        if ($request->coupon_code === 'SAVE10') {
            $base_price *= 0.9;
        }

        // Add 1.8% Cashout Charge
        $total_price = $base_price * 1.018;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'tour_id' => $request->tour_id,
            'passenger_count' => $request->passenger_count,
            'selected_seats' => $request->selected_seats,
            'total_price' => $total_price,
            'coupon_code' => $request->coupon_code,
            'payment_method' => $request->payment_method,
            'sender_number' => $request->sender_number,
            'transaction_id' => $request->transaction_id,
            'payment_status' => 'pending',
            'booking_status' => 'pending',
        ]);

        return redirect()->route('bookings.confirmation', $booking->id);
    }

    public function confirmation($id)
    {
        $booking = Booking::with('tour')->findOrFail($id);
        return view('bookings.confirmation', compact('booking'));
    }
}
