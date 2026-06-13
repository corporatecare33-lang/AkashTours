<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\PaymentMethod;
use App\Models\SiteSetting;
use App\Models\Tour;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::query();

        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%' . $request->destination . '%')
                  ->orWhere('title', 'like', '%' . $request->destination . '%');
        }

        if ($request->filled('month')) {
            // Assuming the 'date' column contains something like 'October 2026' or '2026-10-01'
            // For simplicity with current string dates, we'll just search for the month name or year
            $month = date('F', strtotime($request->month));
            $year = date('Y', strtotime($request->month));
            $query->where(function($q) use ($month, $year) {
                $q->where('date', 'like', '%' . $month . '%')
                  ->where('date', 'like', '%' . $year . '%');
            });
        }

        $packages = $query->get();
        $hero = SiteSetting::getValue('hero');
        $sections = SiteSetting::getValue('sections');
        $destinations = Destination::where('is_active', true)->orderBy('sort_order')->get();
        $paymentPartners = PaymentMethod::where('is_active', true)->orderBy('sort_order')->get();

        return view('welcome', compact('packages', 'hero', 'sections', 'destinations', 'paymentPartners'));
    }

    public function about()
    {
        $promo_packages = Tour::latest()->take(3)->get();
        return view('about', compact('promo_packages'));
    }

    public function contact()
    {
        return view('contact');
    }
}
