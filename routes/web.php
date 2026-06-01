<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/about', function () {
return 'Acerca de nosotros';
}); 


Route::get('/user/{id}', function ($id) {
return 'ID de usuario: ' . $id;
});


Route::get('/user/{id}', function ($id) {
 return 'ID de usuario: ' . $id;
})->where('id', '[0-9]{3}');

Route::prefix('admin')->group(function () {
Route::get('/', function () {
return 'Panel de administración';
}); 
Route::get('/users', function () {
return 'Lista de usuarios';
});
});
*/

/// Rutas con middleware asignado a un grupo:
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Proveedores
    Route::resource('proveedores', App\Http\Controllers\ProveedorController::class)->parameters([
        'proveedores' => 'proveedor'
    ]);
    Route::get('cambioestadoproveedor', [App\Http\Controllers\ProveedorController::class, 'cambioestado'])->name('cambioestadoproveedor');
    
    // Productos
    Route::resource('productos', App\Http\Controllers\ProductoController::class)->parameters([
        'productos' => 'producto'
    ]);
    Route::get('cambioestadoproducto', [App\Http\Controllers\ProductoController::class, 'cambioestado'])->name('cambioestadoproducto');
    
    // Órdenes de compra
    Route::resource('ordencompras', App\Http\Controllers\OrdencompraController::class)->parameters([
        'ordencompras' => 'ordencompra'
    ]);
    Route::get('cambioestadoordencompra', [App\Http\Controllers\OrdencompraController::class, 'cambioestado'])->name('cambioestadoordencompra');

    // Métodos de pago
    Route::resource('metodopagos', App\Http\Controllers\MetodopagoController::class)->parameters([
        'metodopagos' => 'metodopago'
    ]);
    Route::get('cambioestadometodopago', [App\Http\Controllers\MetodopagoController::class, 'cambioestado'])->name('cambioestadometodopago');
    
    // Pagos
    Route::resource('pagos', App\Http\Controllers\PagoController::class)->parameters([
        'pagos' => 'pago'
    ]);
   
});

Auth::routes();


