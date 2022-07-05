<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SessionController extends Controller
{
    public function login ()
    {
        $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
            'CompanyDB' => 'INVERSIONES0804',
            'UserName' => 'Prueba',
            'Password' => '1234',
        ])->json();
        // dd($users);
        if (isset( $users['SessionId'])) {
            session_start();
            $_SESSION['B1SESSION'] = $users['SessionId'];
    
    
            return view('Pages.consulta.infoPersonal');
        }else {
            alert()->warning('¡Atencion!','Ingreso fallido.');
            return redirect('/');
        }

        
    }
}
