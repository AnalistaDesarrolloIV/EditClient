<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Nette\Utils\Json;
use Illuminate\Support\Facades\Storage;

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
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardName,EmailAddress,Phone1,Phone2,AttachmentEntry&$filter=FederalTaxID eq '."'$id'");
                    $cont += 1;
                } else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
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
            $_SESSION['CODUSER'] = $usuario['CardCode'];
    
            return view('Pages.consulta.FormEditPerson', compact('usuario'));
        } else {

            $id = $_SESSION['USER'];
            $cont = 0;
            do {
                if ($cont <= 5) {
                    $user = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardName,EmailAddress,Phone1,Phone2,AttachmentEntry&$filter=FederalTaxID eq '."'$id'");
                    $cont += 1;
                } else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
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
            $_SESSION['CODUSER'] = $usuario['CardCode'];
    
            return view('Pages.consulta.FormEditPerson', compact('usuario'));
        }
        
    }

    public function editPersonal(Request $request)
    {
        $input = $request->all();
        session_start();
        $id = $_SESSION['CODUSER'];
        if (isset($input['IdentificacionArch'])) {
            if (isset($input['AttachmentEntry'])) {
                $AttachmentEntry = $input['AttachmentEntry'];
                // dd($AttachmentEntry);
                $arch = $request->file('IdentificacionArch');
                $nombre =  time()."-".$_SESSION['CODUSER']."-".$arch->getClientOriginalName();
                // Storage::disk('ftp')->put($nombre.'/', \File::get($arch));
                $ruta = url('')."/docs/";
                do {
                    $doc = Http::withToken($_SESSION['B1SESSION'])
                    ->patch('https://10.170.20.95:50000/b1s/v1/Attachments2'."($AttachmentEntry)", [
                        'Attachments2_Lines'=> [[
                                'FileName'=> $nombre,
                                'SourcePath'=> "C:\Users\juan.atehortua\Desktop\ensayos\EditDates\public\docs"
                            ]]
                    ]);
                } while (!$doc->json() == null);
                $id_doc = $AttachmentEntry;

            }else {
                $arch = $request->file('IdentificacionArch');
                $nombre = $_SESSION['CODUSER']."-".$arch->getClientOriginalName();
                $arch->move(public_path().'/docs/', $nombre);
                $ruta = url('')."/docs/";
                do {
                    $doc = Http::withToken($_SESSION['B1SESSION'])
                    ->post('https://10.170.20.95:50000/b1s/v1/Attachments2', [
                        'Attachments2_Lines'=> [[
                                'FileName'=> $nombre,
                                'SourcePath'=> "C:\Users\juan.atehortua\Desktop\ensayos\EditDates\public\docs"
                            ]]
                    ]);
                } while ($doc->clientError());
                $document = $doc->json();
                $id_doc = $document['AbsoluteEntry'];
            }
            do {
                $insert = Http::withToken($_SESSION['B1SESSION'])
                ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'."('$id')", [
                    'CardCode'=> $input['CardCode'],
                    'U_HBT_TipDoc'=> $input['U_HBT_TipDoc'],
                    'FederalTaxID'=> $input['FederalTaxID'],
                    'CardName'=> $input['CardName'],
                    'Phone1'=> $input['Phone1'],
                    'Phone2'=> $input['Phone2'],
                    'AttachmentEntry' => $id_doc,
                    'EmailAddress' => $input['EmailAddress'],
                ])->json();
            
        } while (!$insert == null);
        }else{
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
        }
        
        alert()->success('Usuario','Usuario editado exitosamente.');
        return Redirect('/npersonal');

    }

// ------------------------------------------DIRECCIONES--------------------------------------------------------------

    public function infoDirecciones()
    {
        
        session_start();
        $id = $_SESSION['CODUSER'];
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
                    if (isset( $users['SessionId'])) {
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


        return view('Pages.consulta.listDirreccion', compact('direccion'));
    }

    public function createDireccion()
    {
        
        session_start();
        do {
            $dep = Http::withToken($_SESSION['B1SESSION'])->
            post('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('Municipios2')".'/List');
        } while ($dep->clientError());

       
        $dep = $dep['value'];
        // dd($dep);
        
        do {
            $postal = Http::withToken($_SESSION['B1SESSION'])->
            post('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('CodigoPostales')".'/List');
        } while ($postal->clientError());
        $postal = $postal['value'];
        
        return view('Pages.consulta.createDireccion', compact('dep', 'postal'));
    }

    public function storeDireccion(Request $request)
    {
        $input = $request->all();
        // dd($input);
        session_start();
        do {
            $dep = Http::withToken($_SESSION['B1SESSION'])->
            post('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('Municipios2')".'/List');
        } while ($dep->clientError());

       
        $dep = $dep['value'];
        foreach ($dep as $key => $value) {
            if ($dep[$key]['Code'] == $input['Ciudad'] ) {
                $ciudad_name = $dep[$key]['Name'];
            }
        }
        
        $id = $_SESSION['CODUSER'];
        $AddressName= strtoupper($input['Nombre_Direccion']);
        $Block= strtoupper($input['Barrio_Vereda_Corregimiento']);

        do {
            $create = Http::withToken($_SESSION['B1SESSION'])->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'."('$id')".'?$select=BPAddresses', [
                'BPAddresses'=> [
                    [   
                        "AddressName"=> $AddressName,
                        "Street"=> $input['Direccion_fisica'],
                        "Block"=> $Block,
                        "ZipCode"=> $input['Ciudad'],
                        "City"=> $ciudad_name,
                        "County"=> $input['Departamento'],
                        "State"=> "001",
                        "AddressType" => $input['AddressType'],
                        "BPCode"=> $_SESSION['CODUSER'],
                        "FederalTaxID"=> $_SESSION['USER'],
                        "U_HBT_MunMed"=> $input['Codigo_Postal']
                    ]
                ],
            ]);
        } while (!$create->json() == null);
        
        // dd($create->json());
            alert()->success('Dirección','Dirección creada exitosamente.');
        return Redirect('/ndir');
    }


    public function EditDirecciones($id)
    {
        session_start();
        $codigo = $_SESSION['CODUSER'];
        $cont=0;
        do {
            do {
                if ($cont <= 5) {
                    $dir = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/sml.svc/DIRECCIONES?$filter=Codigo_Cliente eq '."'$codigo'"."and LineNum eq "."'$id'");
                    $cont += 1;
                } else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
                    if (isset( $users['SessionId'])) {
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
        $dire = $dir['value'][0];
        // dd($dire);
        do {
            $dep = Http::withToken($_SESSION['B1SESSION'])->
            post('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('Municipios2')".'/List');
        } while ($dep->clientError());

        $dep = $dep['value'];
        
        do {
            $postal = Http::withToken($_SESSION['B1SESSION'])->
            post('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('CodigoPostales')".'/List');
        } while ($postal->clientError());
        $postal = $postal['value'];
        
        return view('Pages.consulta.FormDireccion', compact('dire', 'dep', 'postal'));
    }

    public function updateDirecciones(Request $request, $id)
    {
        $input = $request->all();
        // dd($input);
        session_start(); 
        do {
            $dep = Http::withToken($_SESSION['B1SESSION'])->
            post('https://10.170.20.95:50000/b1s/v1/SQLQueries'."('Municipios2')".'/List');
        } while ($dep->clientError());

       
        $dep = $dep['value'];
        foreach ($dep as $key => $value) {
            if ($dep[$key]['Code'] == $input['Ciudad'] ) {
                $ciudad_name = $dep[$key]['Name'];
            }
        }
        // dd($ciudad_name);

        $cod = $_SESSION['CODUSER'];
        $AddressName= strtoupper($input['Nombre_Direccion']);
        $Block= strtoupper($input['Barrio_Vereda_Corregimiento']);

        do {
            $update = Http::withToken($_SESSION['B1SESSION'])->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'."('$cod')".'?$select=BPAddresses', [
                'BPAddresses'=> [
                    [   
                        "AddressName"=> $AddressName,
                        "Street"=> $input['Direccion_fisica'],
                        "Block"=> $Block,
                        "ZipCode"=> $input['Ciudad'],
                        "City"=> $ciudad_name,
                        "County"=> $input['Departamento'],
                        "State"=> "001",
                        "AddressType" => $input['AddressType'],
                        "BPCode"=> $_SESSION['CODUSER'],
                        "FederalTaxID"=> $_SESSION['USER'],
                        "RowNum"=> $id,
                        "U_HBT_MunMed"=> $input['Codigo_Postal']
                    ]
                ],
            ]);
        } while (!$update->json() == null);
        
        // dd($update->json());
            alert()->success('Dirección','Dirección Editada exitosamente.');
        return Redirect('/ndir');
    }


// -------------------------------------------CONTACTOS---------------------------------------------------------------


    public function infoContactos()
    {
        
        session_start();
        $id = $_SESSION['CODUSER'];
        $cont = 0;
        do {
            do {
                if ($cont <= 5) {
                    $contact = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners'."('$id')".'?$select=ContactEmployees');
                    $cont = $cont + 1;
                } else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
                    if (isset( $users['SessionId'])) {
                        $_SESSION['B1SESSION'] = $users['SessionId'];
                    }else {
                        alert()->warning('¡Atencion!','Ingreso fallido.');
                        return redirect('/');
                    }
                    $cont = 0;
                }
            } while ($contact->clientError());
            $contact = $contact->json();
        } while ($contact == null);
        $contactos= $contact['ContactEmployees'];
        // $contactos = $cont['value'];

        return view('Pages.consulta.listContactos', compact('contactos'));
    }

    public function createContacto()
    {
        return view('Pages.consulta.createContacto');
    }

    public function storeContacto(Request $request)
    {
        $input = $request->all();
        
        session_start();
        $id = $_SESSION['CODUSER'];

        $contador = 0;
        
        if ($input['Name'] == "Comercial") {
            $con = 0;
            do {
                if ($con <= 5) {
                    $contact = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners'. "('$id')".'?$select=ContactEmployees');
                    $con += 1;
                }else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
                    if (isset( $users['SessionId'])) {
                        $_SESSION['B1SESSION'] = $users['SessionId'];
                    }else {
                        alert()->warning('¡Atencion!','Ingreso fallido.');
                        return redirect('/');
                    }
                    $con = 0;
                }
            } while ($contact->clientError());
            $contact = $contact->json();
            $contact = $contact['ContactEmployees'];
            $ccont = 1;
            $com = $input['Name'];
            foreach ($contact as $key => $value) {
                if ($contact[$key]['Name'] == $com) {
                    $com = $input['Name'];
                    $com = strtoupper($com.$ccont);
                    $ccont= $ccont+1;
                }
            }
            do {
                do {
                    if ($contador <= 5) {
                    if (isset($input['Ext2']) && isset($input['Phone2'])) {
                        $insertCont = Http::withToken($_SESSION['B1SESSION'])
                        ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'. "('$id')".'?$select=ContactEmployees', [
                            'ContactEmployees'=> [[
                                    'Name'=> $com,
                                    'FirstName'=> $input['FirstName'],
                                    'MiddleName'=>  $input['MiddleName'],
                                    'LastName'=>  $input['LastName'],
                                    'Phone1'=>  "( ".$input['Ext1']." )- ".$input['Phone1'],
                                    'Phone2'=> "( ".$input['Ext2']." )- ". $input['Phone2'],
                                    'MobilePhone'=>  $input['MobilePhone'],
                                    'E_Mail' =>  $input['E_Mail'],
                                    'Profession'=>  $input['Profession']
                            ]]
                        ]);
                    }else {
                        $insertCont = Http::withToken($_SESSION['B1SESSION'])
                        ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'. "('$id')".'?$select=ContactEmployees', [
                            'ContactEmployees'=> [[
                                    'Name'=> $com,
                                    'FirstName'=> $input['FirstName'],
                                    'MiddleName'=>  $input['MiddleName'],
                                    'LastName'=>  $input['LastName'],
                                    'Phone1'=>  "( ".$input['Ext1']." )- ".$input['Phone1'],
                                    'Phone2'=> '',
                                    'MobilePhone'=>  $input['MobilePhone'],
                                    'E_Mail' =>  $input['E_Mail'],
                                    'Profession'=>  $input['Profession']
                            ]]
                        ]);
                    }
                    $contador += 1;
                    }else {
                        
                        alert()->error('Contacto','No se pudo registrar el contacto.');
                        // $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        //     'CompanyDB' => 'INVERSIONES0804',
                        //     'UserName' => 'Prueba',
                        //     'Password' => '1234',
                        // ])->json();
                        // if (isset( $users['SessionId'])) {
                        //     $_SESSION['B1SESSION'] = $users['SessionId'];
                        // }else {
                        //     alert()->warning('¡Atencion!','Ingreso fallido.');
                        //     return redirect('/');
                        // }
                        $contador = 0;
                    }
                } while ($insertCont->clientError());
                $insertCont = $insertCont->json();
            } while (!$insertCont == null);
            
            alert()->success('Contacto','Contacto creado exitosamente.');
            return Redirect('/ncont');
        }else{
            $con = 0;
            do {
                if ($con <= 5) {
                    $contact = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners'. "('$id')".'?$select=ContactEmployees');
                    $con += 1;
                }else {
                    $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        'CompanyDB' => 'INVERSIONES0804',
                        'UserName' => 'Prueba',
                        'Password' => '1234',
                    ])->json();
                    if (isset( $users['SessionId'])) {
                        $_SESSION['B1SESSION'] = $users['SessionId'];
                    }else {
                        alert()->warning('¡Atencion!','Ingreso fallido.');
                        return redirect('/');
                    }
                    $con = 0;
                }
            } while ($contact->clientError());
            $contact = $contact->json();
            $contact = $contact['ContactEmployees'];
            $ccont = 0;
            $com = strtoupper($input['Name']);
            foreach ($contact as $key => $value) {
                if ($contact[$key]['Name'] == $com) {
                    alert()->error('¡Atencion!','Tipo de contacto ya creado.');
                    return Redirect('/ncontcreate');
                }
            }
            do {
                do {
                    if ($contador <= 5) {
                        if (isset($input['Ext2']) && isset($input['Phone2'])) {
                            $insertCont = Http::withToken($_SESSION['B1SESSION'])
                            ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'. "('$id')".'?$select=ContactEmployees', [
                                'ContactEmployees'=> [[
                                        'Name'=> $com,
                                        'FirstName'=> $input['FirstName'],
                                        'MiddleName'=>  $input['MiddleName'],
                                        'LastName'=>  $input['LastName'],
                                        'Phone1'=>  "( ".$input['Ext1']." )- ".$input['Phone1'],
                                        'Phone2'=> "( ".$input['Ext2']." )- ". $input['Phone2'],
                                        'MobilePhone'=>  $input['MobilePhone'],
                                        'E_Mail' =>  $input['E_Mail'],
                                        'Profession'=>  $input['Profession']
                                ]]
                            ]);
                        }else {
                            $insertCont = Http::withToken($_SESSION['B1SESSION'])
                            ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'. "('$id')".'?$select=ContactEmployees', [
                                'ContactEmployees'=> [[
                                        'Name'=> $com,
                                        'FirstName'=> $input['FirstName'],
                                        'MiddleName'=>  $input['MiddleName'],
                                        'LastName'=>  $input['LastName'],
                                        'Phone1'=>  "( ".$input['Ext1']." ) ".$input['Phone1'],
                                        'Phone2'=> '',
                                        'MobilePhone'=>  $input['MobilePhone'],
                                        'E_Mail' =>  $input['E_Mail'],
                                        'Profession'=>  $input['Profession']
                                ]]
                            ]);
                        }
                        $contador += 1;
                    }else {
                        
                        alert()->error('Contacto','No se pudo registrar el contacto.');
                        // $users = Http::post('https://10.170.20.95:50000/b1s/v1/Login',[
                        //     'CompanyDB' => 'INVERSIONES0804',
                        //     'UserName' => 'Prueba',
                        //     'Password' => '1234',
                        // ])->json();
                        // if (isset( $users['SessionId'])) {
                        //     $_SESSION['B1SESSION'] = $users['SessionId'];
                        // }else {
                        //     alert()->warning('¡Atencion!','Ingreso fallido.');
                        //     return redirect('/');
                        // }
                        $contador = 0;
                    }
                } while ($insertCont->clientError());
                $insertCont = $insertCont->json();
            } while (!$insertCont == null);
    
            alert()->success('Contacto','Contacto creado exitosamente.');
            return Redirect('/ncont');
        }

 
    }


    public function EditContacto($name)
    {
        session_start();
        $cod = $_SESSION['CODUSER'];
        $cont = 0;
        do {
            do {
                if ($cont <= 5) {
                    $contact = Http::withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners'."('$cod')".'?$select=ContactEmployees');
                    $cont = $cont + 1;
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
            } while ($contact->clientError());
            $contact = $contact->json();
        } while ($contact == null);
        $contactos= $contact['ContactEmployees'];
        // dd($contact);
        
        foreach ($contactos as $key => $value) {
            if ($contactos[$key]['Name'] == $name) {
                $contacto = $contactos[$key];
            }
        }
        
        return view('Pages.consulta.FormContacto',compact('contacto'));
    }

    public function updateContacto(Request $request, $id)
    {
        $input = $request->all();
        // dd($input);
        session_start();
        
        $cod = $_SESSION['CODUSER'];
        $Name= strtoupper($input['Name']);
        $FirstName= strtoupper($input['FirstName']);
        $MiddleName= strtoupper($input['MiddleName']);
        $LastName=  strtoupper($input['LastName']);
        $Profession= strtoupper($input['Profession']);

        do {
            $update = Http::withToken($_SESSION['B1SESSION'])->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners'."('$cod')", [
                    "ContactEmployees"=> [
                        [
                            "InternalCode"=> $id,
                            "CardCode"=> $cod,
                            "Name"=> $Name,
                            "FirstName"=> $FirstName,
                            "MiddleName"=> $MiddleName,
                            "LastName"=>  $LastName,
                            "Phone1"=>  "( ".$input['Ext1']." )- ".$input['Phone1'],
                            "Phone2"=> "( ".$input['Ext2']." )- ". $input['Phone2'],
                            "MobilePhone"=> $input['MobilePhone'],
                            "E_Mail"=> $input['E_Mail'],
                            "Profession"=> $Profession
                        ]
                    ]   
            ]);
        } while (!$update->json() == null);
        
        alert()->success('Contacto','Contacto editado exitosamente.');
        return Redirect('/ncont');
    }
}

