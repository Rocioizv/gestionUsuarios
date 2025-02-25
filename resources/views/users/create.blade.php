@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Usuario</h2>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">Volver atrás</a>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Rol:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection