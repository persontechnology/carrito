<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RqGuardarUsuario extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        
        if(strlen($this->input('identificacion'))<=10){
            $identificacion_v='required|unique:users|max:255|ecuador:ci';
        }else{
            $identificacion_v='required|unique:users|max:255|ecuador:ruc';
        }
        return [
            'identificacion' => $identificacion_v,
            'apellidos' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'telefono' => 'required|digits:10',
            'direccion' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'roles'=>'nullable|array',
            'roles.*'=>'nullable|exists:roles,id',
            'banco'=>'nullable|string|max:255',
            'numero_cuenta'=>'nullable|string|max:255',
            'tipo_cuenta'=>'nullable|string|max:255',
            'departamento'=>'nullable|exists:departamentos,id'
        ];
    }
}
