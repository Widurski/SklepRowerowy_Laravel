@extends('layouts.app')

@section('title', 'Edytuj: ' . $user->name)

@section('content')
    <h1>Edytuj: {{ $user->name }}</h1>

    @include('partials.errors')

    <div class="form-box">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <p>
                <label for="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </p>

            <p>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </p>

            <p>
                <label for="role">Rola:</label>
                <select id="role" name="role" required>
                    <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>Klient</option>
                    <option value="kierownik" {{ old('role', $user->role) === 'kierownik' ? 'selected' : '' }}>Kierownik</option>
                    <option value="administrator" {{ old('role', $user->role) === 'administrator' ? 'selected' : '' }}>Administrator</option>
                </select>
            </p>

            <p>
                <label for="password">Nowe hasło (zostaw puste, aby nie zmieniać):</label>
                <input type="password" id="password" name="password">
            </p>

            <p>
                <label for="password_confirmation">Powtórz nowe hasło:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </p>

            <p>
                <button type="submit">Zapisz zmiany</button>
                &nbsp;
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Anuluj</a>
            </p>
        </form>
    </div>
@endsection
