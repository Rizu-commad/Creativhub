<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricings = Pricing::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.pricings.index', compact('pricings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pricings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'price_unit' => 'nullable|string|max:100',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $validated['icon'] ?: 'fa-solid fa-star';
        $validated['price_unit'] = $validated['price_unit'] ?: '/ item';

        Pricing::create($validated);

        return redirect()->route('admin.pricings.index')
            ->with('success', 'Harga berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pricing $pricing)
    {
        return view('admin.pricings.edit', compact('pricing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pricing $pricing)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'price_unit' => 'nullable|string|max:100',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $validated['icon'] ?: 'fa-solid fa-star';
        $validated['price_unit'] = $validated['price_unit'] ?: '/ item';

        $pricing->update($validated);

        return redirect()->route('admin.pricings.index')
            ->with('success', 'Harga berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pricing $pricing)
    {
        $pricing->delete();

        return redirect()->route('admin.pricings.index')
            ->with('success', 'Harga berhasil dihapus!');
    }
}
