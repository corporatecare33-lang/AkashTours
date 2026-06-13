<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\PaymentMethod;
use App\Models\SiteSetting;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            $bookings = Booking::with(['tour', 'user'])->latest()->get();
            $tours = Tour::with('bookings')->latest()->get();
            $destinations = Destination::orderBy('sort_order')->get();
            $paymentMethods = PaymentMethod::orderBy('sort_order')->get();
            $hero = SiteSetting::getValue('hero');
            $sections = SiteSetting::getValue('sections');
            $stats = [
                'bookings' => Booking::count(),
                'tours' => Tour::count(),
                'users' => User::where('is_admin', false)->count(),
                'revenue' => Booking::sum('total_price'),
            ];

            return view('admin.dashboard', compact('user', 'bookings', 'stats', 'tours', 'destinations', 'paymentMethods', 'hero', 'sections'));
        }

        $bookings = $user->bookings()->with('tour')->latest()->get();
        $stats = null;

        return view('dashboard', compact('user', 'bookings', 'stats'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে।');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }
}
