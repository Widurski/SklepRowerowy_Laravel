<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $products = Product::where('name', 'like', '%' . $search . '%')->latest()->get();
        } else {
            $products = Product::latest()->get();
        }

        return view('shop.index', compact('products', 'search'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
