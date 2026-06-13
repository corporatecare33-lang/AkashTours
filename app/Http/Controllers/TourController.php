<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tour;

class TourController extends Controller
{
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('tours.show', compact('tour'));
    }
}
