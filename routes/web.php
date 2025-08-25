<?php
use App\Models\Arreglo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArregloController; // 👈 ESTA LÍNEA ES CLAVE
use App\Http\Controllers\ArregloPersonalizadoController;
use App\Http\Controllers\Admin\FlorController;
use App\Http\Controllers\TipoArregloController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoAdminController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Esta ruta puede quedarse fuera del grupo si es pública
Route::get('/arreglos', [ArregloController::class, 'index']);

Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');


Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');

Route::get('/comprar/{id}', [CarritoController::class, 'comprar'])->name('comprar.directo');

Route::post('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

Route::get('/pago', [PagoController::class, 'mostrarFormulario'])->name('pago.formulario');

Route::post('/pago/procesar', [PagoController::class, 'procesarPago'])->name('pago.procesar');

Route::get('/arreglo/personalizado', [ArregloPersonalizadoController::class, 'crearPersonalizado'])->name('arreglo.formulario');
Route::post('/arreglo/personalizado', [ArregloPersonalizadoController::class, 'guardar'])->name('arreglo.personalizado');




// Rutas públicas para ver los arreglos
Route::get('/arreglos', [ArregloController::class, 'publicIndex'])->name('arreglos.publicos');
Route::get('/', function () {
    $arreglos = Arreglo::all(); // Consulta todos los arreglos
    return view('welcome', compact('arreglos')); // Pasa los datos a la vista
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // CRUD para arreglos solo accesible por admins
    Route::resource('admin/arreglos', ArregloController::class);
    Route::resource('arreglos', ArregloController::class);
    //Crud de administracion para roles de usuario

Route::resource('usuarios', \App\Http\Controllers\UserAdminController::class)->only(['index', 'create', 'store', 'destroy']);
Route::post('usuarios/{user}/hacer-admin', [\App\Http\Controllers\UserAdminController::class, 'hacerAdmin'])->name('usuarios.hacerAdmin');
Route::post('usuarios/{user}/quitar-admin', [\App\Http\Controllers\UserAdminController::class, 'quitarAdmin'])->name('usuarios.quitarAdmin');


});



Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Ruta CRUD para tipo_arreglos, quedará como admin/tipo_arreglos/*
    Route::resource('tipo_arreglos', TipoArregloController::class);

    // CRUD flores
    Route::resource('flores', FlorController::class)->parameters([
        'flores' => 'flor'
    ]);
});

// Rutas para el panel de usuario (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Rutas para gestión de cuenta
    Route::get('/mi-cuenta', [App\Http\Controllers\UserController::class, 'showAccount'])->name('user.account');
    Route::put('/mi-cuenta', [App\Http\Controllers\UserController::class, 'updateAccount'])->name('user.account.update');
    Route::put('/cambiar-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update');
    
    // Ruta para ayuda
    Route::get('/ayuda', [App\Http\Controllers\UserController::class, 'showHelp'])->name('user.help');
    Route::post('/ayuda', [App\Http\Controllers\UserController::class, 'submitHelp'])->name('user.help.submit');
    
    // Ruta para mis compras (placeholder)
    Route::get('/mis-compras', [App\Http\Controllers\UserController::class, 'showPurchases'])->name('user.purchases');

    //Ruta para gestionar pedidos en el panel de usuario
    Route::get('/usuario/pedidos', [App\Http\Controllers\PedidoController::class, 'misPedidos'])->name('usuario.pedidos');

});

//Rutas para el panel de usuario Actualizar Informacion y contraseñas
Route::middleware('auth')->group(function () {
    Route::get('/mi-cuenta', function () {
        return view('user.account');
    })->name('user.account');

    Route::put('/mi-cuenta/actualizar', [App\Http\Controllers\UserController::class, 'updateAccount'])->name('user.updateAccount');
});

//Rutas para el panel de usuario seccion de ayuda

use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/ayuda', function () {
        return view('user.help');
    })->name('user.help');

    Route::post('/ayuda/enviar', [UserController::class, 'sendHelp'])->name('user.help.send');
});

//Rutas para implementacion de colores en el panel de administracion
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('colores', ColorController::class);

    //Ruta actualizar el estado
    Route::put('/pedidos/{id}/estado', [PedidoAdminController::class, 'updateEstado'])->name('pedidos.updateEstado');


    //Rutas para administrar los pedidos en el middleware
    Route::get('/pedidos', [PedidoAdminController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{id}', [PedidoAdminController::class, 'show'])->name('pedidos.show');
});








