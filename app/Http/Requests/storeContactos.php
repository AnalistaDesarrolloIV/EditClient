<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeContactos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Name' => ['required'],
            'FirstName' => ['required','string', 'min:2', 'max:100'],
            'MiddleName' => ['nullable','string', 'min:2', 'max:100'],
            'LastName'=>['required','string', 'min:2', 'max:100'],
            'Profession' => ['required','string', 'min:2', 'max:100'],
            'Ext1' => ['nullable','numeric'],
            'Phone1'=>['nullable','numeric', 'min:5'],
            'Ext2' => ['nullable','numeric'],
            'Phone2'=>['nullable','numeric', 'min:5'],
            'MobilePhone'=>['required'],
            'E_Mail'=>['nullable','email', 'regex:/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i']
        ];
    }
    public function attributes()
    { 
        return [
            
            'Name' => 'Tipo de contacto',
            'FirstName' => 'Primer nombre',
            'MiddleName' => 'Segundo nombre',
            'LastName'=> 'Apelldos',
            'Profession' => 'Profeción',
            'Ext1' => 'Extención 1',
            'Phone1'=> 'Telefono 1',
            'Ext2' => 'Extencion 2',
            'Phone2'=> 'Telefono 2',
            'MobilePhone'=> 'Movil',
            'E_Mail'=> 'Correo'
        ];
    }
}
