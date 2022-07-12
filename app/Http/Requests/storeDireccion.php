<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeDireccion extends FormRequest
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
            'AddressType' => ['required'],
            'Nombre_Direccion' => ['required', 'min:5', 'max:100'],
            'Departamento' => ['required'],
            'Ciudad'=>['required'],
            'Barrio_Vereda_Corregimiento' => ['required'],
            'Codigo_Postal' => ['required'],
            'Direccion_fisica'=>['required', 'min:5'],
        ];
    }
    public function attributes()
    { 
        return [
            
            'AddressType' => 'Tipo de dirección',
            'Nombre_Direccion' => 'Nombre de dirección',
            'Departamento' => 'Departamento',
            'Ciudad'=> 'Ciudad',
            'Barrio_Vereda_Corregimiento' => 'Barrio/Vereda/Corregimiento',
            'Codigo_Postal' => 'Codigo postal',
            'Direccion_fisica'=> 'Dirección fisica',
        ];
    }
}
