<?php
use App\Models\Arreglo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArregloController; // 👈 ESTA LÍNEA ES CLAVE


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
});


use App\Http\Controllers\CarritoController;


Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');


Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');

Route::get('/comprar/{id}', [CarritoController::class, 'comprar'])->name('comprar.directo');

Route::post('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');