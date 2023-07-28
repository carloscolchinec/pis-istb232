<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUsuariosController;



use App\Http\Controllers\Emp\DefaultLoginController;
use App\Http\Controllers\Emp\DefaultController;
use App\Http\Controllers\Emp\ClientesController;
use App\Http\Controllers\Emp\ClientesProductosCategoriasController;
use App\Http\Controllers\Emp\ClientesProductosController;
use App\Http\Controllers\Emp\ClientesFacturasController;
use App\Http\Controllers\emp\ClientesProveedoresController;
use App\Http\Controllers\Emp\ProveedoresIngresoProductosController;


Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/admin/', '/admin/login');
Route::redirect('/enterprise/', '/enterprise/login');


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
Route::middleware('web')->group(function () {
    Route::get('/enterprise/dashboard', [DefaultController::class, 'dashboard'])->name('enterprise.dashboard');


    Route::get('/enterprise/clientes', [ClientesController::class, 'index'])->name('enterprise.clientes.index');
    Route::get('/enterprise/clientes/create', [ClientesController::class, 'create'])->name('enterprise.clientes.create');
    Route::post('/enterprise/clientes', [ClientesController::class, 'store'])->name('enterprise.clientes.store');
    Route::get('/enterprise/clientes/{id}', [ClientesController::class, 'show'])->name('enterprise.clientes.show');
    Route::get('/enterprise/clientes/{id}/edit', [ClientesController::class, 'edit'])->name('enterprise.clientes.edit');
    Route::put('/enterprise/clientes/{id}', [ClientesController::class, 'update'])->name('enterprise.clientes.update');
    Route::delete('/enterprise/clientes/{id}', [ClientesController::class, 'destroy'])->name('enterprise.clientes.destroy');


    Route::get('/enterprise/categorias', [ClientesProductosCategoriasController::class, 'index'])->name('enterprise.categorias.index');
    Route::get('/enterprise/categorias/create', [ClientesProductosCategoriasController::class, 'create'])->name('enterprise.categorias.create');
    Route::post('/enterprise/categorias', [ClientesProductosCategoriasController::class, 'store'])->name('enterprise.categorias.store');
    Route::get('/enterprise/categorias/{categoria}', [ClientesProductosCategoriasController::class, 'show'])->name('enterprise.categorias.show');
    Route::get('/enterprise/categorias/{categoria}/edit', [ClientesProductosCategoriasController::class, 'edit'])->name('enterprise.categorias.edit');
    Route::put('/enterprise/categorias/{categoria}', [ClientesProductosCategoriasController::class, 'update'])->name('enterprise.categorias.update');
    Route::delete('/enterprise/categorias/{categoria}', [ClientesProductosCategoriasController::class, 'destroy'])->name('enterprise.categorias.destroy');


    Route::get('/enterprise/productos', [ClientesProductosController::class, 'index'])->name('enterprise.productos.index');
    Route::get('/enterprise/productos/create', [ClientesProductosController::class, 'create'])->name('enterprise.productos.create');
    Route::post('/enterprise/productos', [ClientesProductosController::class, 'store'])->name('enterprise.productos.store');
    Route::get('/enterprise/productos/{producto}', [ClientesProductosController::class, 'show'])->name('enterprise.productos.show');
    Route::get('/enterprise/productos/{producto}/edit', [ClientesProductosController::class, 'edit'])->name('enterprise.productos.edit');
    Route::put('/enterprise/productos/{producto}', [ClientesProductosController::class, 'update'])->name('enterprise.productos.update');
    Route::delete('/enterprise/productos/{producto}', [ClientesProductosController::class, 'destroy'])->name('enterprise.productos.destroy');
    Route::get('/enterprise/productos/pdf', [ClientesProductosController::class, 'generatePDF'])->name('enterprise.productos.pdf');


    Route::get('/enterprise/facturas', [ClientesFacturasController::class, 'index'])->name('enterprise.facturas.index');
    Route::get('/enterprise/facturas/create', [ClientesFacturasController::class, 'create'])->name('enterprise.facturas.create');
    Route::post('/enterprise/facturas', [ClientesFacturasController::class, 'store'])->name('enterprise.facturas.store');
    Route::get('/enterprise/facturas/{categoria}', [ClientesFacturasController::class, 'show'])->name('enterprise.facturas.show');
    Route::get('/enterprise/facturas/{categoria}/edit', [ClientesFacturasController::class, 'edit'])->name('enterprise.facturas.edit');
    Route::put('/enterprise/facturas/{categoria}', [ClientesFacturasController::class, 'update'])->name('enterprise.facturas.update');
    Route::delete('/enterprise/facturas/{categoria}', [ClientesFacturasController::class, 'destroy'])->name('enterprise.facturas.destroy');

    Route::get('/enterprise/proveedores', [ClientesProveedoresController::class, 'index'])->name('enterprise.proveedores.index');
    Route::get('/enterprise/proveedores/create', [ClientesProveedoresController::class, 'create'])->name('enterprise.proveedores.create');
    Route::post('/enterprise/proveedores', [ClientesProveedoresController::class, 'store'])->name('enterprise.proveedores.store');
    Route::get('/enterprise/proveedores/{proveedor}', [ClientesProveedoresController::class, 'show'])->name('enterprise.proveedores.show');
    Route::get('/enterprise/proveedores/{proveedor}/edit', [ClientesProveedoresController::class, 'edit'])->name('enterprise.proveedores.edit');
    Route::put('/enterprise/proveedores/{proveedor}', [ClientesProveedoresController::class, 'update'])->name('enterprise.proveedores.update');
    Route::delete('/enterprise/proveedores/{proveedor}', [ClientesProveedoresController::class, 'destroy'])->name('enterprise.proveedores.destroy');

    Route::get('/enterprise/ingreso-productos', [ProveedoresIngresoProductosController::class, 'index'])->name('enterprise.ingreso-productos.index');
    Route::get('/enterprise/ingreso-productos/create', [ProveedoresIngresoProductosController::class, 'create'])->name('enterprise.ingreso-productos.create');
    Route::post('/enterprise/ingreso-productos', [ProveedoresIngresoProductosController::class, 'store'])->name('enterprise.ingreso-productos.store');
    Route::get('/enterprise/ingreso-productos/{proveedor}', [ProveedoresIngresoProductosController::class, 'show'])->name('enterprise.ingreso-productos.show');
    Route::get('/enterprise/ingreso-productos/{proveedor}/edit', [ProveedoresIngresoProductosController::class, 'edit'])->name('enterprise.ingreso-productos.edit');
    Route::put('/enterprise/ingreso-productos/{proveedor}', [ProveedoresIngresoProductosController::class, 'update'])->name('enterprise.ingreso-productos.update');
    Route::delete('/enterprise/ingreso-productos/{proveedor}', [ProveedoresIngresoProductosController::class, 'destroy'])->name('enterprise.ingreso-productos.destroy');



});


// Login

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.check');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/enterprise/login', [DefaultLoginController::class, 'showLoginForm'])->name('enterprise.login');
Route::post('/enterprise/login', [DefaultLoginController::class, 'login'])->name('enterprise.check');
Route::post('/enterprise/logout', [DefaultLoginController::class, 'logout'])->name('enterprise.logout');
