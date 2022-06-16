<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{

    public function getReferenciaAttribute()
    {
        if($this->tipo==='Ingreso'){
            return $this->comprobante;
        }else{
            return $this->numero;
        }
        
    }

    public function cliente()
    {
        return $this->belongsTo(User::class,'cliente_id');
    }


    public function vendedor()
    {
        return $this->belongsTo(User::class,'vendedor_id');
    }

    public function facturaDetalles()
    {
        return $this->hasMany(FacturaDetalle::class);
    }



}
