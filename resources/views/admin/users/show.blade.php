@extends('layouts.app')

@section('title', 'Użytkownik: ' . $user->name)

@section('content')
    <h1>{{ $user->name }}</h1>

    <div class="info-box">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>E-mail:</strong> {{ $user->email }}</p>
        <p><strong>Rola:</strong> {{ $user->roleLabel() }}</p>
        <p><strong>Zarejestrowany:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
        <p><strong>Zamówienia:</strong> {{ $user->orders()->count() }}</p>
    </div>

    <p>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn">Edytuj</a>
        &nbsp;
        <a href="{{ route('admin.users.index') }}" class="btn-secondary">Wróć do listy</a>
    </p>
@endsection
