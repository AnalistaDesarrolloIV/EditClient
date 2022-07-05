<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Nette\Utils\Json;

class NaturalController extends Controller
{

    // --------------------------------------INFORMACION PERSONAL---------------------------------------------------------
    public function infoPersonal()
    {
        
        session_start();
        $t_user = $_SESSION['T_USER'];

        if ($t_user == 1) {

            $id = $_SESSION['USER'];
            $cont = 0;
            do {
                if ($cont <= 5) {
                    $user = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardName,EmailAddress,Phone1,Phone2&$filter=FederalTaxID eq '."'$id'");
                    $cont += 1;
                } else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
                    // dd($users);
                    if (isset( $users['SessionId'])) {
                        $_SESSION['B1SESSION'] = $users['SessionId'];
                    }else {
                        alert()->warning('¡Atencion!','Ingreso fallido.');
                        return redirect('/');
                    }
                    $cont = 0;
                }
                
            } while ($user->clientError());
            $user = $user->json();
            $usuario = $user['value']['1'];
            // dd($usuario);
            $_SESSION['CODUSER'] = $usuario['CardCode'];
    
            return view('Pages.consulta.FormEditPerson', compact('usuario'));
        } else {

            $id = $_SESSION['USER'];
            $cont = 0;
            do {
                if ($cont <= 5) {
                    $user = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardName,EmailAddress,Phone1,Phone2&$filter=FederalTaxID eq '."'$id'");
                    $cont += 1;
                } else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
                    // dd($users);
                    if (isset( $users['SessionId'])) {
                        $_SESSION['B1SESSION'] = $users['SessionId'];
                    }else {
                        alert()->warning('¡Atencion!','Ingreso fallido.');
                        return redirect('/');
                    }
                    $cont = 0;
                }
                
            } while ($user->clientError());
            $user = $user->json();
            $usuario = $user['value']['0'];
            // dd($usuario);
            $_SESSION['CODUSER'] = $usuario['CardCode'];
    
            return view('Pages.consulta.FormEditPerson', compact('usuario'));
        }
        
    }

    public function editPersonal(Request $request)
    {
        $input = $request->all();
        // dd($input);
        session_start();
        $id = $_SESSION['CODUSER'];
        // dd($_SESSION['B1SESSION']);
        do {
            $insert = Http::withToken($_SESSION['B1SESSION'])
            ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'."('$id')", [
                
                    'CardCode'=> $input['CardCode'],
                    'U_HBT_TipDoc'=> $input['U_HBT_TipDoc'],
                    'FederalTaxID'=> $input['FederalTaxID'],
                    'CardName'=> $input['CardName'],
                    'Phone1'=> $input['Phone1'],
                    'Phone2'=> $input['Phone2'],
                    'EmailAddress' => $input['EmailAddress'],
            ])->json();
        } while (!$insert == null);
        // dd($insert);
        return Redirect('/npersonal');

    }


    // -----------------------------------------------DIRECCIONES------------------------------------------------------

    public function infoDirecciones()
    {
        
        session_start();
        $id = $_SESSION['CODUSER'];
        // dd($id);
        $cont = 0;
        do {
            do {
                if ($cont <= 5) {
                    $dir = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/sml.svc/DIRECCIONES?$filter = Codigo_Cliente eq '."'$id'");
                    $cont += 1;
                } else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
                    // dd($users);
                    if (isset( $users['SessionId'])) {
                        session_start();
                        $_SESSION['B1SESSION'] = $users['SessionId'];
                    }else {
                        alert()->warning('¡Atencion!','Ingreso fallido.');
                        return redirect('/');
                    }
                    $cont = 0;
            
                }
                
            } while ($dir->clientError());
            $dir = $dir->json();
        } while ($dir == null);
        $direccion = $dir['value'];
        // dd($direccion);


        return view('Pages.consulta.listDirreccion', compact('direccion'));
    }

    public function createDireccion()
    {
        
        $dep = Http::get('https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.json')->json();
        return view('Pages.consulta.createDireccion', compact('dep'));
    }


    public function EditDirecciones($id)
    {
        // dd($id);

        session_start();
        $codigo = $_SESSION['CODUSER'];
        // dd($id);
        do {
            do {
                $dir = Http::withToken($_SESSION['B1SESSION'])
                ->get('https://10.170.20.95:50000/b1s/v1/sml.svc/DIRECCIONES?$filter = Codigo_Cliente eq '."'$codigo'");
            } while ($dir->clientError());
            $dir = $dir->json();
        } while ($dir == null);
        $direccion = $dir['value'];
        foreach ($direccion as $key => $value) {
            if ($direccion[$key]['id__'] == $id) {
                $dire = $direccion[$key];
            }
        }
        
        $dep = Http::get('https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.json')->json();
        // dd($dep[0]['departamento']);
        // $departamento = [''];
        // foreach ($dep as $key => $value) {
        //     if ($departamento != $dep[$key]['region']) {
        //         $departamento = $dep[$key]['region'];
        //     }
        // }
        return view('Pages.consulta.FormDireccion', compact('dire', 'dep'));
    }


// ----------------------------------------------------------CONTACTOS-------------------------------------------------------------


    public function infoContactos()
    {
        
        session_start();
        $id = $_SESSION['CODUSER'];
        // dd($id);
        do {
            do {
                $dir = Http::withToken($_SESSION['B1SESSION'])
                ->get('https://10.170.20.95:50000/b1s/v1/sml.svc/DIRECCIONES?$filter = Codigo_Cliente eq '."'$id'");
            } while ($dir->clientError());
            $dir = $dir->json();
        } while ($dir == null);
        $direccion = $dir['value'];
        // dd($direccion);

        return view('Pages.consulta.listContactos', compact('direccion'));
    }
}
