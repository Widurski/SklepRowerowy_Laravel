@extends('layouts.app')

@section('title', 'Użytkownicy')

@section('content')
    <h1>Zarządzanie użytkownikami</h1>

    <p style="margin-bottom:14px"><a href="{{ route('admin.users.create') }}" class="btn">+ Dodaj użytkownika</a></p>

    @if($users->isEmpty())
        <p>Brak użytkowników.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imię</th>
                    <th>E-mail</th>
                    <th>Rola</th>
                    <th>Data rejestracji</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roleLabel() }}</td>
                        <td>{{ $user->created_at->format('d.m.Y') }}</td>
                        <td>
                            <a class="action-link" href="{{ route('admin.users.show', $user) }}">Podgląd</a>
                            <a class="action-link" href="{{ route('admin.users.edit', $user) }}">Edytuj</a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline"
                                      onsubmit="return confirm('Usunąć użytkownika {{ $user->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Usuń</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:16px">
            
        </div>
    @endif
@endsection
