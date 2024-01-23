<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    //Tipo de archivo
    const XMI = "xmi";
    const JAVA = "java";
    const PHP = "php";
    const JS = "javascript";
    protected $fillable = [
        'fecha',
        'diagrama',
        'tipo',
        'url',
        'user_id',
        'pizarra_id'
    ];

    // relación de 1 a muchos inversa
    public function pizarra()
    {
        return $this->belongsTo(Pizarra::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
