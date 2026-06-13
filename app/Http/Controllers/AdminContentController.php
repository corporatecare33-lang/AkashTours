<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\PaymentMethod;
use App\Models\SiteSetting;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminContentController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(Auth::check() && Auth::user()->is_admin, 403);
    }

    public function updateHero(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'highlight' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'primary_button' => ['required', 'string', 'max:100'],
            'secondary_button' => ['required', 'string', 'max:100'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['nullable', 'url'],
        ]);

        $data['images'] = array_values(array_filter($data['images']));
        SiteSetting::setValue('hero', $data);

        return back()->with('success', 'Hero banner updated successfully.');
    }

    public function updateSections(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'packages_title' => ['required', 'string', 'max:255'],
            'packages_description' => ['required', 'string'],
            'destinations_title' => ['required', 'string', 'max:255'],
            'destinations_description' => ['required', 'string'],
            'payments_title' => ['required', 'string', 'max:255'],
            'payments_description' => ['required', 'string'],
        ]);

        SiteSetting::setValue('sections', $data);

        return back()->with('success', 'Section titles updated successfully.');
    }

    public function updateTour(Request $request, Tour $tour)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'price_per_person' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'string', 'max:100'],
            'duration' => ['nullable', 'string', 'max:100'],
            'image' => ['required', 'url'],
            'description' => ['nullable', 'string'],
            'total_seats' => ['required', 'integer', 'min:1'],
        ]);

        $tour->update($data);

        return back()->with('success', 'Tour package updated successfully.');
    }

    public function storeDestination(Request $request)
    {
        $this->ensureAdmin();

        Destination::create($this->destinationData($request));

        return back()->with('success', 'Destination added successfully.');
    }

    public function updateDestination(Request $request, Destination $destination)
    {
        $this->ensureAdmin();

        $destination->update($this->destinationData($request));

        return back()->with('success', 'Destination updated successfully.');
    }

    public function deleteDestination(Destination $destination)
    {
        $this->ensureAdmin();
        $destination->delete();

        return back()->with('success', 'Destination deleted successfully.');
    }

    public function storePayment(Request $request)
    {
        $this->ensureAdmin();

        PaymentMethod::create($this->paymentData($request));

        return back()->with('success', 'Payment method added successfully.');
    }

    public function updatePayment(Request $request, PaymentMethod $paymentMethod)
    {
        $this->ensureAdmin();

        $paymentMethod->update($this->paymentData($request));

        return back()->with('success', 'Payment method updated successfully.');
    }

    public function deletePayment(PaymentMethod $paymentMethod)
    {
        $this->ensureAdmin();
        $paymentMethod->delete();

        return back()->with('success', 'Payment method deleted successfully.');
    }

    private function destinationData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'url'],
            'layout' => ['required', 'in:normal,wide,tall'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => false];
    }

    private function paymentData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'url'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => false];
    }
}
