<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Order;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $totalServices = Service::count();
        $totalPortfolios = Portfolio::count();
        $totalOrders = Order::count();
        $totalContacts = Contact::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $unreadContacts = Contact::where('is_read', false)->count();
        $recentOrders = Order::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalServices',
            'totalPortfolios',
            'totalOrders',
            'totalContacts',
            'pendingOrders',
            'unreadContacts',
            'recentOrders',
            'recentContacts'
        ));
    }
}
