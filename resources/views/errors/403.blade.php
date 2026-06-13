@extends('layouts.app')

@section('title', 'Brak dostępu')

@section('content')
    <h1>403 — Brak dostępu</h1>
    <p style="margin-bottom:16px">Nie masz uprawnień do wyświetlenia tej strony.</p>
    <a href="{{ route('home') }}" class="btn-secondary">&larr; Strona główna</a>
@endsection
