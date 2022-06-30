<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SessionController extends Controller
{
    public function login ()
    {
        $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
            'CompanyDB' => 'INVERSIONES',
            'UserName' => 'Ecommerce',
            'Password' => '1m3lSlp4w9',
        ])->json();

        
        session_start();
        $_SESSION['B1SESSION'] = $users['SessionId'];


        return view('Pages.consulta.infoPersonal');
    }
}
