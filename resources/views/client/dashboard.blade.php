@extends('layouts.app')

@section('title', 'Moje konto')

@section('content')
    <h1>Witaj, {{ auth()->user()->name }}!</h1>

    <ul class="dashboard-links">
        <li><a href="{{ route('home') }}">Przeglądaj rowery</a></li>
        <li><a href="{{ route('cart.index') }}">Mój koszyk</a></li>
        <li><a href="{{ route('orders.index') }}">Historia zamówień</a></li>
    </ul>
@endsection
