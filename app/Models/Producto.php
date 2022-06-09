<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function categoria_dos()
    {
        return $this->belongsTo(Categoria::class,'categoria_dos_id');
    }

    
}
