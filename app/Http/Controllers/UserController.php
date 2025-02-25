<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function show()
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('users.show', compact('users'));
    }

    // Formulario de creación
    public function create()
    {
        return view('users.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Formulario de edición
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);

        // El superusuario no puede cambiar su propio rol
        if ($user->id == 1 && Auth::id() == 1 && $request->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'No puedes cambiar tu propio rol.');
        }

        // Marcar el correo como no verificado si ha sido cambiado
        if ($user->email !== $request->email) {
            $user->email_verified_at = null;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Verificar correo electrónico
    public function verifyEmail(User $user)
    {
        // Solo el superadministrador puede verificar correos electrónicos
        if (Auth::user()->role !== 'admin' || Auth::id() !== 1) {
            return redirect()->route('users.index')->with('error', 'No tienes permiso para verificar correos electrónicos.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('users.index')->with('success', 'Correo electrónico verificado correctamente.');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        // El superusuario no puede eliminarse a sí mismo
        if ($user->id == 1) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar al superusuario.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
