@extends('layouts.app')

@section('title', 'Zarządzaj produktami')

@section('content')
    <h1>Zarządzaj produktami</h1>

    <p style="margin-bottom:14px"><a href="{{ route('products.create') }}" class="btn">+ Dodaj produkt</a></p>

    @if($products->isEmpty())
        <p>Brak produktów.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Cena</th>
                    <th>Stan</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 2, ',', ' ') }} zł</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a class="action-link" href="{{ route('products.edit', $product) }}">Edytuj</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Usunąć produkt {{ $product->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:16px">
            
        </div>
    @endif
@endsection
