<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
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
            'features' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['features'] = $request->features
            ? array_map('trim', explode("\n", $request->features))
            : [];
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $validated['icon'] ?: 'fa-solid fa-star';
        $validated['price_unit'] = $validated['price_unit'] ?: '/ item';

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'price_unit' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['features'] = $request->features
            ? array_map('trim', explode("\n", $request->features))
            : [];
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $validated['icon'] ?: 'fa-solid fa-star';
        $validated['price_unit'] = $validated['price_unit'] ?: '/ item';

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}
