<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeDireccion;
use App\Http\Requests\storeContactos;
use App\Http\Requests\editPersonal;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\Redirect;
use Nette\Utils\Json;
use Illuminate\Support\Facades\Storage;
use PHPUnit\TextUI\XmlConfiguration\MoveWhitelistExcludesToCoverage;
use RealRashid\SweetAlert\Facades\Alert;

class NaturalController extends Controller
{
    // --------------------------------------INFORMACION PERSONAL---------------------------------------------------------
    public function infoPersonal()
    {

        try {
            session_start();
            $id = $_SESSION['USER'];

            $user = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardType,CardName,EmailAddress,Phone1,Phone2,AttachmentEntry,FreeText,Website&$filter=FederalTaxID eq  ' . "'$id'" . " and CardType eq 'cCustomer'");

            $user = $user->json();
            // dd($user);
            $usuario = $user['value']['0'];
            $_SESSION['CODUSER'] = $usuario['CardCode'];
            if (isset($usuario['AttachmentEntry'])) {
                $AttachmentEntry = $usuario['AttachmentEntry'];

                $doc = Http::retry(20, 300)->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/Attachments2' . "($AttachmentEntry)");
                $doc = $doc->json();
                $document = $doc['Attachments2_Lines'];

                $tipo_d = Http::retry(20, 300)->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('TipoDoc')" . '/List');
                $tipo_d = $tipo_d->json();
                $tipos = $tipo_d['value'];

                return view('Pages.consulta.FormEditPerson', compact('usuario', 'document', 'tipos'));
            } else {

                $document = null;

                $tipo_d = Http::retry(20, 300)->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('TipoDoc')" . '/List');
                $tipo_d = $tipo_d->json();
                $tipos = $tipo_d['value'];

                return view('Pages.consulta.FormEditPerson', compact('usuario', 'document', 'tipos'));
            }
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    public function editPersonal(editPersonal $request)
    {
        try {
            $input = $request->all();
            session_start();
            $id = $_SESSION['CODUSER'];
            $user_id = $_SESSION['USER'];
            $correos_com = $input['comerciales'];
            $comerciales = "";
            foreach ($correos_com as $key => $value) {
                if ($correos_com[$key] != null) {
                    $comerciales = $comerciales . "; " . $correos_com[$key];
                }
            }
            $comerciales = substr($comerciales, 2);
            $coment = mb_strtoupper($input['coments'], 'UTF-8');
            if (isset($input['Archivos'])) {
                $archivos = $input['Archivos'];

                foreach ($archivos as $key => $value) {
                    $arch = $value;
                    $nombreArch =  time() . "-" . $_SESSION['CODUSER'] . "-" . $arch->getClientOriginalName();
                    // $g = Storage::disk('public')->put("docs", $arch);
                    // dd($g);
                    // $arch->storage(public_path().'/docs', $nombreArch);  
                    $url = url('') . 'storage/docs';
                    $g = move_uploaded_file($arch, "//10.170.20.124/SAP-compartida/Carpeta_anexos/$nombreArch");
                    // dd($g);

                    $user = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                        ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardType,CardName,EmailAddress,Phone1,Phone2,AttachmentEntry,FreeText,Website&$filter=FederalTaxID eq ' . "'$user_id'" . " and CardType eq 'cCustomer'");
                    $user = $user['value'][0];

                    if (!isset($user['AttachmentEntry'])) {
                        $doc = Http::retry(20, 300)->withToken($_SESSION['B1SESSION'])
                            ->post('https://10.170.20.95:50000/b1s/v1/Attachments2', [
                                'Attachments2_Lines' => [[
                                    'FileName' => $nombreArch,
                                    'SourcePath' =>  "$url"
                                ]]
                            ]);
                        $document = $doc->json();
                        $id_doc = $document['AbsoluteEntry'];
                    } else {
                        $AttachmentEntry = $user['AttachmentEntry'];
                        $doc = Http::retry(20, 300)->withToken($_SESSION['B1SESSION'])
                            ->patch('https://10.170.20.95:50000/b1s/v1/Attachments2' . "($AttachmentEntry)", [
                                'Attachments2_Lines' => [[
                                    'FileName' => $nombreArch,
                                    'SourcePath' => "$url"
                                ]]
                            ]);
                        $id_doc = $AttachmentEntry;
                    }
                    do {
                        $insert = Http::withToken($_SESSION['B1SESSION'])
                            ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')", [
                                'CardCode' => $input['CardCode'],
                                'U_HBT_TipDoc' => $input['U_HBT_TipDoc'],
                                'FederalTaxID' => $input['FederalTaxID'],
                                'CardName' => $input['CardName'],
                                'Phone1' => $input['Phone1'],
                                'Phone2' => $input['Phone2'],
                                'AttachmentEntry' => $id_doc,
                                'Website' => $comerciales,
                                'EmailAddress' => $input['EmailAddress'],
                                'FreeText' => $coment
                            ])->json();
                    } while (!$insert == null);
                }
            } else {
                do {
                    $insert = Http::withToken($_SESSION['B1SESSION'])
                        ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')", [
                            'CardCode' => $input['CardCode'],
                            'U_HBT_TipDoc' => $input['U_HBT_TipDoc'],
                            'FederalTaxID' => $input['FederalTaxID'],
                            'CardName' => $input['CardName'],
                            'Phone1' => $input['Phone1'],
                            'Phone2' => $input['Phone2'],
                            'Website' => $comerciales,
                            'EmailAddress' => $input['EmailAddress'],
                            'FreeText' => $coment
                        ])->json();
                } while (!$insert == null);
            }

            alert()->success('Usuario', 'Usuario editado exitosamente.');
            return Redirect()->route('infoDirecciones');
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    // ------------------------------------------DIRECCIONES--------------------------------------------------------------

    public function infoDirecciones()
    {
        try {
            session_start();
            $id = $_SESSION['CODUSER'];

            $dir = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                ->get('https://10.170.20.95:50000/b1s/v1/sml.svc/DIRECCIONES?$filter = Codigo_Cliente eq ' . "'$id'");

            $dir = $dir->json();
            $direccion = $dir['value'];

            return view('Pages.consulta.listDirreccion', compact('direccion'));
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    public function createDireccion()
    {
        try {
            session_start();
            $dep = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])->post('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('Municipios2')" . '/List');

            $dep = $dep['value'];
            // dd($dep);

            $postal = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])->post('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('CodigoPostales')" . '/List');

            $postal = $postal['value'];

            return view('Pages.consulta.createDireccion', compact('dep', 'postal'));
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    public function storeDireccion(storeDireccion $request)
    {
        try {
            $input = $request->all();
            // dd($input);
            session_start();
            $dep = Http::retry('20,300')->withToken($_SESSION['B1SESSION'])->post('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('Municipios2')" . '/List');


            $dep = $dep['value'];
            foreach ($dep as $key => $value) {
                if ($dep[$key]['Code'] == $input['Ciudad']) {
                    $ciudad_name = $dep[$key]['Name'];
                }
            }

            $id = $_SESSION['CODUSER'];
            $AddressName = mb_strtoupper($input['Nombre_Direccion'], 'UTF-8');
            $Block = mb_strtoupper($input['Barrio_Vereda_Corregimiento'], 'UTF-8');

            $create = Http::retry('20, 300')->withToken($_SESSION['B1SESSION'])->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')" . '?$select=BPAddresses', [
                'BPAddresses' => [
                    [
                        "AddressName" => $AddressName,
                        "Street" => $input['Direccion_fisica'],
                        "Block" => $Block,
                        "U_HBT_MunMed" => $input['Ciudad'],
                        "City" => $ciudad_name,
                        "County" => $input['Departamento'],
                        "State" => "001",
                        "AddressType" => $input['AddressType'],
                        "BPCode" => $_SESSION['CODUSER'],
                        "FederalTaxID" => $_SESSION['USER'],
                        "ZipCode" => $input['Codigo_Postal']
                    ]
                ],
            ]);

            alert()->success('Dirección', 'Dirección creada exitosamente.');
            return Redirect()->route('infoDirecciones');
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }


    public function EditDirecciones($id)
    {
        try {
            session_start();
            $codigo = $_SESSION['CODUSER'];

            $dir = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                ->get('https://10.170.20.95:50000/b1s/v1/sml.svc/DIRECCIONES?$filter=Codigo_Cliente eq ' . "'$codigo'" . "and LineNum eq " . "'$id'");

            $dir = $dir->json();
            $dire = $dir['value'][0];

            $dep = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])->post('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('Municipios2')" . '/List');

            $dep = $dep['value'];

            $postal = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])->post('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('CodigoPostales')" . '/List');

            $postal = $postal['value'];

            return view('Pages.consulta.FormDireccion', compact('dire', 'dep', 'postal'));
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    public function updateDirecciones(storeDireccion $request, $id)
    {
        try {
            $input = $request->all();
            // dd($input);
            session_start();
            $dep = Http::retry('20, 300')->withToken($_SESSION['B1SESSION'])->post('https://10.170.20.95:50000/b1s/v1/SQLQueries' . "('Municipios2')" . '/List');


            $dep = $dep['value'];
            foreach ($dep as $key => $value) {
                if ($dep[$key]['Code'] == $input['Ciudad']) {
                    $ciudad_name = $dep[$key]['Name'];
                }
            }
            // dd($ciudad_name);

            $cod = $_SESSION['CODUSER'];
            $AddressName = mb_strtoupper($input['Nombre_Direccion'], 'UTF-8');
            $Block = mb_strtoupper($input['Barrio_Vereda_Corregimiento'], 'UTF-8');

            $update = Http::retry('20, 300')->withToken($_SESSION['B1SESSION'])->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$cod')" . '?$select=BPAddresses', [
                'BPAddresses' => [
                    [
                        "AddressName" => $AddressName,
                        "Street" => $input['Direccion_fisica'],
                        "Block" => $Block,
                        "U_HBT_MunMed" => $input['Ciudad'],
                        "City" => $ciudad_name,
                        "County" => $input['Departamento'],
                        "State" => "001",
                        "AddressType" => $input['AddressType'],
                        "BPCode" => $_SESSION['CODUSER'],
                        "FederalTaxID" => $_SESSION['USER'],
                        "RowNum" => $id,
                        "ZipCode" => $input['Codigo_Postal']
                    ]
                ],
            ]);

            // dd($update->json());
            alert()->success('Dirección', 'Dirección Editada exitosamente.');
            return Redirect()->route('infoDirecciones');
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }


    // -------------------------------------------CONTACTOS---------------------------------------------------------------


    public function infoContactos()
    {
        try {
            session_start();
            $id = $_SESSION['CODUSER'];

            $contact = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')" . '?$select=ContactEmployees');

            $contact = $contact->json();
            $contactos = $contact['ContactEmployees'];
            // $contactos = $cont['value'];

            return view('Pages.consulta.ListContactos', compact('contactos'));
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    public function createContacto()
    {
        return view('Pages.consulta.createContacto');
    }

    public function storeContacto(storeContactos $request)
    {
        try {
            $input = $request->all();

            session_start();
            $id = $_SESSION['CODUSER'];

            if ($input['Name'] == "Comercial") {

                $contact = Http::retry('20, 300')->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')" . '?$select=ContactEmployees');

                $contact = $contact->json();
                $contact = $contact['ContactEmployees'];
                $ccont = 1;
                $com = mb_strtoupper($input['Name'], 'UTF-8');
                foreach ($contact as $key => $value) {
                    if ($contact[$key]['Name'] == $com) {
                        $com = $input['Name'];
                        $com = strtoupper($com . $ccont);
                        $ccont = $ccont + 1;
                    }
                }
                if (isset($input['Phone1'])) {
                    $phone1 = $input['Phone1'] . "-( " . $input['Ext1'] . " )";
                } else {
                    $phone1 = "";
                }

                if (isset($input['Phone2'])) {
                    $phone2 = $input['Phone2'] . "-( " . $input['Ext2'] . " )";
                } else {
                    $phone2 = "";
                }
                $FirstName = mb_strtoupper($input['FirstName']);
                $MiddleName =  mb_strtoupper($input['MiddleName']);
                $LastName =  mb_strtoupper($input['LastName']);
                $Profession =  mb_strtoupper($input['Profession']);
                $insertCont = Http::retry('20, 300')->withToken($_SESSION['B1SESSION'])
                    ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')" . '?$select=ContactEmployees', [
                        'ContactEmployees' => [[
                            'Name' => $com,
                            'FirstName' => $FirstName,
                            'MiddleName' =>  $MiddleName,
                            'LastName' =>  $LastName,
                            'Phone1' =>  $phone1,
                            'Phone2' => $phone2,
                            'MobilePhone' =>  $input['MobilePhone'],
                            'E_Mail' =>  $input['E_Mail'],
                            'Profession' =>  $Profession
                        ]]
                    ]);
                $insertCont = $insertCont->json();

                alert()->success('Contacto', 'Contacto creado exitosamente.');
                return Redirect()->route('infoContactos');
            } else {
                $contact = Http::retry('20, 300')->withToken($_SESSION['B1SESSION'])
                    ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')" . '?$select=ContactEmployees');

                $contact = $contact->json();
                $contact = $contact['ContactEmployees'];
                $ccont = 0;
                $com = mb_strtoupper($input['Name'], 'UTF-8');
                foreach ($contact as $key => $value) {
                    if ($contact[$key]['Name'] == $com) {
                        alert()->error('¡Atencion!', 'Tipo de contacto ya creado.');
                        return Redirect('/ncontcreate');
                    }
                }
                if (isset($input['Phone1'])) {
                    $phone1 = $input['Phone1'] . "-( " . $input['Ext1'] . " )";
                } else {
                    $phone1 = "";
                }

                if (isset($input['Phone2'])) {
                    $phone2 = $input['Phone2'] . "-( " . $input['Ext2'] . " )";
                } else {
                    $phone2 = "";
                }
                $FirstName = mb_strtoupper($input['FirstName']);
                $MiddleName =  mb_strtoupper($input['MiddleName']);
                $LastName =  mb_strtoupper($input['LastName']);
                $Profession =  mb_strtoupper($input['Profession']);
                $insertCont = Http::withToken($_SESSION['B1SESSION'])
                    ->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$id')" . '?$select=ContactEmployees', [
                        'ContactEmployees' => [[
                            'Name' => $com,
                            'FirstName' => $FirstName,
                            'MiddleName' =>  $MiddleName,
                            'LastName' =>  $LastName,
                            'Phone1' => $phone1,
                            'Phone2' =>  $phone2,
                            'MobilePhone' =>  $input['MobilePhone'],
                            'E_Mail' =>  $input['E_Mail'],
                            'Profession' =>  $Profession
                        ]]
                    ]);
                $insertCont = $insertCont->json();

                alert()->success('Contacto', 'Contacto creado exitosamente.');
                return Redirect()->route('infoContactos');
            }
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    public function EditContacto($name)
    {
        try {
            session_start();
            $cod = $_SESSION['CODUSER'];

            $contact = Http::retry(20, 400)->withToken($_SESSION['B1SESSION'])
                ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$cod')" . '?$select=ContactEmployees');

            $contact = $contact->json();
            $contactos = $contact['ContactEmployees'];

            foreach ($contactos as $key => $value) {
                if ($contactos[$key]['Name'] == $name) {
                    $contacto = $contactos[$key];
                }
            }

            return view('Pages.consulta.FormContacto', compact('contacto'));
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }

    public function updateContacto(storeContactos $request, $id)
    {
        try {
            $input = $request->all();

            session_start();

            $cod = $_SESSION['CODUSER'];
            $Name = mb_strtoupper($input['Name'], 'UTF-8');
            $FirstName = mb_strtoupper($input['FirstName'], 'UTF-8');
            $MiddleName = mb_strtoupper($input['MiddleName'], 'UTF-8');
            $LastName =  mb_strtoupper($input['LastName'], 'UTF-8');
            $Profession = mb_strtoupper($input['Profession'], 'UTF-8');

            if (isset($input['Phone1'])) {
                $phone1 = $input['Phone1'] . "-( " . $input['Ext1'] . " )";
            } else {
                $phone1 = "";
            }

            if (isset($input['Phone2'])) {
                $phone2 = $input['Phone2'] . "-( " . $input['Ext2'] . " )";
            } else {
                $phone2 = "";
            }
            $update = Http::retry('20, 300')->withToken($_SESSION['B1SESSION'])->patch('https://10.170.20.95:50000/b1s/v1/BusinessPartners' . "('$cod')", [
                "ContactEmployees" => [
                    [
                        "InternalCode" => $id,
                        "CardCode" => $cod,
                        "Name" => $Name,
                        "FirstName" => $FirstName,
                        "MiddleName" => $MiddleName,
                        "LastName" =>  $LastName,
                        "Phone1" => $phone1,
                        "Phone2" =>  $phone2,
                        "MobilePhone" => $input['MobilePhone'],
                        "E_Mail" => $input['E_Mail'],
                        "Profession" => $Profession
                    ]
                ]
            ]);

            alert()->success('Contacto', 'Contacto editado exitosamente.');
            return Redirect()->route('infoContactos');
        } catch (\Throwable $th) {
            Alert::warning('¡La sección expiro!', 'Por favor vuleve a acceder');
            return Redirect('https://pagos.ivanagro.com/dashboard');
        }
    }
}
