<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\infoPersonalController;
use App\Http\Controllers\NaturalController;

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

Route::get('/login', [SessionController::class, 'login'])->name('login');

Route::get('/npersonal', [NaturalController::class, 'infoPersonal'])->name('infoPersonal');
Route::post('/npersonaledit', [NaturalController::class, 'editPersonal'])->name('editPersonal');

Route::get('/ndir', [NaturalController::class, 'infoDirecciones'])->name('infoDirecciones');
Route::get('/ndircreate', [NaturalController::class, 'createDireccion'])->name('createDireccion');
Route::get('/ndiredit/{id}', [NaturalController::class, 'EditDirecciones'])->name('EditDirecciones');

Route::get('/ncont', [NaturalController::class, 'infoContactos'])->name('infoContactos');


Route::resources([
    'info' => infoPersonalController::class,
]);