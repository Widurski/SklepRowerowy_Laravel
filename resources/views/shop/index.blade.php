@extends('layouts.app')

@section('title', 'Sklep rowerowy')

@section('content')
    <h1>Nasze rowery</h1>

    <form method="GET" action="{{ route('home') }}" style="margin-bottom:16px">
        <input type="text" name="search" value="{{ $search }}" placeholder="Szukaj roweru..." style="padding:6px 10px; border:1px solid #888; width:260px">
        <button type="submit" class="btn" style="margin-left:6px">Szukaj</button>
        @if($search)
            <a href="{{ route('home') }}" style="margin-left:8px">Wyczyść</a>
        @endif
    </form>

    @if($products->isEmpty())
        <p>Brak produktów w sklepie.</p>
    @else
        <table class="product-table">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Cena</th>
                    <th>Dostępność</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                        <td>{{ number_format($product->price, 2, ',', ' ') }} zł</td>
                        <td>{{ $product->stock > 0 ? $product->stock . ' szt.' : 'Brak' }}</td>
                        <td>
                            <a class="action-link" href="{{ route('products.show', $product) }}">Szczegóły</a>
                            @if(auth()->check() && auth()->user()->isClient())
                                @if($product->stock > 0)
                                    &nbsp;
                                    <form action="{{ route('cart.add', $product) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn" style="padding:4px 10px; font-size:13px">Dodaj do koszyka</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:16px">
            
        </div>
    @endif
@endsection
