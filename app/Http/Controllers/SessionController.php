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
        ]);
        // dd($users->status());
        if ($users->status() == 200) {
            // dd($users);
            $users= $users->json();
            if (isset( $users['SessionId'])) {
                session_start();
                $_SESSION['B1SESSION'] = $users['SessionId'];
                $_SESSION['ROUTEID']= "node1";
        
        
                return view('Pages.consulta.infoPersonal');
            }else {
                alert()->warning('¡Atencion!','Ingreso fallido.');
                return redirect('/');
            }
        }else {
            alert()->warning('¡Atencion!','Ingreso fallido, por favor verifique su conexión.');
            return redirect('/');
        }
        

        
    }
}
