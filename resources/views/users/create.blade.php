@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Usuario</h2>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <label>Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" required>

        <label>Rol:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
