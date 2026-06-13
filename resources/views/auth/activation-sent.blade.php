@extends('layouts.app')

@section('title', 'Sprawdź skrzynkę e-mail')

@section('content')
    <div class="form-box">
        <h1>Sprawdź e-mail</h1>
        <p>Na adres <strong>{{ $activation_email ?? session('activation_email') }}</strong> wysłaliśmy link aktywacyjny.</p>
        <p style="margin-top:10px">Kliknij link w wiadomości, aby aktywować konto i zalogować się.</p>
        <p style="margin-top:16px; font-size:13px; color:#888">
            Nie dostałeś wiadomości? Sprawdź folder spam.
        </p>
    </div>
@endsection
