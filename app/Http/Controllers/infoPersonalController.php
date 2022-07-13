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
        
        session_start();
        $tipo_d = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
        ->get('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('TipoDoc')".'/List');
            
        $tipo_d = $tipo_d->json();
        $tipos = $tipo_d['value'];
        return view('Pages.consulta.infoPersonal', compact('tipos'));
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


            $id = $input['identificacion'];
        
            session_start();
    
            $_SESSION['USER'] = $input['identificacion'];
            $_SESSION['T_USER'] = $input['tipoIdentificacion'];
            
            $user = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
            ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardType,CardName,EmailAddress,Phone1,Phone2,AttachmentEntry&$filter=FederalTaxID eq  '."'$id'"." and CardType eq 'cCustomer'");
                    
            $user = $user->json();
            $tipoD = $user['value']['0']['U_HBT_TipDoc'];

            if (!isset($user['value']['0']) || $tipoD !=  $_SESSION['T_USER']) {
                alert()->warning('¡Atencion!','Identificación no existe o tipo de identificación incorrecto.');
    
                return view('welcome');
            }else{
                $usuario = $user['value']['0'];
                $_SESSION['CODUSER'] = $usuario['CardCode'];
                if (isset($usuario['AttachmentEntry'])) {
                    $AttachmentEntry = $usuario['AttachmentEntry'];
                    $doc = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/Attachments2'."($AttachmentEntry)");
                        
                    $doc = $doc->json();
                    $document = $doc['Attachments2_Lines'];
    
                    $tipo_d = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('TipoDoc')".'/List');
                        
                    $tipo_d = $tipo_d->json();
                    $tipos = $tipo_d['value'];
                        
                    return view('Pages.consulta.FormEditPerson', compact('usuario', 'document', 'tipos'));
                }else {
                    $document = null;
    
                    $tipo_d = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('TipoDoc')".'/List');
                        
                    $tipo_d = $tipo_d->json();
                    $tipos = $tipo_d['value'];
                        
                    return view('Pages.consulta.FormEditPerson', compact('usuario', 'document', 'tipos'));
                }
                
            }
        // }

       

    }

}
