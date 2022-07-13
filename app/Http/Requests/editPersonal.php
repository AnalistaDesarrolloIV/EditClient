<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editPersonal extends FormRequest
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
            'Phone1'=>['required','numeric', 'min:5'],
            'Phone2'=>['nullable','numeric',],
            'EmailAddress'=>['required','email', 'regex:/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i'],
            'EmailAddress2'=>['required','email', 'regex:/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i'],
            'Archivos'=>['required','mimes:pdf'],
        ];
    }
    public function attributes()
    { 
        return [
            
            'Phone1'=> 'Telefono 1',
            'Phone2'=> 'Telefono 2',
            'EmailAddress'=> 'Correo personal',
            'EmailAddress2'=> 'Correo comercial',
            'Archivos' => 'Documentos adjuntos'
        ];
    }
}
