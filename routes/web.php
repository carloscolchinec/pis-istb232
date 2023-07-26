<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUsuariosController;



use App\Http\Controllers\DefaultLoginController;


Route::get('/', function () {
    return view('welcome');
});



// Rutas protegidas para el administrador
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Usuarios
    Route::get('/admin/usuarios', [AdminUsuariosController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/admin/create', [AdminUsuariosController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/admin/usuarios', [AdminUsuariosController::class, 'store'])->name('admin.usuarios.store');
    Route::get('/admin/usuarios/{perfil}', [AdminUsuariosController::class, 'show'])->name('admin.usuarios.show');
    Route::get('/admin/usuarios/{perfil}/edit', [AdminUsuariosController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{perfil}', [AdminUsuariosController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('admin/usuarios/{perfil}', [AdminUsuariosController::class, 'destroy'])->name('admin.usuarios.destroy');
});

// Rutas protegidas para el usuario default
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [DefaultController::class, 'dashboard'])->name('user.dashboard');
    // Otras rutas protegidas para el usuario default...
});


Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/login', [DefaultLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [DefaultLoginController::class, 'login']);
Route::post('/logout', [DefaultLoginController::class, 'logout'])->name('logout');
