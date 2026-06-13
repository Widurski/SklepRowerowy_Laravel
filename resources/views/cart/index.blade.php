@extends('layouts.app')

@section('title', 'Koszyk')

@section('content')
    <h1>Mój koszyk</h1>

    @if(empty($cart))
        <p>Koszyk jest pusty. <a href="{{ route('home') }}">Przeglądaj rowery</a></p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Cena</th>
                    <th>Ilość</th>
                    <th>Suma</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 2, ',', ' ') }} zł</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" style="display:flex; gap:6px; align-items:center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty">
                                <button type="submit" class="btn-secondary" style="padding:5px 10px; font-size:13px">OK</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} zł</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right; padding-right:12px"><strong>Łącznie:</strong></td>
                    <td><strong class="cart-total">{{ number_format($total, 2, ',', ' ') }} zł</strong></td>
                    <td>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Wyczyścić koszyk?')">Wyczyść</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>

        <p style="margin-top:10px">
            <a href="{{ route('orders.checkout') }}" class="btn" style="display:inline-block; padding:9px 20px">Przejdź do kasy</a>
        </p>
    @endif
@endsection
