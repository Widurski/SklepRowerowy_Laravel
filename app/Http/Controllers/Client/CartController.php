<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = $request->input('quantity', 1);
        $cart = session('cart', []);

        $current = $cart[$product->id]['quantity'] ?? 0;
        $newQuantity = $current + $quantity;

        if ($newQuantity > $product->stock) {
            return back()->with('error',
                'Nie możesz dodać tylu sztuk. Dostępne w magazynie: ' . $product->stock .
                ', a w koszyku masz już: ' . $current . '.'
            );
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $newQuantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => (float) $product->price,
                'quantity'   => $newQuantity,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produkt dodany do koszyka.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($request->quantity > $product->stock) {
            return back()->with('error',
                'Dostępne w magazynie: ' . $product->stock . ' szt. Nie możesz zamówić więcej.'
            );
        }

        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Koszyk zaktualizowany.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Produkt usunięty z koszyka.');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Koszyk został wyczyszczony.');
    }
}
