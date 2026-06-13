@extends('layouts.app')

@section('title', 'Rejestracja')

@section('content')
    <div class="form-box">
        <h1>Rejestracja</h1>

        @include('partials.errors')

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <p>
                <label for="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </p>

            <p>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </p>

            <p>
                <label for="password">Hasło (min. 8 znaków, duża, mała litera i cyfra):</label>
                <input type="password" id="password" name="password" required>
            </p>

            <p>
                <label for="password_confirmation">Powtórz hasło:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </p>

            <p>
                <button type="submit">Zarejestruj się</button>
            </p>
        </form>

        <p style="margin-top:12px; font-size:14px">Masz już konto? <a href="{{ route('login') }}">Zaloguj się</a></p>
    </div>
@endsection
