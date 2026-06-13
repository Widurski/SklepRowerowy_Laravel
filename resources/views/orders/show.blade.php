@extends('layouts.app')

@section('title', 'Zamówienie #' . $order->id)

@section('content')
    <h1>Zamówienie #{{ $order->id }}</h1>

    <div class="info-box">
        <p><strong>Data:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
        <p><strong>Status:</strong> {{ $order->statusLabel() }}</p>
        <p><strong>Łączna kwota:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} zł</p>
        <p style="margin-top:8px"><strong>Adres dostawy:</strong><br>
            {{ $order->shipping_name }}<br>
            {{ $order->shipping_address }}<br>
            {{ $order->shipping_postal_code }} {{ $order->shipping_city }}
        </p>
    </div>

    <h2>Pozycje zamówienia</h2>

    <table>
        <thead>
            <tr>
                <th>Produkt</th>
                <th>Cena jedn.</th>
                <th>Ilość</th>
                <th>Suma</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        @if($item->product)
                            <a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a>
                        @else
                            <em style="color:#888">(produkt usunięty)</em>
                        @endif
                    </td>
                    <td>{{ number_format($item->unit_price, 2, ',', ' ') }} zł</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price * $item->quantity, 2, ',', ' ') }} zł</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><a href="{{ route('orders.index') }}">Wróć do zamówień</a></p>
@endsection
