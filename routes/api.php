<?php

use App\Http\Controllers\Api\SesionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('activar/estado',[SesionController::class,'activar']);
Route::post('desactivar/estado',[SesionController::class,'desactivar']);
Route::post('aceptar-invitacion', [SesionController::class, 'aceptarInvitacion']);
Route::post('marcar-notificaciones', [SesionController::class, 'marcarNotificaciones']);
Route::post('save-diagram',[SesionController::class,'saveDiagrama']);
// buscador de usuario por el username
Route::get('search',[SesionController::class,'searchUser']);
