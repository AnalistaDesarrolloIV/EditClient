<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\infoPersonalController;
use App\Http\Controllers\NaturalController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

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

    $id = '70550700';
    session_start();

    $_SESSION['USER'] = $id;

    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
        'CompanyDB' => 'INVERSIONES0804',
        'UserName' => 'Prueba',
        'Password' => '1234',
    ]);
    // dd($users->status());
    if ($users->status() == 200) {
        $users= $users->json();
        // dd($users);
        if (isset( $users['SessionId'])) {
            $_SESSION['B1SESSION'] = $users['SessionId'];
    
            $tipo_d = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
            ->get('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('TipoDoc')".'/List');
                
            $tipo_d = $tipo_d->json();
            $tipos = $tipo_d['value'];
            return Redirect('/npersonal');
            // return view('Pages.consulta.infoPersonal', compact('tipos'));
        }else {
            alert()->warning('¡Atencion!','Ingreso fallido.');
            return redirect('/');
        }
    }else {
        alert()->warning('¡Atencion!','Ingreso fallido, por favor verifique su conexión.');
        return redirect('/');
    }
    // return view('welcome');
});

Route::get('/login', [SessionController::class, 'login'])->name('login');

Route::get('/npersonal', [NaturalController::class, 'infoPersonal'])->name('infoPersonal');
Route::post('/npersonaledit', [NaturalController::class, 'editPersonal'])->name('editPersonal');

Route::get('/ndir', [NaturalController::class, 'infoDirecciones'])->name('infoDirecciones');
Route::get('/ndircreate', [NaturalController::class, 'createDireccion'])->name('createDireccion');
Route::post('/storeDireccion', [NaturalController::class, 'storeDireccion'])->name('storeDireccion');
Route::get('/ndiredit/{id}', [NaturalController::class, 'EditDirecciones'])->name('EditDirecciones');
Route::get('/ndirupdate/{id}', [NaturalController::class, 'updateDirecciones'])->name('updateDirecciones');

Route::get('/ncont', [NaturalController::class, 'infoContactos'])->name('infoContactos');
Route::get('/ncontcreate', [NaturalController::class, 'createContacto'])->name('createContacto');
Route::post('/storeContacto', [NaturalController::class, 'storeContacto'])->name('storeContacto');
Route::get('/ncontedit/{name}', [NaturalController::class, 'EditContacto'])->name('EditContacto');
Route::post('/ncontupdate/{name}', [NaturalController::class, 'updateContacto'])->name('updateContacto');



Route::resources([
    'info' => infoPersonalController::class,
]);