<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizarra extends Model
{
    use HasFactory;
    protected $fillable = [
        'diagrama',
        'fecha_guardado',
        'imagen_diagrama',
        'sesion_id'
    ];
    public static function diagrama()
    {
        return json_encode([
            "class" => "GraphLinksModel",
            "nodeDataArray" => [],
            "linkDataArray" => []
        ]);
    }
    // relación de 1 a muchos inversa
    public function sesion(){
        return $this->belongsTo(Sesion::class);
    }

    // relación de 1 a muchos
    public function archivo(){
        return $this->hasMany(Archivo::class);
    }
}
