<?php

namespace App\Http\Requests\Ventas\Facturas;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('RqCantidadProducto', function($attribute, $value, $parameters){
            $tipo=$this->input('tipo');

            if($tipo==='Salida'){
                $producto=Producto::findOrFail($value);  
                if($producto->cantidad>=1){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }

           },'Cantidad de producto :attribute :value sobrepasa la cantidad existente');


        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        return [
            'tipo'=>'required|in:Ingreso,Salida',
            'identificacion'=>'required|string|max:255',
            'apellidos'=>'required|string|max:255',
            'nombres'=>'required|string|max:255',
            'direccion'=>'required|string|max:255',
            'telefono'=>'nullable|string|max:255',
            'producto'=>'required|array|max:10|min:1',
            'producto.*'=>'required|exists:productos,id|RqCantidadProducto',
            'cantidad'=>'required|array',
            'cantidad.*'=>'required|regex:'.$rg_decimal,
            'detalle'=>'required|array',
            'detalle.*'=>'required',
            'valor_unitario'=>'required|array',
            'valor_unitario.*'=>'required|regex:'.$rg_decimal,
            'forma_pago'=>'required',
            'observacion'=>'nullable|string',
            'numero'=>'required_if:tipo,Salida|unique:facturas,numero',
            'comprobante'=>'required_if:tipo,Ingreso|string|max:255|unique:facturas,comprobante',
            'documento_referencia'=>'required_if:tipo,Ingreso|string|max:255',
            'codigo'=>'required_if:tipo,Ingreso|string|max:255',
            

        ];
    }

    public function messages()
    {
         return [
            'numero.unique'=>'El valor del campo número de factura ya está en uso.'
         ];
    }
}
