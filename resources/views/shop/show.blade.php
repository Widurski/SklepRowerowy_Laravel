@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>

    <div class="info-box">
        <p><strong>Cena:</strong> {{ number_format($product->price, 2, ',', ' ') }} zł</p>
        <p><strong>Dostępność:</strong> {{ $product->stock > 0 ? $product->stock . ' szt.' : 'Brak w magazynie' }}</p>
        @if($product->description)
            <p><strong>Opis:</strong> {{ $product->description }}</p>
        @endif
    </div>

    @if(auth()->check() && auth()->user()->isClient())
        @if($product->stock > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <p>
                    <label for="quantity">Ilość:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="qty">
                </p>
                <p>
                    <button type="submit">Dodaj do koszyka</button>
                </p>
            </form>
        @else
            <p style="color:#8b1a1a">Produkt niedostępny.</p>
        @endif
    @elseif(!auth()->check())
        <p><a href="{{ route('login') }}">Zaloguj się</a>, aby dodać produkt do koszyka.</p>
    @endif

    <p style="margin-top:16px"><a href="{{ route('home') }}">&larr; Wróć do sklepu</a></p>
@endsection
