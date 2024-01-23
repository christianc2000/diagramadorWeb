<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'foto',
        'fecha_nacimiento',
        'genero',
        'tipo',
        'email',
        'password',
    ];

    //tipo de usuario
    const ADMINISTRADOR = "A";
    const INVITADO = "I";

    // Tipos de notificaciones
    const INVITACIÓN="Invitación"; //se manda al usuario que se invitará a la sesión
    const ACEPTACIÓN="Aceptación"; //se manda al que creo la sesión cuando un usuario acepta la invitación
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    //relación de muchos a muchos
    public function sesionUser()
    {
        return $this->belongsToMany(Sesion::class,'sesion_user')->withPivot('fecha_invitacion', 'fecha_respuesta', 'estado')->withTimestamps();
    }
    //relación de 1 a muchos
    public function sesions()
    {
        return $this->hasMany(Sesion::class);
    }
    public function allSesiones()
    {
        $sesionUser = $this->sesionUser()->get();
        $sesions = $this->sesions()->get();
    
        $todasLasSesiones = $sesionUser->concat($sesions);
    
        return $todasLasSesiones;
    }
    public function pizarra()
    {
        return $this->hasManyThrough(
            Pizarra::class, // Modelo de la tabla de destino final
            Sesion::class, // Modelo de la tabla intermedia
            'user_id', // Clave foránea en la tabla intermedia
            'sesion_id', // Clave foránea en la tabla de destino
            'id', // Clave primaria en la tabla de origen
            'id' // Clave primaria en la tabla intermedia
        );
    }

    public function archivos(){
        return $this->hasMany(Archivo::class);
    }
}
