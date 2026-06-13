@extends('layouts.app')

@section('title', 'Panel kierownika')

@section('content')
    <h1>Panel kierownika</h1>

    <div class="info-box">
        <p>Produkty w sklepie: <strong>{{ $productsCount }}</strong></p>
    </div>

    <ul class="dashboard-links">
        <li><a href="{{ route('products.index') }}">Zarządzaj produktami</a></li>
        <li><a href="{{ route('products.create') }}">Dodaj nowy produkt</a></li>
    </ul>
@endsection
