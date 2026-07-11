@extends('layouts.app')

@section('title', 'Logowanie')

@section('content')
    <div class="form-box">
        <h1>Logowanie</h1>

        @include('partials.errors')

        <form action="{{ route('login') }}" method="POST" novalidate>
            @csrf

            <p>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </p>

            <p>
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" required>
            </p>

            <p>
                <label style="font-weight:normal">
                    <input type="checkbox" name="remember" value="1"> Zapamiętaj mnie
                </label>
            </p>

            <p>
                <button type="submit">Zaloguj się</button>
            </p>
        </form>

        <p style="margin-top:12px; font-size:14px">Nie masz konta? <a href="{{ route('register') }}">Zarejestruj się</a></p>
    </div>
@endsection
