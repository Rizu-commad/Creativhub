<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::orderBy('sort_order')->orderBy('id', 'desc')->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,mkv,pdf|max:1048576',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Portfolio::create($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portofolio berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi,mkv,pdf|max:1048576',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $portfolio->update($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portofolio berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portofolio berhasil dihapus!');
    }
}
