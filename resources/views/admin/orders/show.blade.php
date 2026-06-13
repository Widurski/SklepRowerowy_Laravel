@extends('layouts.app')

@section('title', 'Zamówienie #' . $order->id)

@section('content')
    <h1>Zamówienie #{{ $order->id }}</h1>

    <div class="info-box">
        <p><strong>Klient:</strong> {{ $order->user?->name ?? '-' }} ({{ $order->user?->email ?? '-' }})</p>
        <p><strong>Data:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
        <p><strong>Status:</strong> {{ $order->statusLabel() }}</p>
        <p><strong>Kwota:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} zł</p>
        <p style="margin-top:8px"><strong>Adres dostawy:</strong><br>
            {{ $order->shipping_name }}<br>
            {{ $order->shipping_address }}<br>
            {{ $order->shipping_postal_code }} {{ $order->shipping_city }}
        </p>
    </div>

    @if(session('success'))
        <p style="color:green; margin-bottom:12px">{{ session('success') }}</p>
    @endif

    <h2 style="font-size:16px; margin-bottom:10px">Zmień status</h2>
    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="margin-bottom:20px">
        @csrf
        @method('PATCH')
        <select name="status" style="padding:6px 10px; border:1px solid #888; margin-right:8px">
            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Oczekujące</option>
            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>W realizacji</option>
            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Wysłane</option>
            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Dostarczone</option>
            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Anulowane</option>
        </select>
        <button type="submit" class="btn">Zapisz</button>
    </form>

    <h2 style="font-size:16px; margin-bottom:10px">Pozycje zamówienia</h2>
    <table>
        <thead>
            <tr>
                <th>Produkt</th>
                <th>Ilość</th>
                <th>Cena jedn.</th>
                <th>Razem</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product?->name ?? 'Produkt usunięty' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2, ',', ' ') }} zł</td>
                    <td>{{ number_format($item->unit_price * $item->quantity, 2, ',', ' ') }} zł</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-bottom:16px"><a href="{{ route('admin.orders.index') }}">Wróć do listy zamówień</a></p>
@endsection
