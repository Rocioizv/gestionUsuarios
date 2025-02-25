<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminMiddleware;

//  Autenticación y verificación de email
Auth::routes(['verify' => true]);

//  Landing Page pública
Route::get('/', function () {
    return view('index'); // Mostrará index.blade.php en lugar de redirigir
})->name('index');

//  Logout (seguro, solo por POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//  Dashboard (solo autenticados y verificados)
// Route::get('/dashboard', function () {
//     return redirect()->route('users.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

//  Perfil (solo autenticados y verificados)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

//  Administración de usuarios (solo administradores)
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//     Route::post('/users', [UserController::class, 'store'])->name('users.store');
//     Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//     Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
//     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// });


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/users', [UserController::class, 'show'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/verify-email', [UserController::class, 'verifyEmail'])->name('users.verify-email');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});