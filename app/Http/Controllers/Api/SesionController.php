<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pizarra;
use App\Models\Sesion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SesionController extends BaseController
{
    public function activar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'sesion_id' => 'required|exists:sesions,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422);
        }
        $user = User::find($request->user_id);
        $sesion = $user->sesions->where('id', $request->sesion_id)->first();
        if (isset($sesion)) {
            $sesion->estado = Sesion::ACTIVO;
            $sesion->save();
            return $this->sendResponse($sesion, "Estado activado");
        }
        return $this->sendError('Error sesion no encontrada', [], 401);
    }
    public function desactivar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'sesion_id' => 'required|exists:sesions,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422);
        }
        $user = User::find($request->user_id);
        $sesion = $user->sesions->where('id', $request->sesion_id)->first();
        if (isset($sesion)) {
            $sesion->estado = Sesion::INACTIVO;
            $sesion->save();
            return $this->sendResponse($sesion, "Estado desactivado");
        }
        return $this->sendError('Error sesion no encontrada', [], 401);
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('query');
        $query = $request->get('query');

        $sesion = Sesion::find($request->get('sesion_id'));

        $usuariosSinSesion = $sesion->usuariosSinSesionAuth($sesion->id);
        if (empty($search)) {
            $users = $usuariosSinSesion->inRandomOrder()->take(3)->get();
        } else {
            $users = $usuariosSinSesion->where(function ($query) use ($search) {
                $query->whereRaw('lower(username) like lower(?)', ["%{$search}%"])
                    ->orWhereRaw('lower(name) like lower(?)', ["%{$search}%"])
                    ->orWhereRaw('lower(lastname) like lower(?)', ["%{$search}%"]);
            })->get();
        }

        return response()->json($users);
    }

    public function aceptarInvitacion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sesion_id' => 'required|exists:sesions,id',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        $user = User::find($request->user_id);

        // $sesion = Sesion::find($request->sesion_id);

        $userSesion = $user->sesionUser->find($request->sesion_id);
        // return $this->sendResponse($sesionUser, "Invitación aceptada");

        if (!isset($userSesion->pivot['fecha_respuesta'])) {
            $estado = $user->sesionUser()->updateExistingPivot($request->sesion_id, ['fecha_respuesta' => Carbon::now()->toDateTimeString(), 'estado' => Sesion::ACEPTADO]);
            return $this->sendResponse($estado, "Invitación aceptada");
        } else {
            return $this->sendResponse($userSesion, "Invitación ya fue aceptada");
        }
    }
    public function marcarNotificaciones(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        $user = User::find($request->user_id);
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return $this->sendResponse(["read" => $user->readNotifications, "unread" => $user->unreadNotifications], "notificaciones");
    }

    public function saveDiagrama(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pizarra_id' => 'exists:pizarras,id',
            'diagrama' => 'json'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        $pizarra = Pizarra::find($request->pizarra_id);
        $pizarra->diagrama = $request->diagrama;
        $pizarra->fecha_guardado = Carbon::now()->toDateTimeString();
        $pizarra->save();
        return $this->sendResponse($pizarra, 'success');
    }
    // public function descargarJAVA(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'pizarra_id' => 'exists:pizarras,id',
    //         'diagrama' => 'json'
    //     ]);
    // }
}
