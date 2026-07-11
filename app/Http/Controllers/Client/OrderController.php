<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
    }

    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Koszyk jest pusty.');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Koszyk jest pusty.');
        }

        $request->validate([
            'shipping_name'        => ['required', 'string', 'min:2', 'max:100'],
            'shipping_address'     => ['required', 'string', 'min:3', 'max:200'],
            'shipping_postal_code' => ['required', 'string', 'regex:/^\d{2}-\d{3}$/'],
            'shipping_city'        => ['required', 'string', 'min:2', 'max:100'],
        ], [
            'shipping_postal_code.regex' => 'Podaj kod pocztowy w formacie 00-000.',
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                return redirect()->route('cart.index')->with('error',
                    'Produkt "' . $item['name'] . '" nie jest już dostępny.'
                );
            }
            if ($product->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error',
                    'Produkt "' . $item['name'] . '": w koszyku masz ' . $item['quantity'] .
                    ' szt., a w magazynie dostępne jest tylko ' . $product->stock . ' szt.'
                );
            }
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $order = Order::create([
            'user_id'              => Auth::id(),
            'status'               => 'pending',
            'total_price'          => $total,
            'shipping_name'        => $request->shipping_name,
            'shipping_address'     => $request->shipping_address,
            'shipping_postal_code' => $request->shipping_postal_code,
            'shipping_city'        => $request->shipping_city,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'unit_price' => $item['price'],
            ]);

            $product = Product::find($item['product_id']);
            $product->stock = $product->stock - $item['quantity'];
            $product->save();
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Zamówienie zostało złożone!');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}
