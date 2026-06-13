@extends('layouts.app')

@section('title', 'Moje zamówienia')

@section('content')
    <h1>Moje zamówienia</h1>

    @if($orders->isEmpty())
        <p>Nie masz jeszcze żadnych zamówień. <a href="{{ route('home') }}">Przeglądaj rowery</a></p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nr</th>
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
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $order->statusLabel() }}</td>
                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} zł</td>
                        <td><a class="action-link" href="{{ route('orders.show', $order) }}">Szczegóły</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
