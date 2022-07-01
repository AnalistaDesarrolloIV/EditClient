<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NaturalController extends Controller
{
    public function infoPersonal()
    {
        
        session_start();
        $id = $_SESSION['USER'];
        
        do {
            $user = Http::withToken($_SESSION['B1SESSION'])
            ->get('https://10.170.20.95:50000/b1s/v1/BusinessPartners?$select=FederalTaxID,U_HBT_TipDoc, CardCode,CardName,EmailAddress,Phone1,Phone2&$filter=FederalTaxID eq '."'$id'");
        } while ($user->clientError());
        $user = $user->json();
        $usuario = $user['value']['0'];
        // dd($usuario);
        $_SESSION['CODUSER'] = $usuario['CardCode'];

        return view('Pages.consulta.FormEditPerson', compact('usuario'));
    }

    public function editPersonal(Request $request)
    {
        $input = $request->all();
        dd($input);
        session_start();
        $id = $_SESSION['USER'];

    }

    public function infoDirecciones()
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

        return view('Pages.consulta.listDirreccion', compact('direccion'));
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
        return view('Pages.consulta.FormDireccion', compact('dire'));
    }

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
