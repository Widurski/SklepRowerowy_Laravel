@extends('layouts.app')

@section('title', 'Potwierdzenie zamówienia')

@section('content')
    <h1>Potwierdzenie zamówienia</h1>

    <table>
        <thead>
            <tr>
                <th>Produkt</th>
                <th>Cena</th>
                <th>Ilość</th>
                <th>Suma</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price'], 2, ',', ' ') }} zł</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} zł</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align:right; padding-right:12px"><strong>Do zapłaty:</strong></td>
                <td><strong class="cart-total">{{ number_format($total, 2, ',', ' ') }} zł</strong></td>
            </tr>
        </tfoot>
    </table>

    @if($errors->any())
        <div class="errors">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" style="margin-top:20px">
        @csrf

        <h2>Adres dostawy</h2>

        <p>
            <label for="shipping_name">Imię i nazwisko</label>
            <input type="text" id="shipping_name" name="shipping_name" value="{{ old('shipping_name', auth()->user()->name) }}">
        </p>
        <p>
            <label for="shipping_address">Ulica i numer</label>
            <input type="text" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" placeholder="np. ul. Kwiatowa 5/3">
        </p>
        <p>
            <label for="shipping_postal_code">Kod pocztowy</label>
            <input type="text" id="shipping_postal_code" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}" placeholder="00-000" style="max-width:120px">
        </p>
        <p>
            <label for="shipping_city">Miasto</label>
            <input type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}">
        </p>

        <div style="margin-top:16px">
            <button type="submit">Złóż zamówienie</button>
            &nbsp;
            <a href="{{ route('cart.index') }}" class="btn-secondary">Wróć do koszyka</a>
        </div>
    </form>
@endsection
