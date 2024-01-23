@extends('layouts.appdiagramador')
@section('header')
    <div style="display: flex; align-items:center">
        <a href="{{ $tipo == 'my' ? route('sesion.show', $sesion->id) : route('sesion.other.show', $sesion->id) }}"
            class="flex items-center mr-2">
            <svg class="h-6 w-6 mr-4" fill="#000000" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px"
                viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                <path
                    d="M48.6,23H15.4c-0.9,0-1.3-1.1-0.7-1.7l9.6-9.6c0.6-0.6,0.6-1.5,0-2.1l-2.2-2.2c-0.6-0.6-1.5-0.6-2.1,0
                                                                               L2.5,25c-0.6,0.6-0.6,1.5,0,2.1L20,44.6c0.6,0.6,1.5,0.6,2.1,0l2.1-2.1c0.6-0.6,0.6-1.5,0-2.1l-9.6-9.6C14,30.1,14.4,29,15.3,29
                                                                               h33.2c0.8,0,1.5-0.6,1.5-1.4v-3C50,23.8,49.4,23,48.6,23z" />
            </svg> Pizarra - {{ $sesion->titulo }}</a>
        @if ($sesion->estado == \App\Models\Sesion::ACTIVO)
            <span id="estado"
                class="px-2 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:text-green-400">{{ $sesion->estado }}</span>
        @else
            <span id="estado"
                class="px-2 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:text-red-400">{{ $sesion->estado }}</span>
        @endif
    </div>
@endsection
@section('contenido')
    <div>
        <div class="flex">
            <!-- aside -->
            <aside class="flex w-80 flex-col space-y-2 border-r-2 border-gray-200 bg-gray-700 p-4" style="height: 100%">
                <span class="font-semibold text-gray-200">Componentes</span>
                <div style="width: 100%; display: flex; justify-content: space-between">
                    <div id="myPaletteDiv" class="bg-gray-200"
                        style="border-radius: 10px;width: 100%; height: 300px; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0);">
                        <canvas tabindex="0" width="78" height="300"
                            style="position: absolute; top: 0px; left: 0px; z-index: 2; user-select: none; touch-action: none; width: 100%; height: 300px;"></canvas>
                        <div style="position: absolute; overflow: auto; width: 100%; height: 300px; z-index: 1;">
                            <div style="position: absolute; width: 1px; height: 1px;"></div>
                        </div>
                    </div>
                </div>

                <span class="font-semibold text-gray-200">Usuarios</span>
                <div class="my-2 px-2 py-2 bg-gray-200" style="border-radius:10px; height: 170px;  scroll-padding: 1px;">
                    <div class="relative overflow-y-scroll "
                        style="display: grid; grid-template-columns: repeat(4, 1fr);grid-auto-rows:50px; grid-gap: 3px; height: 100%;">
                        <div class="image-container">
                            <img src="{{ $sesion->user->foto }}"
                                alt="{{ $sesion->user->name . ' ' . $sesion->user->lastname }}" class="object-cover image">
                            <div class="overlay">
                                <div class="text">{{ $sesion->user->name . ' ' . $sesion->user->lastname }}</div>
                            </div>
                            <span id="online{{ $sesion->user->id }}"
                                class="conectados bottom-0 left-7 absolute  w-3.5 h-3.5 bg-red-400 border-2 border-white rounded-full"></span>
                        </div>
                        @foreach ($usuarios as $usuario)
                            <div class="image-container">
                                <img src="{{ $usuario->foto }}" alt="{{ $usuario->name . ' ' . $usuario->lastname }}"
                                    class="object-cover image">
                                <div class="overlay">
                                    <div class="text">{{ $usuario->name . ' ' . $usuario->lastname }}</div>
                                </div>
                                <span id="online{{ $usuario->id }}"
                                    class="conectados bottom-0 left-7 absolute  w-3.5 h-3.5 bg-red-400 border-2 border-white rounded-full"></span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <span class="font-semibold text-gray-200">Exportar</span>
                <div style="width: 100%;">
                    <ul class="justify-center text-center bg-gray-200" style=" border-radius: 10px">
                        <li class="border-b border-slate-100 last:border-0">
                            <a class="block py-2 hover:bg-slate-50" href="#">
                                PNG
                            </a>
                        </li>
                        <li class="border-b border-slate-100 last:border-0">
                            <a class="block py-2 hover:bg-slate-50" href="#">
                                JAVA
                            </a>
                        </li>
                        <li class="border-b border-slate-100 last:border-0">
                            <a class="block py-2 hover:bg-slate-50" href="#">
                                PHP
                            </a>
                        </li>
                        <li class="border-b border-slate-100 last:border-0">
                            <a class="block py-2 hover:bg-slate-50" href="#">
                                JS
                            </a>
                        </li>
                        <li class="border-b border-slate-100 last:border-0">
                            <a class="block py-2 hover:bg-slate-50" href="#">
                                XMI
                            </a>
                        </li>
                    </ul>

                </div>
            </aside>

            <!-- main content page -->
            <div class="w-full p-4 bg-white" id="contenedor-diagrama" data-user="{{ Auth::user()->id }}"
                data-sesion="{{ $sesion->id }}" data-estado="{{ $sesion->estado }}" data-pizarra="{{$pizarra->id}}">
                <div id="sample" class="bg-gray-100 h-full" style="border-radius: 10px">
                    <div id="myDiagramDiv"
                        style="border-radius: 10px; border: 1px solid gray; width: 100%; height: 100%; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0);">
                        <canvas tabindex="0" width="1054" height="398"
                            style="position: absolute; top: 0px; left: 0px; z-index: 2; user-select: none; touch-action: none; width: 1054px; height: 398px;"></canvas>
                        <div id="myDiagramDiv"
                            style="flex-grow: 1; height: 400px; border: 1px solid black; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0);">
                            <canvas tabindex="0" width="972" height="398"
                                style="position: absolute; top: 0px; left: 0px; z-index: 2; user-select: none; touch-action: none; width: 972px; height: 398px;"></canvas>
                            <div style="position: absolute; overflow: auto; width: 972px; height: 398px; z-index: 1;">
                                <div style="position: absolute; width: 1px; height: 1px;"></div>
                            </div>
                        </div>
                    </div>

                    {{-- <div> --}}
                    {{-- <div>
                            <button id="SaveButton" onclick="save()" disabled="">Save</button>
                            <button onclick="load()">Load</button>
                            Diagram Model saved in JSON format:
                        </div> --}}
                    <input type="hidden" id="mySavedModel" value="{{ $pizarra->diagrama }}">
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <style>
        .image-container {
            position: relative;
            width: 100%;
        }

        .image {
            display: block;
            width: 100%;
            height: 50px;
            border-radius: 50%;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #008CBA;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
            border-radius: 100%;
        }

        .image-container:hover .overlay {
            height: 100%;
        }

        .text {
            color: white;
            font-size: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
    {{-- JS --}}
@endsection
