<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Sesion;
use App\Models\User;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'colaboradores' => 'required',
            'sesion_id' => 'required|exists:sesions,id'
        ]);
        if ($validator->fails()) {
            return redirect()->route('sesion.index')->with('error', 'Error en la validación');
        }
        $sesion=Sesion::find($request->sesion_id);
        $users_ids = json_decode($request->colaboradores);
        foreach ($users_ids as $user_id) {
            // Crear la notificación para cada usuario que se crea su sesion_user
            $user=User::find($user_id);
            $sesion->sesionUser()->attach($user_id,['fecha_invitacion' => Carbon::now()->toDateTimeString(), 'estado' =>Sesion::ESPERA]);
            $user->notify(new UserNotification((String)$sesion->id,"Invitación", $sesion->titulo, "Sesion")); //id,accion,titulo,tabla,time
        }
        return redirect()->route('sesion.show',$sesion->id)->with('mensaje','Colaboradores invitados a la sesión exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
