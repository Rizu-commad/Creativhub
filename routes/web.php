<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

use App\Http\Controllers\Admin\PricingController as AdminPricingController;

Route::get('/', function () {
    $services = App\Models\Service::where('is_active', true)
        ->where('is_popular', true)
        ->orderBy('sort_order')
        ->take(4)
        ->get();
    return view('home.index', compact('services'));
})->name('home');

Route::get('/services', function () {
    $services = App\Models\Service::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
    return view('services.index', compact('services'));
})->name('services');

Route::get('/portfolio', function () {
    $portfolios = App\Models\Portfolio::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id', 'desc')
        ->get();
    return view('portfolio.index', compact('portfolios'));
})->name('portfolio');

Route::get('/pricing', function () {
    $pricings = App\Models\Pricing::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
    return view('pricing.index', compact('pricings'));
})->name('pricing');

Route::get('/contact', function () {
    $services = App\Models\Service::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
    return view('contact.index', compact('services'));
})->name('contact');

Route::post('/contact', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'contact_info' => 'required|string|max:255',
        'service' => 'nullable|string|max:255',
        'payment_method' => 'nullable|string|max:255',
        'message' => 'nullable|string'
    ]);
    
    // Append payment method to the message if exists so it saves to the DB
    $dbMessage = $validated['message'] ?? '';
    if (!empty($validated['payment_method'])) {
        $dbMessage = "Metode Pembayaran: " . $validated['payment_method'] . "\n\n" . $dbMessage;
    }
    
    App\Models\Contact::create([
        'name' => $validated['name'],
        'contact_info' => $validated['contact_info'],
        'service' => $validated['service'],
        'message' => $dbMessage
    ]);

    // Format WhatsApp message
    $waText = "Halo CreativeHub, saya ingin memesan layanan Anda:\n\n";
    $waText .= "*Nama:* " . $validated['name'] . "\n";
    $waText .= "*Kontak:* " . $validated['contact_info'] . "\n";
    $waText .= "*Layanan:* " . ($validated['service'] ?? '-') . "\n";
    $waText .= "*Metode Pembayaran:* " . ($validated['payment_method'] ?? '-') . "\n\n";
    $waText .= "*Pesan / Brief:*\n" . ($validated['message'] ?? '-');

    $waUrl = "https://api.whatsapp.com/send?phone=6285726820420&text=" . urlencode($waText);

    return redirect()->away($waUrl);
})->name('contact.submit');

// =====================
// ADMIN ROUTES
// =====================
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Services CRUD
    Route::resource('services', AdminServiceController::class)->except(['show']);

    // Pricings CRUD
    Route::resource('pricings', AdminPricingController::class)->except(['show']);

    // Portfolio CRUD
    Route::resource('portfolio', AdminPortfolioController::class)->except(['show']);

    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::patch('contacts/{contact}/read', [AdminContactController::class, 'markRead'])->name('contacts.markRead');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
});