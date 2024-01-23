<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pizarra;
use App\Models\Sesion;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SesionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sesiones = Sesion::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        $allsesiones = $user->allSesiones();
        $othersesiones = $user->sesionUser;

        return view('web.sesion.index', compact('allsesiones', 'sesiones', 'othersesiones'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return redirect()->route('sesion.index')->with('error', 'Error en la validación');
        } else {
            $user = Auth::user();
            $sesion = Sesion::create([
                'titulo' => $request->titulo,
                'user_id' => $user->id
            ]);
            $pizarra = Pizarra::create([
                'diagrama' => Pizarra::diagrama(),
                'fecha_guardado' => Carbon::now()->toDateTimeString(),
                'sesion_id' => $sesion->id
            ]);
            $sesion->link = route('sesion.show', $sesion->id);
            $sesion->save();

            return redirect()->route('sesion.index')->with('mensaje', 'Sesión creada exitosamente');
        }
    }
    public function show($id)
    {
        $sesion = Sesion::find($id);
        if (isset($sesion)) {
            $colaboradores = $sesion->sesionUser->where('pivot.estado', Sesion::ACEPTADO);
            $invitados = $sesion->usuariosInvitados();
         
            return view('web.sesion.show', compact('sesion', 'colaboradores', 'invitados'));
        } else {
            return redirect()->route('sesion.index')->with('error', 'Error sesión no encontrada');
        }
    }
    public function otherSesion($id)
    {
        $sesion = Sesion::find($id);

        if (isset($sesion)) {
            $colaboradores = $sesion->sesionUser->where('pivot.estado', Sesion::ACEPTADO);
            $administrador = $sesion->user;
            return view('web.sesion.showother', compact('sesion', 'colaboradores', 'administrador'));
        } else {
            return redirect()->route('sesion.index')->with('error', 'Error sesión no encontrada');
        }
    }
    public function aceptarSesion($id, Request $request)
    {
        $request->validate([
            'respuesta' => 'required|string'
        ]);

        $user = Auth::user();
        $sesion = Sesion::find($id);
        $userSesion = $user->sesionUser->find($id);
        if ($request->respuesta == "Aceptada") {
            if (!isset($userSesion->pivot['fecha_respuesta'])) {
                $estado = $user->sesionUser()->updateExistingPivot($id, ['fecha_respuesta' => Carbon::now()->toDateTimeString(), 'estado' => Sesion::ACEPTADO]);
                if ($estado > 0) {
                    $user_destino=$sesion->user;
                    $user_destino->notify(new UserNotification((String)$sesion->id,"Aceptación", $user->name." ".$user->lastname." aceptó unirse a la sesión ".$sesion->titulo, "Sesion"));
                    return redirect()->route('sesion.other.show', $id)->with('mensaje', 'Te uniste a la sesión '.$sesion->titulo.' exitosamente');
                } else {
                    return redirect()->route('sesion.other.show', $id)->with('error', 'Error al unirte a la sesión '.$sesion->titulo);
                }
            } else {
                return redirect()->route('sesion.other.show', $id)->with('error', 'Ya formas parte de la sesion '.$sesion->titulo);
            }
        } else {
            $estado = $user->sesionUser()->detach($id);
            if ($estado > 0) {
                return redirect()->route('sesion.index', $id)->with('mensaje', 'Rechazaste la unión a la sesión ' . $sesion->titulo);
            } else {
                return redirect()->route('sesion.index', $id)->with('error', 'Error al rechazar la unión a la sesión ' . $sesion->titulo);
            }
        }
    }

    public function pizarraSesion($id)
    { //id de la pizarra
        $pizarra = Pizarra::find($id);
        $sesion = $pizarra->sesion;
        $user = Auth::user();
        $mysesion = $user->sesions->find($sesion->id);
        
        $usuarios = $sesion->sesionUser->where('pivot.estado', Sesion::ACEPTADO);
        if (isset($mysesion)) {
            $tipo = 'my';
        } else {
            $tipo = 'other';
        }
        return view('web.sesion.pizarra', compact('sesion', 'pizarra', 'tipo','usuarios'));
    }
}
