<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // $images = Image::where('categoria',Image::PUB)->where('estado',true)->get();
        // $fotografos = User::where('tipo', 'F')->get();
        // return $fotografos;
        return view('web.inicio');
    }
}
