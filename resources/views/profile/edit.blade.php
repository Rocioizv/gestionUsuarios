@extends('layouts.app')

@section('content')
<div class="container">
        <h2>Editar Perfil</h2>

        <!-- Mensajes de éxito o error -->
        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Campo de Nombre -->
            <div class="input-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
            </div>

            <!-- Campo de Email -->
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
            </div>

            <!-- Campo de Rol (Solo lectura) -->
            <div class="input-group">
                <label for="role">Rol</label>
                <input type="text" id="role" name="role" value="{{ Auth::user()->role }}" disabled>
            </div>

            <!-- Botón de Guardar Cambios -->
            <button type="submit">Guardar Cambios</button>

            <a class="link" href="{{ route('dashboard') }}">Volver</a>
        </form>
    </div>
</body>
</html>
@endsection