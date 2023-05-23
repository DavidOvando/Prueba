<?php
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Asignar\AsignarController;
use App\Http\Controllers\Actor\ActorController;
use App\Http\Controllers\Actor\AsignarPeliculaController;
use App\Http\Controllers\Pelicula\PeliculaController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Permisos\PermisosController;
use App\Models\Users;
use App\Models\Asignar;
use App\Models\AsignarPelicula;
use App\Models\Actores;
use App\Models\Pelicula;
use App\Models\Roles;
use App\Models\Permisos;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
// Main Page Route

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home-index');

//User
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('user.index');
    Route::post('/store', 'store')->name('user.store');
    Route::get('/get', 'get')->name('user.get');
    Route::get('/delete/{user}', 'delete')->name('user.delete');
    Route::post('/update/{user}', 'update')->name('user.update');
    Route::get('/getData/{user}', 'getData')->name('user.get.data');
});
//Actor
Route::prefix('actor')->controller(ActorController::class)->group(function () {
    Route::get('/', 'index')->name('actor.index');
    Route::post('/store', 'store')->name('actor.store');
    Route::get('/get', 'get')->name('actor.get');
    Route::get('/delete/{actor}', 'delete')->name('actor.delete');
    Route::post('/update/{actor}', 'update')->name('actor.update');
    Route::get('/getData/{actor}', 'getData')->name('actor.get.data');
    Route::get('/getBusqueda/{actor}', 'getBusqueda')->name('actor.get.busqueda');
});
//Pelicula
Route::prefix('pelicula')->controller(PeliculaController::class)->group(function () {
    Route::get('/', 'index')->name('pelicula.index');
    Route::post('/store', 'store')->name('pelicula.store');
    Route::get('/get', 'get')->name('pelicula.get');
    Route::get('/delete/{pelicula}', 'delete')->name('pelicula.delete');
    Route::post('/update/{pelicula}', 'update')->name('pelicula.update');
    Route::get('/getData/{pelicula}', 'getData')->name('pelicula.get.data');
    Route::get('/getBusqueda/{pelicula}', 'getBusqueda')->name('pelicula.get.busqueda');
});
//AsignarPeliculas
Route::prefix('asignarPelicula')->controller(AsignarPeliculaController::class)->group(function () {
    Route::post('/store', 'store')->name('asignarPelicula.store');
    Route::get('/get', 'get')->name('asignarPelicula.get');
});
//Roles
Route::prefix('roles')->controller(RolesController::class)->group(function () {
    Route::get('/', 'index')->name('roles.index');
    Route::post('/store', 'store')->name('roles.store');
    Route::get('/get', 'get')->name('roles.get');
    Route::get('/delete/{roles}', 'delete')->name('roles.delete');
    Route::post('/update/{roles}', 'update')->name('roles.update');
    Route::get('/getData/{roles}', 'getData')->name('roles.get.data');
});
//Permisos
Route::prefix('permisos')->controller(PermisosController::class)->group(function () {
    Route::get('/', 'index')->name('permisos.index');
    Route::post('/store', 'store')->name('permisos.store');
    Route::get('/get', 'get')->name('permisos.get');
    Route::get('/delete/{permisos}', 'delete')->name('permisos.delete');
    Route::post('/update/{permisos}', 'update')->name('permisos.update');
    Route::get('/getData/{permisos}', 'getData')->name('permisos.get.data');
});
//Asignar
Route::prefix('asignar')->controller(AsignarController::class)->group(function () {
    Route::get('/', 'index')->name('asignar.index');
    Route::get('/getPermiso/{User}', 'getData')->name('permiso.get.permiso');
    Route::get('/getPermiso/{User}', 'getData')->name('permiso.get.permiso');
    Route::post('/storeRole', 'storeRole')->name('asignar.store.role');
    
});
});