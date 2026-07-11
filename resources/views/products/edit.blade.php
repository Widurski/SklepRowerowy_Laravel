@extends('layouts.app')

@section('title', 'Edytuj: ' . $product->name)

@section('content')
    <h1>Edytuj: {{ $product->name }}</h1>

    @include('partials.errors')

    <div class="form-box">
        <form action="{{ route('products.update', $product) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <p>
                <label for="name">Nazwa:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </p>

            <p>
                <label for="description">Opis:</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
            </p>

            <p>
                <label for="price">Cena (zł):</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0.01" required>
            </p>

            <p>
                <label for="stock">Stan magazynowy (szt.):</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
            </p>

            <p>
                <button type="submit">Zapisz zmiany</button>
                &nbsp;
                <a href="{{ route('products.index') }}" class="btn-secondary">Anuluj</a>
            </p>
        </form>
    </div>
@endsection
