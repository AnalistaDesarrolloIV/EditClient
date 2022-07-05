<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class infoPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.consulta.infoPersonal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        if ($input['tipoIdentificacion'] == 1) { 

            $id = $input['identificacion'];
        
            session_start();
    
            $_SESSION['USER'] = $input['identificacion'];
            $cont = 0;
            do {
                if ($cont <= 5) {
                    $user = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardName,EmailAddress,Phone1,Phone2&$filter=FederalTaxID eq  '."'$id'");
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
    
            if (!isset($user['value']['1'])) {
                alert()->warning('¡Atencion!','Identificacion no existe o tipo de documento incorrecto.');
    
    
                return view('welcome');
            }else{
                $usuario = $user['value']['1'];
                $_SESSION['CODUSER'] = $usuario['CardCode'];
                return view('Pages.consulta.FormEditPerson', compact('usuario'));
            }
        }else { 
            $id = $input['identificacion'];
        
            session_start();
    
            $_SESSION['USER'] = $input['identificacion'];
            $_SESSION['T_USER'] = $input['tipoIdentificacion'];
            $cont = 0;
            do {
                if ($cont <= 5) {
                    $user = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardName,EmailAddress,Phone1,Phone2&$filter=FederalTaxID eq  '."'$id'");
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
    
            if (!isset($user['value']['0'])) {
                alert()->warning('¡Atencion!','Identificacion no existe o tipo de documento incorrecto.');
    
    
                return view('welcome');
            }else{
                $usuario = $user['value']['0'];
                $_SESSION['CODUSER'] = $usuario['CardCode'];
                return view('Pages.consulta.FormEditPerson', compact('usuario'));
            }
        }

       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
