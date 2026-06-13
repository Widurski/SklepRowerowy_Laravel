<?php

namespace App\Http\Controllers\Kierownik;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'min:2', 'max:200'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price'       => ['required', 'numeric', 'min:0.01', 'regex:/^\d+(\.\d{1,2})?$/'],
            'stock'       => ['required', 'integer', 'min:0'],
        ]);

        Product::create($request->only('name', 'description', 'price', 'stock'));

        return redirect()->route('products.index')->with('success', 'Produkt został dodany.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => ['required', 'string', 'min:2', 'max:200'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price'       => ['required', 'numeric', 'min:0.01', 'regex:/^\d+(\.\d{1,2})?$/'],
            'stock'       => ['required', 'integer', 'min:0'],
        ]);

        $product->update($request->only('name', 'description', 'price', 'stock'));

        return redirect()->route('products.index')->with('success', 'Produkt został zaktualizowany.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produkt został usunięty.');
    }
}
