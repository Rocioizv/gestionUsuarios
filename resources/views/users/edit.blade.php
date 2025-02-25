@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Usuario</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label>Rol:</label>
        <select name="role" {{ $user->id == 1 ? 'disabled' : '' }}>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        </select>

        @if ($user->id == 1)
            <input type="hidden" name="role" value="{{ $user->role }}">
        @endif

        <button type="submit">Guardar cambios</button>
    </form>
</div>
@endsection