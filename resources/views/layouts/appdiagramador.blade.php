<!DOCTYPE html>

<html lang="es" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagramador App</title>
    @php
        $logo = session('logo');
    @endphp
    <link rel="icon"
        href="{{ $logo == 'D' || $logo == 'N' || $logo == 'C' || $logo == 'A' ? asset('estilos_tecno/img/logo.png') : asset('estilos_tecno/img/logo_white.png') }}"
        type="image/png">
    <!-- Agrega el enlace a tu archivo de estilos generado por Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset(session('estilo_actual', 'estilos_tecno/theme/dia.css')) }}">
    {{-- <link rel="stylesheet" href="{{ asset('template/assets/css/owl-carousel.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('estilos_tecno/css/carousel.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('estilos_tecno/css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('estilos_tecno/css/animacion.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="{{ asset('../estilos_tecno/js/nav.js') }}"></script>
    {{-- <script src="{{ asset('../estilos_tecno/js/carousel.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('estilos_tecno/js/carrito.js') }}"></script> --}}
    <script src="https://cdn.socket.io/4.7.4/socket.io.min.js"
        integrity="sha384-Gr6Lu2Ajx28mzwyVR8CFkULdCU7kMlZ9UthllibdOSo6qAiN+yXNHqtgdTvFXMT4" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/gojs@2.3.13/release/go.js"></script>

    {{-- <script src="{{asset('estilos_tecno/js/palette.js')}}"></script> --}}
    {{-- CONEXION SOCKET --}}
    <script>
        // let ip_address = "192.168.0.14"
        let ip_address = "https://diagramadorsocket.onrender.com"
        // let port = "3000";
        let socket = io(ip_address);// + ":" + port);
    </script>
    {{-- bootstrap 5 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>


<body class="h-full" data-bs-theme="light">
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
    <div class="min-h-full">
        <nav class="bg-gray-700 navegacion">
            <div class="mx-auto max-w-full w-full px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">

                        <div class="flex-shrink-0">
                            <a href="{{ route('welcome') }}">
                                <img class="h-8 w-8"
                                    src="{{ $logo == 'J' ? asset('estilos_tecno/img/logo_blue.png') : asset('estilos_tecno/img/logo_white.png') }}"
                                    alt="Diagramador app">
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div id="menu" class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="{{ route('welcome') }}"
                                    class="menu-link {{ Route::is('welcome') ? 'active' : '' }} color-texto ">Inicio</a>
                                {{-- <a href="{{ route('fotografo') }}"
                                    class="menu-link {{ Route::is('fotografo') ? 'active' : '' }} color-texto ">Fotografos</a> --}}
                                <a href="{{ route('sesion.index') }}"
                                    class="menu-link {{ Route::is('sesion.index') || Route::is('sesion.show') ? 'active' : '' }} color-texto ">Sesion</a>
                                {{-- <a href="{{ route('cliente.galeria.index') }}"
                                    class="menu-link {{ Route::is('cliente.galeria.index') ? 'active' : '' }} color-texto ">Galería</a>
                                <a href="{{ route('cliente.pago.index') }}"
                                    class="menu-link {{ Route::is('cliente.pago.index') ? 'active' : '' }} color-texto ">Pagos</a> --}}

                            </div>
                        </div>
                    </div>

                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <x-dropdown-notifications align="right" />
                            <!-- Profile dropdown -->
                            <div class="relative ml-3">
                                <div>
                                    <button type="button"
                                        class="relative flex max-w-xs items-center rounded-full background-button text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        @auth
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->foto }}"
                                                alt="">

                                        @endauth
                                        @guest
                                            <img class="h-8 w-8 rounded-full "
                                                src="{{ $logo == 'J' ? asset('estilos_tecno/img/user_blue.png') : asset('estilos_tecno/img/user_white.png') }}"
                                                alt="">
                                        @endguest

                                    </button>
                                </div>
                                <div id="user-menu"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    @auth
                                        <div>
                                            <div class="block px-4 py-2 text-sm text-gray-500 ">
                                                {{ Auth::user()->name }}
                                                {{ Auth::user()->lastname }}</div>
                                            <div class="px-4 pb-2 text-sm text-gray-400" style="overflow-wrap: break-word;">
                                                {{ Auth::user()->email }}
                                            </div>

                                        </div>
                                        <hr>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                            tabindex="-1" id="user-menu-item-0">Perfil</a>

                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                            tabindex="-1" id="user-menu-item-1">Notificaciones</a>
                                        <a href="{{ route('configuracion') }}"
                                            class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                            id="user-menu-item-1">Configuración</a>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                            id="user-menu-item-2">Salir</a>

                                        <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    @endauth

                                    <!-- Menú si no está autenticado -->
                                    @guest
                                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem" tabindex="-1" id="user-menu-item-0">Register</a>
                                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem" tabindex="-1" id="user-menu-item-2">Login</a>
                                        <a href="{{ route('configuracion') }}"
                                            class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                            id="user-menu-item-1">Configuración</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button id="mobile-menu-button" type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                    <a href="{{ route('welcome') }}"
                        class="menu-link block rounded-md px-3 py-2 text-base font-medium color-texto {{ Route::is('welcome') ? 'active' : '' }} color-texto "
                        aria-current="page">Inicio</a>
                    <a href="{{ route('sesion.index') }}"
                        class="menu-link block rounded-md px-3 py-2 text-base font-medium color-texto {{ Route::is('sesion') ? 'active' : '' }} color-texto ">Sesion</a>
                    {{-- <a href="{{ route('galeria') }}"
                        class="menu-link block rounded-md px-3 py-2 text-base font-medium color-texto {{ Route::is('galeria') ? 'active' : '' }} color-texto ">Galeria</a>
                    <a href="{{ route('pago') }}"
                        class="menu-link block rounded-md px-3 py-2 text-base font-medium color-texto {{ Route::is('pago') ? 'active' : '' }} color-texto ">Pagos</a> --}}
                    {{-- <a href="#"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Estilos</a> --}}

                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                    @auth
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->foto }}" alt="">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}
                                    {{ Auth::user()->lastname }}</div>
                                <div class="text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            @if (Auth::user()->tipo != 'C')
                                <a href="#"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Perfil</a>
                                <a href="{{ route('dashboard') }}"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Dashboard</a>
                                <a href="{{ route('configuracion') }}"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Configuración</a>

                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">
                                    Salir
                                </a>
                            @else
                                <a href="#"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Perfil</a>
                                <a href="{{ route('configuracion') }}"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Configuración</a>

                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">
                                    Salir
                                </a>
                            @endif
                        </div>
                    @endauth

                    @guest
                        <div class="border-t border-gray-700 pb-3 pt-4">
                            <div class="flex items-center px-5">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full"
                                        src="{{ $logo == 'J' ? asset('estilos_tecno/img/user_blue.png') : asset('estilos_tecno/img/user_white.png') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="mt-3 space-y-1 px-2">
                                <a href="{{ route('register') }}"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Register</a>

                                <a href="{{ route('login') }}"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Login</a>

                                <a href="{{ route('configuracion') }}"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white color-texto">Configuración</a>
                            </div>

                        </div>
                    @endguest
                </div>
            </div>
        </nav>



        @if (Route::is('welcome'))
            <header class="bg-white shadow active">
                <div class="header-container">
                    <img class="header-image" src="{{ asset('estilos_tecno/img/fondo_diagramador.jpeg') }}"
                        alt="Logo de la empresa">
                    <div class="title-container" id="titleContainer"></div>
                    <h1 class="title-static">DIAGRAMADOR</h1>
                </div>
            </header>
        @else
            <header class="bg-white shadow">
                <div class="mx-auto max-w-full px-4 py-2 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900"> @yield('header')</h1>
                </div>
            </header>
        @endif
        <main class="bg-gray-100">
            <div class="max-w-full max-h-full h-full">
                @yield('contenido')
            </div>
        </main>
    </div>
    @if (Route::is('sesion.show') || Route::is('sesion.other.show') || Route::is('sesion.pizarra'))
        <script>
             let usuariosPrevios = []; //usuarios que se conectan
                var show = $("#sesion-title");
                console.log("iniciando: ", show);
                var pizarra='';
                if (show.length == 0) {
                    console.log("está en la pantalla de la pizarra");
                    show = $("#contenedor-diagrama");
                    pizarra=show.data('pizarra');
                    console.log(show);
                } else {
                    console.log("está en show y other show");
                }
                var userId = show.data('user');
                var sesionId = show.data('sesion');
                var estado = show.data('estado');
            $(document).ready(function() {
                // let usuariosPrevios = []; //usuarios que se conectan
                // var show = $("#sesion-title");
                // console.log("iniciando: ", show);
                // if (show.length == 0) {
                //     console.log("está en la pantalla de la pizarra");
                //     show = $("#contenedor-diagrama");
                //     console.log(show);
                // } else {
                //     console.log("está en show y other show");
                // }
                // var userId = show.data('user');
                // var sesionId = show.data('sesion');
                // var estado = show.data('estado');

                var canal = 'canal' + sesionId;
                console.log("user id: ", userId);
                console.log("sesion id: ", sesionId);
                console.log("estado id: ", estado);
                if (estado == "Activo") {
                    socket.emit('unirse', {
                        canal: canal,
                        userId: userId
                    });
                }

                socket.on('usuariosConectados', function(datos) {
                    console.log("DATOS:   ", datos);
                    var usuarios = datos.usuarios;
                    var canal = datos.canal;
                    if (canal == "canal" + sesionId) {
                        console.log('Usuarios conectados:', usuarios);
                        if (usuariosPrevios.length == 0) {
                            $('#estado').removeClass(
                                'text-red-600 bg-red-100 dark:text-red-400'
                            );
                            $('#estado').addClass(
                                'text-green-600 bg-green-100 dark:text-green-400');
                            $('#estado').text('Activo');
                            socket.emit('unirse', {
                                canal: canal,
                                userId: userId
                            });
                        }
                        // Cambiar el color de los usuarios que se han desconectado
                        usuariosPrevios.forEach(id => {
                            if (!usuarios.includes(id)) {
                                $('#online' + id).removeClass('bg-green-400').addClass('bg-red-400');
                            }
                        });

                        // Cambiar el color de los usuarios que están conectados
                        usuarios.forEach(id => {
                            $('#online' + id).removeClass('bg-red-400').addClass('bg-green-400');
                        });

                        // Actualizar la lista de usuarios previos
                        usuariosPrevios = usuarios;
                    }
                });
                socket.on('canalCerrado', function(datos) {
                    var canal = datos.canal;
                    console.log('canal cerrado, usuario conectados:', canal);
                    if ("canal" + sesionId == canal) {
                        usuariosPrevios.forEach(id => {
                            var span = $('#online' + id);
                            if (span != null) {
                                $('#online' + id).removeClass('bg-green-400').addClass('bg-red-400');
                            }
                        });
                        var cestado = $('#estado');
                        cestado.removeClass(
                            'text-green-600 bg-green-100 dark:text-green-400'
                        );
                        cestado.addClass(
                            'text-red-600 bg-red-100 dark:text-red-400');
                        cestado.text('Inactivo');

                        usuariosPrevios = [];
                    }

                });
                $(window).on('beforeunload', function(event) {
                    // event.preventDefault();
                    var show = $("#sesion-title");
                    console.log("iniciando: ", show);
                    if (show.length == 0) {
                        console.log("está en la pantalla de la pizarra");
                        show = $("#contenedor-diagrama");
                        console.log(show);
                    }
                    var estadosalir = $("#estado").text().trim();
                    console.log("estado antes de salir: ", estadosalir);

                    if (estadosalir == "Activo") {
                        console.log("Entra al emit estado");
                        // return false;
                        socket.emit('dejar', {
                            canal: canal,
                            userId: userId
                        });
                    }
                });
                // si está en show
                var toggle = $("#toggle-estado");
                if (toggle != null) {
                    var apiUrlA = new URL('/api/activar/estado', window.location.origin);
                    var apiUrlB = new URL('/api/desactivar/estado', window.location.origin);
                    var formData = new FormData();
                    formData.append('user_id', userId);
                    formData.append('sesion_id', sesionId);
                    $(toggle).change(function() {
                        if (this.checked) {
                            console.log("Es checkeado");
                            $.ajax({
                                url: apiUrlA
                                    .toString(), // reemplaza esto con tu URL de la API
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(data) {
                                    console.log('Petición exitosa:', data);
                                    $('#estado').removeClass(
                                        'text-red-600 bg-red-100 dark:text-red-400');
                                    $('#estado').addClass(
                                        'text-green-600 bg-green-100 dark:text-green-400'
                                    );
                                    $('#estado').text('Activo');
                                    // Reemplaza esto con el nombre de tu canal
                                    socket.emit('unirse', {
                                        canal: canal,
                                        userId: userId
                                    });
                                },
                                error: function(error) {
                                    console.log('Error en la petición:', error);
                                }
                            });
                        } else {
                            console.log("No es checkeado");
                            $.ajax({
                                url: apiUrlB
                                    .toString(), // reemplaza esto con tu URL de la API
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(data) {
                                    console.log('Petición exitosa:', data);
                                    $('#estado').removeClass(
                                        'text-green-600 bg-green-100 dark:text-green-400'
                                    );
                                    $('#estado').addClass(
                                        'text-red-600 bg-red-100 dark:text-red-400');
                                    $('#estado').text('Inactivo');
                                    socket.emit('cerrarCanal', canal);
                                },
                                error: function(error) {
                                    console.log('Error en la petición:', error);
                                }
                            });
                        }
                    });
                }
            });
        </script>
    @endif
    @if (Route::is('sesion.show'))
        <script>
            $(document).ready(function() {
                // let usuariosPrevios = [];
                // var apiUrlA = new URL('/api/activar/estado', window.location.origin);
                // var apiUrlB = new URL('/api/desactivar/estado', window.location.origin);
                // const userId = $("#sesion-title").data('user');
                // const sesionId = $("#sesion-title").data('sesion');

                // console.log("url A: ", apiUrlA);
                // console.log("url B: ", apiUrlB);
                // console.log("user id: ", userId);
                // console.log("sesion id: ", sesionId);
                // var formData = new FormData();
                // formData.append('user_id', userId);
                // formData.append('sesion_id', sesionId);

                // // SOCKET DIAGRAMADOR
                // var canal = 'canal' + sesionId;
                // El resto de tu código...
                // if ($("#toggle-estado").is(':checked')) {
                //     console.log("uniendose al canal ", canal);
                //     socket.emit('unirse', {
                //         canal: canal,
                //         userId: userId
                //     });
                //     console.log("luego del emit socket");
                // }
                // Escucha la respuesta del servidor

                // socket.on('usuariosConectados', function(usuarios) {
                //     console.log('Usuarios conectados:', usuarios);
                //     // Cambiar el color de los usuarios que se han desconectado
                //     usuariosPrevios.forEach(id => {
                //         if (!usuarios.includes(id)) {
                //             $('#online' + id).removeClass('bg-green-400').addClass('bg-red-400');
                //         }
                //     });

                //     // Cambiar el color de los usuarios que están conectados
                //     usuarios.forEach(id => {
                //         $('#online' + id).removeClass('bg-red-400').addClass('bg-green-400');
                //     });

                //     // Actualizar la lista de usuarios previos
                //     usuariosPrevios = usuarios;
                // });

                // socket.on('canalCerrado', function(canal) {
                //     console.log('canal cerrado, usuario conectados:', canal);
                //     usuariosPrevios.forEach(id => {
                //         var span = $('#online' + id);
                //         if (span != null) {
                //             $('#online' + id).removeClass('bg-green-400').addClass('bg-red-400');
                //         }
                //     });
                //     usuariosPrevios = [];
                // });
                // cambiar de estado
                // $('#toggle-estado').change(function() {
                //     if (this.checked) {
                //         console.log("Es checkeado");
                //         $.ajax({
                //             url: apiUrlA
                //                 .toString(), // reemplaza esto con tu URL de la API
                //             type: 'POST',
                //             processData: false,
                //             contentType: false,
                //             data: formData,
                //             success: function(data) {
                //                 console.log('Petición exitosa:', data);
                //                 $('#estado').removeClass(
                //                     'text-red-600 bg-red-100 dark:text-red-400');
                //                 $('#estado').addClass(
                //                     'text-green-600 bg-green-100 dark:text-green-400'
                //                 );
                //                 $('#estado').text('Activo');
                //                 // Reemplaza esto con el nombre de tu canal
                //                 socket.emit('unirse', {
                //                     canal: canal,
                //                     userId: userId
                //                 });
                //             },
                //             error: function(error) {
                //                 console.log('Error en la petición:', error);
                //             }
                //         });
                //     } else {
                //         console.log("No es checkeado");
                //         $.ajax({
                //             url: apiUrlB
                //                 .toString(), // reemplaza esto con tu URL de la API
                //             type: 'POST',
                //             processData: false,
                //             contentType: false,
                //             data: formData,
                //             success: function(data) {
                //                 console.log('Petición exitosa:', data);
                //                 $('#estado').removeClass(
                //                     'text-green-600 bg-green-100 dark:text-green-400'
                //                 );
                //                 $('#estado').addClass(
                //                     'text-red-600 bg-red-100 dark:text-red-400');
                //                 $('#estado').text('Inactivo');
                //                 socket.emit('cerrarCanal', canal);
                //             },
                //             error: function(error) {
                //                 console.log('Error en la petición:', error);
                //             }
                //         });
                //     }
                // });
            });
        </script>
    @endif

    @if (Route::is('sesion.pizarra'))
      
        <script src="{{ asset('estilos_tecno/js/secuencia.js') }}"></script>
    @endif
    @if (Route::is('sesion.other.show'))
        <script>
            $(document).ready(function() {
                // let usuariosPrevios = [];
                // var userId = $('#sesion-title').data('user');
                // var sesionId = $('#sesion-title').data('sesion');
                // var estado = $('#sesion-title').data('estado');
                // var canal = 'canal' + sesionId;
                // if (estado == "Activo") {
                //     console.log("se une??")
                //     socket.emit('unirse', {
                //         canal: canal,
                //         userId: userId
                //     });
                // }
                // //   RESPUESTA DEL SERVIDOR SOCKET
                // socket.on('usuariosConectados', function(usuarios) {
                //     console.log('Usuarios conectados:', usuarios);
                //     // Cambiar el color de los usuarios que se han desconectado
                //     if (usuariosPrevios.length == 0) {
                //         $('#estado').removeClass(
                //             'text-red-600 bg-red-100 dark:text-red-400'
                //         );
                //         $('#estado').addClass(
                //             'text-green-600 bg-green-100 dark:text-green-400');
                //         $('#estado').text('Activo');
                //         socket.emit('unirse', {
                //             canal: canal,
                //             userId: userId
                //         });
                //     }
                //     usuariosPrevios.forEach(id => {
                //         if (!usuarios.includes(id)) {
                //             $('#online' + id).removeClass('bg-green-400').addClass('bg-red-400');
                //         }
                //     });

                //     // Cambiar el color de los usuarios que están conectados
                //     usuarios.forEach(id => {
                //         $('#online' + id).removeClass('bg-red-400').addClass('bg-green-400');
                //     });

                //     // Actualizar la lista de usuarios previos
                //     usuariosPrevios = usuarios;
                // });
                // socket.on('canalCerrado', function(canal) {
                //     console.log('canal cerrado, usuario conectados:', canal);
                //     $('#estado').removeClass(
                //         'text-green-600 bg-green-100 dark:text-green-400'
                //     );
                //     $('#estado').addClass(
                //         'text-red-600 bg-red-100 dark:text-red-400');
                //     $('#estado').text('Inactivo');
                //     usuariosPrevios.forEach(id => {
                //         $('#online' + id).removeClass('bg-green-400').addClass('bg-red-400');
                //     });
                //     usuariosPrevios = [];
                // });

                // // DETECTAR CUANDO SE ESTA SALIENDO DE LA SESION
                // $(window).on('beforeunload', function() {
                //     socket.emit('dejar', {
                //         canal: canal,
                //         userId: userId
                //     });
                // });
                $('#btn-aceptar').click(function() {
                    $('input[name="respuesta"]').val('Aceptada');
                    $('#form-invitacion').submit();
                });

                $('#btn-rechazar').click(function() {
                    $('input[name="respuesta"]').val('Rechazada');
                    $('#form-invitacion').submit();
                });
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
    @endif
    <script>
        var menu = document.getElementById('user-menu');
        menu.style.display = 'none';

        document.addEventListener('click', function(event) {
            var button = document.getElementById('user-menu-button');
            var menu = document.getElementById('user-menu');

            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.style.display = 'none';
            }
        });

        document.getElementById('user-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('user-menu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        });
    </script>
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    <style>
        /* Agrega estilos según tus necesidades para un tema oscuro */
        .sweetalert-dark {
            background-color: #333;
            color: #fff;
            /* Otros estilos... */
        }
    </style>
</body>

</html>
