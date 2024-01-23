@extends('layouts.appdiagramador')
@section('header')
    <a href="{{route('sesion.index')}}"
        class="flex items-center">
        <svg class="h-6 w-6 mr-4" fill="#000000" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px"
            viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
            <path d="M48.6,23H15.4c-0.9,0-1.3-1.1-0.7-1.7l9.6-9.6c0.6-0.6,0.6-1.5,0-2.1l-2.2-2.2c-0.6-0.6-1.5-0.6-2.1,0
       L2.5,25c-0.6,0.6-0.6,1.5,0,2.1L20,44.6c0.6,0.6,1.5,0.6,2.1,0l2.1-2.1c0.6-0.6,0.6-1.5,0-2.1l-9.6-9.6C14,30.1,14.4,29,15.3,29
       h33.2c0.8,0,1.5-0.6,1.5-1.4v-3C50,23.8,49.4,23,48.6,23z" />
        </svg> Sesión</a>
@endsection
@section('contenido')
    <div class="mx-auto py-6 sm:px-6 lg:px-8 space-y-6">
        <div class="flex items-center space-x-2">
            <h2 class="text-xl font-bold text-gray-900" id="sesion-title" data-user="{{ Auth::user()->id }}"
                data-sesion="{{ $sesion->id }}" data-estado="{{$sesion->estado}}">{{ $sesion->titulo }}
            </h2>
            <button>
                <svg class="h-5 w-5 text-gray-900" width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.293 2.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-13 13A1 1 0 0 1 8 21H4a1 1 0 0 1-1-1v-4a1 1 0 0 1 .293-.707l10-10 3-3zM14 7.414l-9 9V19h2.586l9-9L14 7.414zm4 1.172L19.586 7 17 4.414 15.414 6 18 8.586z"
                        fill="#0D0D0D" />
                </svg>
            </button>
            @if ($sesion->estado == \App\Models\Sesion::ACTIVO)
                <span id="estado"
                    class="px-2 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:text-green-400">{{ $sesion->estado }}</span>
            @else
                <span id="estado"
                    class="px-2 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:text-red-400">{{ $sesion->estado }}</span>
            @endif
        </div>
        <div class="inline-block">
            <label for="toggle-estado" class="flex items-center cursor-pointer relative">
                <input type="checkbox" id="toggle-estado" data-user="{{ Auth::user()->id }}" data-sesion="{{ $sesion->id }}"
                    class="sr-only" {{ $sesion->estado == \App\Models\Sesion::ACTIVO ? 'checked' : '' }}>
                <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full"></div>
                {{-- <span class="ml-3 text-gray-900 text-sm font-medium">Toggle me</span> --}}
            </label>
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
                    <a href="#" class="hover:bg-gray-200 text-gray-500">XMI</a>
                    <a href="#" class="hover:bg-gray-200 text-gray-500">PNG</a>
                    <a href="#" class="hover:bg-gray-200 text-gray-500">JAVA</a>
                    <a href="#" class="hover:bg-gray-200 text-gray-500">PHP</a>
                    <a href="#" class="hover:bg-gray-200 text-gray-500">JS</a>
                </div>
            </div>
            <a href="{{ route('sesion.pizarra', $sesion->pizarras->first()->id) }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Abrir
                pizarra</a>
        </div>
        {{-- componente --}}

        <div class="mt-15 grid grid-cols-1 gap-x-14 gap-y-8 sm:grid-cols-6">
            <!-- left -->
            <div class="col-span-3 space-y-3">
                <label for="titulo"
                    class="block text-lg font-medium leading-6 text-gray-900 dark:text-white">Colaboradores</label>
                <div>
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2">
                        <ul class="divide-y divide-gray-200">
                            @forelse ($colaboradores as $colaborador)
                                <li class="p-3 flex justify-between items-center user-card">
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <img class="w-10 h-10 rounded-full object-cover" src="{{ $colaborador->foto }}"
                                                alt="{{ $colaborador->name . ' ' . $colaborador->lastname }}">
                                            <span id="online{{ $colaborador->id }}"
                                                class="conectados bottom-0 left-7 absolute  w-3.5 h-3.5 bg-red-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                        </div>
                                        <div class="ml-3">
                                            <h2 class="text-sm font-medium text-gray-800 dark:text-white ">
                                                {{ $colaborador->name . ' ' . $colaborador->lastname }}</h2>
                                            <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                {{ $colaborador->username }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="text-gray-500 hover:text-gray-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6h16M4 12h16m-7 6h7" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            @empty
                                <li class="p-3 flex justify-center text-gray-900 items-center user-card">
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
                <label for="titulo" class="block text-lg font-medium leading-6 text-gray-900 dark:text-white">
                    <div class="flex items-center space-x-2">
                        Invitados
                        <button type="button" onclick="openModal()">
                            <svg class="h-6 w-6 mx-2 hover-effect" fill="#4682B4" xmlns="http://www.w3.org/2000/svg"
                                width="800px" height="800px" viewBox="0 0 52 52" enable-background="new 0 0 52 52"
                                xml:space="preserve">
                                <g>
                                    <path
                                        d="M21.9,37c0-2.7,0.9-5.8,2.3-8.2c1.7-3,3.6-4.2,5.1-6.4c2.5-3.7,3-9,1.4-13c-1.6-4.1-5.4-6.5-9.8-6.4
                                                                                                                                                                                                                                                              s-8,2.8-9.4,6.9c-1.6,4.5-0.9,9.9,2.7,13.3c1.5,1.4,2.9,3.6,2.1,5.7c-0.7,2-3.1,2.9-4.8,3.7c-3.9,1.7-8.6,4.1-9.4,8.7
                                                                                                                                                                                                                                                              C1.3,45.1,3.9,49,8,49h17c0.8,0,1.3-1,0.8-1.6C23.3,44.5,21.9,40.8,21.9,37z" />
                                    <path
                                        d="M37.9,25c-6.6,0-12,5.4-12,12s5.4,12,12,12s12-5.4,12-12S44.5,25,37.9,25z M44,38c0,0.6-0.5,1-1.1,1H40v3
                                                                                                                                                                                                                                                              c0,0.6-0.5,1-1.1,1h-2c-0.6,0-0.9-0.4-0.9-1v-3h-3.1c-0.6,0-0.9-0.4-0.9-1v-2c0-0.6,0.3-1,0.9-1H36v-3c0-0.6,0.3-1,0.9-1h2
                                                                                                                                                                                                                                                              c0.6,0,1.1,0.4,1.1,1v3h2.9c0.6,0,1.1,0.4,1.1,1V38z" />
                                </g>
                            </svg>
                        </button>
                    </div>
                </label>
                <div>
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-2">
                        <ul class="divide-y divide-gray-200">
                            @forelse ($invitados as $invitado)
                                <li class="p-3 flex justify-between items-center user-card">
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <img class="w-10 h-10 rounded-full object-cover" src="{{ $invitado->foto }}"
                                                alt="{{ $invitado->name . ' ' . $invitado->lastname }}">

                                        </div>

                                        <div class="ml-3">
                                            <div class="flex items-center space-x-2">
                                                <h2 class="text-sm font-medium text-gray-800 dark:text-white ">
                                                    {{ $invitado->name . ' ' . $invitado->lastname }}</h2>
                                                @php
                                                    $estadoInvitacion = $invitado->sesionUser->find($sesion->id)->pivot->estado;
                                                @endphp
                                                @if ($estadoInvitacion == \App\Models\Sesion::ESPERA)
                                                    <span id="estado"
                                                        class="px-2 py-1 text-xs text-red-600 bg-red-200 rounded-full dark:text-red-400">{{ $estadoInvitacion }}</span>
                                                @else
                                                    <span id="estado"
                                                        class="px-2 py-1 text-xs text-gray-600 bg-gray-200 rounded-full dark:text-gray-400">{{ $estadoInvitacion }}</span>
                                                @endif

                                            </div>
                                            <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                {{ $invitado->username }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="text-gray-500 hover:text-gray-900">
                                            <svg class="w-6 h-6" fill="#54545C" width="800px" height="800px"
                                                viewBox="0 0 64 64" data-name="Layer 1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <title />
                                                <path
                                                    d="M55.43,55.68H8.57a5.51,5.51,0,0,1-5.5-5.5V13.82a5.51,5.51,0,0,1,5.5-5.5H55.43a5.51,5.51,0,0,1,5.5,5.5V50.18A5.51,5.51,0,0,1,55.43,55.68ZM8.57,11.32a2.5,2.5,0,0,0-2.5,2.5V50.18a2.5,2.5,0,0,0,2.5,2.5H55.43a2.5,2.5,0,0,0,2.5-2.5V13.82a2.5,2.5,0,0,0-2.5-2.5Z" />
                                                <path
                                                    d="M32,27.21a2,2,0,0,1-.42-.05l-17.25-5a1.5,1.5,0,0,1,.84-2.89L32,24.15l16.83-4.88a1.5,1.5,0,0,1,.84,2.89l-17.25,5A2,2,0,0,1,32,27.21Z" />
                                                <path
                                                    d="M39.14,49a1.49,1.49,0,0,1-1.06-.44L34.9,45.34A1.51,1.51,0,0,1,36,42.77H51.82a1.5,1.5,0,0,1,0,3H39.59l.61.62a1.51,1.51,0,0,1,0,2.12A1.53,1.53,0,0,1,39.14,49Z" />
                                                <path
                                                    d="M36,45.77a1.5,1.5,0,0,1-1.06-2.56L38.08,40a1.5,1.5,0,1,1,2.12,2.12L37,45.34A1.48,1.48,0,0,1,36,45.77Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            @empty
                                <li class="p-3 flex justify-center items-center user-card text-gray-900">
                                    <svg class="h-4 w-4 mr-2" fill="#000000" width="800px" height="800px"
                                        viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M511.728 64c108.672 0 223.92 91.534 223.92 159.854v159.92c0 61.552-25.6 179.312-94.256 233.376a63.99 63.99 0 0 0-23.968 57.809c2.624 22.16 16.592 41.312 36.848 50.625l278.496 132.064c2.176.992 26.688 5.104 26.688 39.344l.032 62.464L64 959.504V894.56c0-25.44 19.088-33.425 26.72-36.945l281.023-132.624c20.16-9.248 34.065-28.32 36.769-50.32 2.72-22-6.16-43.84-23.456-57.712-66.48-53.376-97.456-170.704-97.456-233.185v-159.92C287.615 157.007 404.016 64 511.728 64zm0-64.002c-141.312 0-288.127 117.938-288.127 223.857v159.92c0 69.872 31.888 211.248 121.392 283.088l-281.04 132.64S.001 827.999.001 863.471v96.032c0 35.344 28.64 63.968 63.951 63.968h895.552c35.344 0 63.968-28.624 63.968-63.968v-96.032c0-37.6-63.968-63.968-63.968-63.968L681.008 667.439c88.656-69.776 118.656-206.849 118.656-283.665v-159.92c0-105.92-146.64-223.855-287.936-223.855z" />
                                    </svg> Sin invitados
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- MODAL --}}
    <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7); display: none">
        <div
            class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Añadir colaboradores</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <!--Body-->
                <div class="mb-5 mt-2 body-modal h-full">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="titulo" class="block text-sm font-medium leading-6 text-gray-900">Buscar
                                usuario</label>

                            <div class="flex flex-col items-center relative">
                                <div class="w-full">
                                    <input placeholder="Buscar por el username del usuario" id="search"
                                        class="my-2 p-1 px-2 appearance-none outline-none w-full h-10 text-gray-800 flex border border-gray-200 rounded">
                                </div>
                                <div id="searchList"
                                    class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                                    <div class="flex flex-col w-full" id="divSearch" style="display: none">
                                        {{-- user encontrado --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-span-full">
                            <table id="tb-usuario"
                                class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Usuarios(<span
                                                class="cantidadUsuarios">0</span>)</th>

                                        <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                                    {{-- tr del tbody --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button
                        class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancelar</button>
                    <form id="invitacionForm" method="POST" action="{{ route('invitacion.store') }}">
                        @csrf
                        <input type="hidden" id="colaboradores" name="colaboradores">
                        <input type="hidden" name="sesion_id" value="{{ $sesion->id }}">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400">Enviar
                            invitación</button>
                    </form>
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
            z-index: 1;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9;
        }

        .dropdown-content a {
            padding: 5px 10px;
            text-decoration: none;
            display: block;
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
    <style>
        .modal-container {
            width: 80%;
            max-width: 100%;
            max-height: 100%;
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            height: 90vh;
            /* Ajusta este valor para cambiar la altura del cuerpo del modal */
        }

        .modal-content .modal-header,
        .modal-content .modal-footer {
            flex-shrink: 0;
            /* Esto hace que el título y el pie de página sean estáticos */
        }


        .body-modal {
            height: 80%;
            /* Ajusta este valor para cambiar la altura */
            overflow-y: auto;
            /* Esto añade un scroll al cuerpo del modal si el contenido es demasiado grande */
        }

        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .animated.faster {
            -webkit-animation-duration: 500ms;
            animation-duration: 500ms;
        }

        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }

        .fadeOut {
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
    {{-- JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.bundle.js"></script>
    <script>
        $(document).ready(function() {
            // Agrega un evento de clic a cada botón    
            $(".dropbtn").click(function(event) {
                event.stopPropagation();

                // Encuentra el contenido del menú desplegable correspondiente
                var dropdownContent = $(this).next();

                // Cierra todos los menús desplegables abiertos
                $(".dropbtn").each(function() {
                    var openDropdown = $(this).next();
                    if (openDropdown !== dropdownContent && openDropdown.hasClass('show')) {
                        openDropdown.removeClass('show');
                    }
                });

                // Muestra u oculta el contenido del menú desplegable
                dropdownContent.toggleClass("show");
            });

            // Cierra todos los menús desplegables cuando se hace clic fuera de ellos
            $(window).click(function(event) {
                if (!$(event.target).hasClass('dropbtn')) {
                    $(".dropdown-content").each(function() {
                        var openDropdown = $(this);
                        if (openDropdown.hasClass('show')) {
                            openDropdown.removeClass('show');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let colaboradores = [];

            // Invitacion
            $('#invitacionForm').on('submit', function() {
                // Convierte el vector de colaboradores a una cadena JSON
                var colaboradoresJson = JSON.stringify(colaboradores);

                // Actualiza el valor del campo oculto con la cadena JSON
                $('#colaboradores').val(colaboradoresJson);
            });


            // input search
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search').length && !$(event.target).closest('#divSearch')
                    .length) {
                    $('#divSearch').hide();
                }
            });

            $('#search').on('focus keyup', function() {
                $('#divSearch').show();
                var query = $(this).val();
                console.log("query: ", query);
                var apiUrl = new URL('/api/search', window.location.origin);
                $.ajax({
                    url: apiUrl.toString(),
                    type: "GET",
                    data: {
                        'query': query,
                        'user_id': userId,
                        'sesion_id': sesionId
                    },
                    success: function(data) {
                        console.log("result: ", data);
                        var html = '';
                        console.log("cantidad de usuarios: ", data.length);
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                html +=
                                    '<div class="colaborador cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100" id="' +
                                    value.id + '" data-name="' + value.name + " " +
                                    value.lastname + '" data-image="' + value.foto +
                                    '" data-username="' + value.username + '">';
                                html +=
                                    '<div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">';
                                html += '<div class="w-6 flex flex-col items-center">';
                                html +=
                                    '<div class="flex relative w-8 h-8 bg-orange-500 justify-center items-center m-1 mr-2 mt-1 rounded-full ">';
                                html +=
                                    '<img class="rounded-full w-full h-full object-cover" alt="A" src="' +
                                    value.foto + '">';
                                html += '</div></div>';
                                html += '<div class="w-full items-center flex">';
                                html += '<div class="mx-2 -mt-1  ">' + value.name +
                                    ' ' + value.lastname;
                                html +=
                                    '<div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">' +
                                    value.username + '</div>';
                                html += '</div></div></div></div>';
                            });
                        }
                        $('#divSearch').html(html);
                    }
                })

            });
            //delete colaborador
            $(document).on('click', '.btn-delete', function() {
                // Obtiene el 'tr' que contiene el botón
                var tr = $(this).closest('tr');
                var id = tr.attr('id');

                // Elimina el 'tr'
                tr.remove();

                // Elimina el elemento del vector
                var index = colaboradores.indexOf(id);
                if (index > -1) {
                    colaboradores.splice(index, 1);
                    $('.cantidadUsuarios').text(colaboradores.length);
                }

                console.log("tamaño del vector colaboradores: ", colaboradores.length);
            });
            //add colaborador
            $(document).on('click', '.colaborador', function() {
                const id = $(this).attr('id');
                const image = $(this).data('image');
                const name = $(this).data('name');
                const username = $(this).data('username');
                console.log("id colaborado: ", id);
                console.log("name colaborado: ", name);
                console.log("username colaborado: ", username);
                console.log("image colaborado: ", image);
                if (!colaboradores.includes(id)) {
                    colaboradores.push(id);
                    $('.cantidadUsuarios').text(colaboradores.length);
                    // Agrega una nueva fila a la tabla
                    $('#tb-usuario').append(`
            <tr id="${id}" class="hover:bg-gray-50">
                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="relative h-10 w-10">
                        <img class="h-full w-full rounded-full object-cover object-center"
                            src="${image}"
                            alt="" />
                    </div>
                    <div class="text-sm">
                        <div class="font-medium text-gray-700">${name}</div>
                        <div class="text-gray-400">${username}</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    <div class="flex justify-end gap-4">
                        <button type="button" class="btn-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="h-6 w-6" x-tooltip="tooltip">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `);
                }
                console.log("tamaño del vector colaboradores: ", colaboradores.length);
            });


         
        });
    </script>
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
    <script>
        const modal = document.querySelector('.main-modal');
        const closeButton = document.querySelectorAll('.modal-close');

        const modalClose = () => {
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }

        const openModal = () => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';
        }

        for (let i = 0; i < closeButton.length; i++) {

            const elements = closeButton[i];

            elements.onclick = (e) => modalClose();

            modal.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == modal) modalClose();
            }
        }
    </script>
@endsection
