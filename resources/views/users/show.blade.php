@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Usuarios</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>

    @if (session('success'))
    <p class="success">{{ session('success') }}</p>
    @endif

    @if (session('error'))
    <p class="error">{{ session('error') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Correo Verificado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->email_verified_at ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
                    @if ($user->id != 1)
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                    </form>
                    @else
                    <button class="btn btn-secondary" disabled>No disponible</button>
                    @endif
                    @if (!$user->email_verified_at)
                    <form action="{{ route('users.verify-email', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('¿Verificar correo electrónico?')">Verificar Correo</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection