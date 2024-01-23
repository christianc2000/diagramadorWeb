<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Web\EstiloController;
use App\Http\Controllers\Web\InvitacionController;
use App\Http\Controllers\Web\SesionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('web.inicio');
    })->name('dashboard');

    //sesión
    Route::resource('sesion', SesionController::class)->names('sesion');
    Route::get('other/sesion/{id}',[SesionController::class,'otherSesion'])->name('sesion.other.show');
    Route::post('other/Sesion/{id}',[SesionController::class,'aceptarSesion'])->name('sesion.other.store');
    Route::get('sesion/pizarra/{id}',[SesionController::class,'pizarraSesion'])->name('sesion.pizarra');
    Route::resource('invitacion',InvitacionController::class)->names('invitacion');
});
Route::get('/configuracion', function () {
    return view('web.configuracion');
})->name('configuracion');
Route::post('cambiar-estilo', [EstiloController::class, 'cambiarEstilo'])->name('cambiar.estilo');



// Registrar y login
Route::post('register', function (CreateNewUser $creator) {
    // Aquí va la lógica de creación de usuario
    $user = $creator->create(request()->all());
    Auth::login($user);
    // Personaliza la redirección después del registro
    return redirect()->intended('/'); // Cambia '/home' por la ruta que desees
})->name('register');

Route::post('login', function () {
    // Lógica de autenticación, por ejemplo:
    $credentials = request()->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Autenticación exitosa
        return redirect()->intended('/');
    }
    // Autenticación fallida, puedes manejarlo de acuerdo a tus necesidades
    return back()->withErrors(['email' => 'Credenciales incorrectas']);
})->middleware('guest')->name('login');

