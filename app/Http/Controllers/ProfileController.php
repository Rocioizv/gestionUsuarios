<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{

    public function update(Request $request)
    {
        $user = Auth::user(); // Obtener usuario autenticado
        // dd($user);

        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Verificar si el correo cambió
        if ($request->email !== $user->email) {
            $user->email_verified_at = null; // Marcar como no verificado
        }

        // Actualizar usuario sin permitir cambiar el rol
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function edit()
    {
        return view('profile.edit');
    }
}
