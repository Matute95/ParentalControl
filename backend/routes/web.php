<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/menu', [App\Http\Controllers\UserController::class,'menu'])->name('menu');
    Route::get('/perfil', [App\Http\Controllers\UserController::class,'perfil'])->name('perfil');
    Route::get('/tokens', [App\Http\Controllers\UserController::class,'tokens'])->name('tokens');
    Route::get('/crearToken', [App\Http\Controllers\UserController::class, 'generarToken'])->name('crearToken');
    Route::get('/dispositivos', [App\Http\Controllers\UserController::class,'dispositivos'])->name('dispositivos');
    Route::get('/plan', [App\Http\Controllers\UserController::class,'plan'])->name('plan');
    Route::get('/success', [App\Http\Controllers\UserController::class,'success'])->name('success');

    Route::post('/crear_hijo', [App\Http\Controllers\UserController::class,'crear_hijo'])->name('crear_hijo');
    Route::post('/plan', [App\Http\Controllers\UserController::class,'checkout'])->name('checkout');
}
);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


