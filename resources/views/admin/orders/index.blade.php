@extends('layouts.app')

@section('title', 'Zamówienia')

@section('content')
    <h1>Zamówienia klientów</h1>

    @if($orders->isEmpty())
        <p>Brak zamówień.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Klient</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Kwota</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user?->name ?? '-' }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $order->statusLabel() }}</td>
                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} zł</td>
                        <td>
                            <a class="action-link" href="{{ route('admin.orders.show', $order) }}">Szczegóły</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:16px">
            
        </div>
    @endif
@endsection
