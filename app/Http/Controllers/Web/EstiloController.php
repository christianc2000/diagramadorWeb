<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstiloController extends Controller
{
    public function cambiarEstilo(Request $request)
    {
        // Almacena la elección del usuario (puedes usar sesiones, bases de datos, etc.)
        session(['logo'=>$request->turno]);
        session(['estilo_actual' => $request->estilo]);

        return redirect()->back();
    }
}
