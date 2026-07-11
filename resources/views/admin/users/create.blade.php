@extends('layouts.app')

@section('title', 'Dodaj użytkownika')

@section('content')
    <h1>Dodaj użytkownika</h1>

    @include('partials.errors')

    <div class="form-box">
        <form action="{{ route('admin.users.store') }}" method="POST" novalidate>
            @csrf

            <p>
                <label for="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </p>

            <p>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </p>

            <p>
                <label for="role">Rola:</label>
                <select id="role" name="role" required>
                    <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Klient</option>
                    <option value="kierownik" {{ old('role') === 'kierownik' ? 'selected' : '' }}>Kierownik</option>
                    <option value="administrator" {{ old('role') === 'administrator' ? 'selected' : '' }}>Administrator</option>
                </select>
            </p>

            <p>
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" required>
            </p>

            <p>
                <label for="password_confirmation">Powtórz hasło:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </p>

            <p>
                <button type="submit">Dodaj użytkownika</button>
                &nbsp;
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Anuluj</a>
            </p>
        </form>
    </div>
@endsection
