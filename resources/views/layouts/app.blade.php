<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RowerOwo - @yield('title', 'Sklep rowerowy')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav>
    <strong><a href="{{ route('home') }}">RowerOwo</a></strong>
    <a href="{{ route('home') }}">Sklep</a>

    @auth
        @if(auth()->user()->isClient())
            <a href="{{ route('cart.index') }}">Koszyk</a>
            <a href="{{ route('orders.index') }}">Moje zamówienia</a>
        @endif

        @if(auth()->user()->isKierownik() || auth()->user()->isAdmin())
            <a href="{{ route('kierownik.dashboard') }}">Panel kierownika</a>
            <a href="{{ route('products.index') }}">Produkty</a>
            <a href="{{ route('admin.orders.index') }}">Zamówienia klientów</a>
        @endif

        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}">Panel admina</a>
            <a href="{{ route('admin.users.index') }}">Użytkownicy</a>
        @endif

        &nbsp;|&nbsp; {{ auth()->user()->name }}
        &nbsp;
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Wyloguj</button>
        </form>
    @else
        <a href="{{ route('login') }}">Logowanie</a>
        <a href="{{ route('register') }}">Rejestracja</a>
    @endauth
</nav>

<main>
    @if(session('success'))
        <div class="msg-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="msg-error">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<footer>
    <p><strong>RowerOwo</strong> Sklep rowerowy</p>
    <p>ul. Święty Marcin 12, 61-806 Poznań</p>
    <p>Tel: 61 234 56 78  Email: kontakt@rowerowo.pl</p>
    <p>Pon - Pt od 9:00 do 18:00 Sob od 10:00 do 14:00</p>
</footer>

</body>
</html>
