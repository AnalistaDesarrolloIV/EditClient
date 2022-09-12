<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\infoPersonalController;
use App\Http\Controllers\NaturalController;
use App\Mail\AceptacionMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

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

Route::get('inicio/{id}', function ($id) {

    // try {
        session_start();
    
        $_SESSION['USER'] = $id;
    
        $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
            'CompanyDB' => 'INVERSIONES',
            'UserName' => 'Ecommerce',
            'Password' => '1m3lSlp4w9',
        ]);
        // dd($users->status());
        if ($users->status() == 200) {
            $users= $users->json();
            // dd($users);
            if (isset( $users['SessionId'])) {
                $_SESSION['B1SESSION'] = $users['SessionId'];
        
                return Redirect()->route('infoPersonal');
                // return view('Pages.consulta.infoPersonal', compact('tipos'));
            }else {
                alert()->warning('¡Atencion!','Ingreso fallido.');
                return Redirect('https://pagos.ivanagro.com/dashboard');
            }
        }else {
            alert()->warning('¡Atencion!','Ingreso fallido, por favor verifique su conexión.');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    // } catch (\Throwable $th) {
    //     Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
    //     return Redirect('https://pagos.ivanagro.com/dashboard');
    // }
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

Route::post('/email', function(Request $request){
    
    $inp = $request->all();
    // dd($inp);
    $remitente = $inp['correo'];
    
    if (isset($inp['aceptacion'])) {
        $correo = new AceptacionMailable;
        Mail::to($remitente)->send($correo);

        alert()->success('Aceptación', 'Correo de aceptación enviado.');
        return redirect()->route('infoPersonal');
    }else {
        alert()->success('Fin', 'Gracias por actualizar su información.');
        return redirect()->route('infoPersonal');
    }

})->name('email');

Route::resources([
    'info' => infoPersonalController::class,
]);