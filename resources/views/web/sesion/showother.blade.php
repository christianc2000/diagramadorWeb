@extends('layouts.appdiagramador')
@section('header')
    <a href="{{ route('sesion.index') }}" class="flex items-center">
        <svg class="h-6 w-6 mr-4" fill="#000000" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px"
            viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
            <path d="M48.6,23H15.4c-0.9,0-1.3-1.1-0.7-1.7l9.6-9.6c0.6-0.6,0.6-1.5,0-2.1l-2.2-2.2c-0.6-0.6-1.5-0.6-2.1,0
                                                        L2.5,25c-0.6,0.6-0.6,1.5,0,2.1L20,44.6c0.6,0.6,1.5,0.6,2.1,0l2.1-2.1c0.6-0.6,0.6-1.5,0-2.1l-9.6-9.6C14,30.1,14.4,29,15.3,29
                                                        h33.2c0.8,0,1.5-0.6,1.5-1.4v-3C50,23.8,49.4,23,48.6,23z" />
        </svg> Sesión</a>
@endsection
@section('contenido')
    <div class="mx-auto py-6 sm:px-6 lg:px-8">
        @if ($sesion->sesionUser->find(Auth::user()->id)->pivot['estado'] == \App\Models\Sesion::ESPERA)
            <div id="invitacion"
                class="mb-6 w-full rounded-md border-2 border-emerald-400 py-1.5 px-3 bg-white text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                ¿Desea aceptar la invitación para unirse a la sesión
                <strong>{{ $sesion->titulo }}</strong>?
                <form action="{{ route('sesion.other.store', $sesion) }}" id="form-invitacion" method="POST">
                    @csrf
                    <input type="hidden" name="respuesta">
                    <div class="mt-2 flex items-center justify-end gap-x-6">
                        <button type="button" id="btn-rechazar" data-user="{{ Auth::user()->id }}"
                            data-sesion="{{ $sesion->id }}"
                            class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Rechazar</button>
                        <button type="button" id="btn-aceptar" data-user="{{ Auth::user()->id }}"
                            data-sesion="{{ $sesion->id }}"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Aceptar</button>
                    </div>
                </form>
            </div>
        @endif
        <div class="space-y-6">
            <div class="flex items-center space-x-2">
                <h2 class="text-xl font-bold text-gray-700" id="sesion-title" data-user="{{ Auth::user()->id }}"
                    data-sesion="{{ $sesion->id }}" data-estado="{{ $sesion->estado }}">{{ $sesion->titulo }}
                </h2>

                @if ($sesion->estado == \App\Models\Sesion::ACTIVO)
                    <span id="estado"
                        class="px-2 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:text-green-400">{{ $sesion->estado }}</span>
                @else
                    <span id="estado"
                        class="px-2 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:text-red-400">{{ $sesion->estado }}</span>
                @endif
            </div>

            <!-- component -->
            <!-- Creacte By Joker Banny -->

            <div class="h-96 w-full bg-indigo-500 rounded-lg p-3 flex flex-col justify-between items-end">
                {{-- style="background-image: url('ruta/a/tu/imagen.jpg'); background-size: cover;"> --}}
                <div class="dropdown">
                    <button id="myButton" class="dropbtn">
                        <svg class="w-6 h-6" width="800px" height="800px" viewBox="0 -6 16 16" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>navigation / 14 - navigation, aligned, dots, more, horizontal, three dots, option icon
                            </title>
                            <g id="Free-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1119.000000, -756.000000)" fill="#ffffff" fill-rule="nonzero"
                                    id="Group">
                                    <g transform="translate(1115.000000, 746.000000)" id="Shape">
                                        <path
                                            d="M6,10 C4.8954305,10 4,10.8954305 4,12 C4,13.1045695 4.8954305,14 6,14 C7.1045695,14 8,13.1045695 8,12 C8,10.8954305 7.1045695,10 6,10 Z">
    
                                        </path>
                                        <path
                                            d="M12,10 C10.8954305,10 10,10.8954305 10,12 C10,13.1045695 10.8954305,14 12,14 C13.1045695,14 14,13.1045695 14,12 C14,10.8954305 13.1045695,10 12,10 Z">
    
                                        </path>
                                        <path
                                            d="M18,10 C16.8954305,10 16,10.8954305 16,12 C16,13.1045695 16.8954305,14 18,14 C19.1045695,14 20,13.1045695 20,12 C20,10.8954305 19.1045695,10 18,10 Z">
    
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </button>
                    <div id="myDropdown" class="dropdown-content bg-white p-1">
                        <p class="text-gray-900 font-semibold">Exportar</p>
                        <button type="button" onclick="handleDownloadClick()" class="hover:bg-gray-200 text-gray-500 w-full">
                            XMI
                        </button>
                        <button type="button" onclick="handleDownloadClick()" class="hover:bg-gray-200 text-gray-500 w-full">
                            PNG
                        </button>
                        <button type="button" onclick="handleDownloadJavaClick()"
                            class="hover:bg-gray-200 text-gray-500 w-full">
                            JAVA
                        </button>
                        <button type="button" onclick="handleDownloadPhpClick()"
                            class="hover:bg-gray-200 text-gray-500 w-full">
                            PHP
                        </button>
                        <button type="button" onclick="handleDownloadCppClick()"
                            class="hover:bg-gray-200 text-gray-500 w-full">
                            C++
                        </button>
                    </div>
                </div>
    
                <div id="myDiagramDiv"
                    style="border-radius: 10px; border: 1px solid gray; width: 100%; height: 100%; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0);">
                    <!-- Aquí va tu diagrama -->
                    <canvas tabindex="0" width="1054" height="398"
                        style="position: absolute; top: 0px; left: 0px; z-index: 2; user-select: none; touch-action: none; width: 1054px; height: 398px;"  readonly></canvas>
                    <div
                        style="flex-grow: 1; height: 400px; border: 1px solid black; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0);">
                        <canvas tabindex="0" width="972" height="398"
                            style="position: absolute; top: 0px; left: 0px; z-index: 2; user-select: none; touch-action: none; width: 972px; height: 398px;"  readonly></canvas>
                        <div style="position: absolute; overflow: auto; width: 972px; height: 398px; z-index: 1;">
                            <div style="position: absolute; width: 1px; height: 1px;"></div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('sesion.pizarra', $sesion->pizarras->first()->id) }}" id="abrir-pizarra"
                    style="{{ $sesion->sesionUser->find(Auth::user()->id)->pivot['estado'] == \App\Models\Sesion::ESPERA ? 'display: none' : 'display: block' }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Abrir
                    pizarra</a>
            </div>
            {{-- componente --}}
            <div id="myPaletteDiv" class="bg-gray-200"
                style="border-radius: 10px;width: 100%; height: 300px; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0); display:none">
                <canvas tabindex="0" width="78" height="300"
                    style="position: absolute; top: 0px; left: 0px; z-index: 2; user-select: none; touch-action: none; width: 100%; height: 300px;"></canvas>
                <div style="position: absolute; overflow: auto; width: 100%; height: 300px; z-index: 1;">
                    <div style="position: absolute; width: 1px; height: 1px;"></div>
                </div>
            </div>
            <div id="myDiagramDiv"
                style="border-radius: 10px; border: 1px solid gray; width: 100%; height: 100%; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0); display:none">
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
            <input type="hidden" id="mySavedModel" value="{{ $sesion->pizarras->first()->diagrama }}">
            <div class="mt-15 grid grid-cols-1 gap-x-14 gap-y-8 sm:grid-cols-6">
                <!-- left -->
                <div class="col-span-3 space-y-3">
                    <label for="titulo"
                        class="block text-lg font-medium leading-6 text-gray-700 dark:text-white">Colaboradores</label>
                    <div>
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2">
                            <ul class="divide-y divide-gray-200">
                                @forelse ($colaboradores as $colaborador)
                                    <li class="p-3 flex justify-between items-center user-card">
                                        <div class="flex items-center">
                                            <div class="relative">
                                                <img class="w-10 h-10 rounded-full object-cover"
                                                    src="{{ $colaborador->foto }}"
                                                    alt="{{ $colaborador->name . ' ' . $colaborador->lastname }}">
                                                <span id="online{{ $colaborador->id }}"
                                                    class="conectados bottom-0 left-7 absolute  w-3.5 h-3.5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                            </div>
                                            <div class="ml-3">
                                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">
                                                    {{ $colaborador->name . ' ' . $colaborador->lastname }} @if ($colaborador->id == Auth::user()->id)
                                                        (Yo)
                                                    @endif
                                                </h2>
                                                <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                    {{ $colaborador->username }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="text-gray-500 hover:text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h16m-7 6h7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </li>
                                @empty
                                    <li class="p-3 flex justify-center text-gray-700 items-center user-card">
                                        <svg class="h-4 w-4 mr-2" fill="#000000" width="800px" height="800px"
                                            viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M511.728 64c108.672 0 223.92 91.534 223.92 159.854v159.92c0 61.552-25.6 179.312-94.256 233.376a63.99 63.99 0 0 0-23.968 57.809c2.624 22.16 16.592 41.312 36.848 50.625l278.496 132.064c2.176.992 26.688 5.104 26.688 39.344l.032 62.464L64 959.504V894.56c0-25.44 19.088-33.425 26.72-36.945l281.023-132.624c20.16-9.248 34.065-28.32 36.769-50.32 2.72-22-6.16-43.84-23.456-57.712-66.48-53.376-97.456-170.704-97.456-233.185v-159.92C287.615 157.007 404.016 64 511.728 64zm0-64.002c-141.312 0-288.127 117.938-288.127 223.857v159.92c0 69.872 31.888 211.248 121.392 283.088l-281.04 132.64S.001 827.999.001 863.471v96.032c0 35.344 28.64 63.968 63.951 63.968h895.552c35.344 0 63.968-28.624 63.968-63.968v-96.032c0-37.6-63.968-63.968-63.968-63.968L681.008 667.439c88.656-69.776 118.656-206.849 118.656-283.665v-159.92c0-105.92-146.64-223.855-287.936-223.855z" />
                                        </svg> Sin colaboradores
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- right -->
                <div class="col-span-3 space-y-3">
                    <label for="titulo" class="block text-lg font-medium leading-6 text-gray-700 dark:text-white">
                        <div class="flex items-center space-x-2">
                            Administrador
                        </div>
                    </label>
                    <div>
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2">
                            <ul class="divide-y divide-gray-200">
                                <li class="p-3 flex justify-between items-center user-card">
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <img class="w-10 h-10 rounded-full object-cover"
                                                src="{{ $administrador->foto }}"
                                                alt="{{ $administrador->name . ' ' . $administrador->lastname }}">
                                            <span id="online{{ $administrador->id }}"
                                                class="conectados bottom-0 left-7 absolute  w-3.5 h-3.5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                        </div>

                                        <div class="ml-3">
                                            <div class="flex items-center space-x-2">
                                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">
                                                    {{ $administrador->name . ' ' . $administrador->lastname }}</h2>
                                            </div>
                                            <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                {{ $administrador->username }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="text-gray-500">
                                            <svg class="h-6 w-6" width="800px" height="800px" viewBox="0 0 16 16"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="#000000" fill-rule="evenodd"
                                                    d="M16,8 C16,12.4183 12.4183,16 8,16 C3.58172,16 0,12.4183 0,8 C0,3.58172 3.58172,0 8,0 C12.4183,0 16,3.58172 16,8 Z M9,5 C9,5.55228 8.55229,6 8,6 C7.44772,6 7,5.55228 7,5 C7,4.44772 7.44772,4 8,4 C8.55229,4 9,4.44772 9,5 Z M8,7 C7.44772,7 7,7.44772 7,8 L7,11 C7,11.5523 7.44772,12 8,12 C8.55229,12 9,11.5523 9,11 L9,8 C9,7.44772 8.55229,7 8,7 Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css" />
    <style>
        .top-100 {
            top: 100%
        }

        .bottom-100 {
            bottom: 100%
        }

        .max-h-select {
            max-height: 300px;
        }

        .hover-effect:hover {
            fill: #549CD9;
        }

        .hover-effect-information:hover {
            fill: #3D3D45;
        }

        /* Estilos para el botón y el contenido del menú desplegable */
        .dropdown {
            position: relative;
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0px;
            top: 20px;
            border-radius: 5px;
            /* Alinea el borde derecho del contenido con el borde derecho del botón */
            min-width: 140px;
            z-index: 10;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9;
        }

        .dropdown-content a {
            padding: 5px 10px;
            text-decoration: none;
            display: block;
            z-index: 10;
        }

        .dropdown-content button {
            padding: 5px 10px;
            text-decoration: none;
            display: block;
            z-index: 10;
        }


        .dropdown-content p {
            padding: 5px 10px;
            text-decoration: none;
            display: block;
        }

        /* Muestra el menú desplegable cuando se hace clic en el botón */
        .show {
            display: block;
        }

        .btn-activo {
            background-color: #f3f4f6;
            /* color de fondo cuando está activo */
            color: #374151;
            /* color del texto cuando está activo */
        }
    </style>
    {{-- Estilos del modal --}}

    {{-- JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.bundle.js"></script>

    @if (session('mensaje'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            console.log("ingresa a success");
            toastr.success("{{ session('mensaje') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            console.log("ingresa a error")
            toastr.error("{{ session('error') }}");
        </script>
    @endif
@endsection
