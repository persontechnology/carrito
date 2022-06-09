<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class RqGuardar extends FormRequest
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
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        return [
            'categoria'=>'nullable|exists:categorias,id',
            'codigo'=>'required|string|max:255',
            'nombre'=>'required|string|max:255',
            'talla'=>'required|string|max:255',
            'color'=>'nullable|string|max:255',
            'descripcion'=>'nullable|string',
            'precio_compra'=>'required|regex:'.$rg_decimal,
            'precio_venta'=>'required|regex:'.$rg_decimal,
            'cantidad'=>'required|regex:'.$rg_decimal,
            'cuenta_contable'=>'nullable|string|max:255',
            'cuenta_salida'=>'nullable|string|max:255',
            'incluye_iva'=>'nullable',
        ];
    }

    public function messages()
    {
        return [
            'talla.required'=>'Unidad de medida es requerida'
        ];
    }
}
