<?php

namespace App\Http\Controllers\Kierownik;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        return view('kierownik.dashboard', compact('productsCount'));
    }
}
