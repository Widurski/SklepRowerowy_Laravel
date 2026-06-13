@extends('layouts.app')

@section('title', 'Panel administratora')

@section('content')
    <h1>Panel administratora</h1>

    <table style="max-width:400px">
        <thead>
            <tr>
                <th>Użytkownicy</th>
                <th>Produkty</th>
                <th>Zamówienia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $usersCount }}</td>
                <td>{{ $productsCount }}</td>
                <td>{{ $ordersCount }}</td>
            </tr>
        </tbody>
    </table>

    <ul class="dashboard-links" style="margin-top:16px">
        <li><a href="{{ route('admin.users.index') }}">Zarządzaj użytkownikami</a></li>
        <li><a href="{{ route('admin.users.create') }}">Dodaj użytkownika</a></li>
        <li><a href="{{ route('products.index') }}">Zarządzaj produktami</a></li>
        <li><a href="{{ route('admin.orders.index') }}">Zamówienia klientów</a></li>
    </ul>
@endsection
