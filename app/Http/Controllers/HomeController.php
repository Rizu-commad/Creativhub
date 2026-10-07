<?php

namespace App\Http\Controllers;

use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch active services to display on the main page
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        
        return view('home.index', compact('services'));
    }
}