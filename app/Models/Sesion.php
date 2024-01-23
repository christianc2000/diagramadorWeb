<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;
    //Estado de la sesion
    const ACTIVO = "Activo";
    const INACTIVO = "Inactivo";
    //Estado de la invitacion
    const ESPERA = "En espera";
    const ACEPTADO = "Aceptado";
    const RECHAZADO = "Rechazado";
    protected $fillable = [
        'titulo',
        'estado',
        'link',
        'user_id'
    ];

    public function sesionUser()
    {
        return $this->belongsToMany(User::class, 'sesion_user')->withPivot('fecha_invitacion', 'fecha_respuesta', 'estado')->withTimestamps();
    }
    //relación de 1 a muchos inversa
    public function usuariosConSesion()
    {
        return $this->sesionUser()->get();
    }
    public static function usuariosSinSesion()
    {
        return User::whereDoesntHave('sesionUser')->get();
    }
    public static function usuariosSinSesionAuth($sessionId)
    {
        $session = Sesion::find($sessionId);
        $creatorId = $session->user_id;

        return User::whereDoesntHave('sesionUser', function ($query) use ($sessionId) {
            $query->where('sesion_id', $sessionId);
        })->where('id', '!=', $creatorId);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function usuariosInvitados()
    {
        return $this->sesionUser()->where(function ($query) {
            $query->where('sesion_user.estado', Sesion::ESPERA)
                ->orWhere('sesion_user.estado', Sesion::RECHAZADO);
        })->get();
    }

    public function pizarras(){
        return $this->hasMany(Pizarra::class);
    }
}
