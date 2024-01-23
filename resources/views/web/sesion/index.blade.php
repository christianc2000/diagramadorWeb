@extends('layouts.appdiagramador')
@section('header')
    Sesiones
@endsection
@section('contenido')
    <div class="mx-auto py-6 sm:px-6 lg:px-8 space-y-6">
        {{-- <div class="flex items-center">
            <h2 class="text-lg font-medium text-gray-700 ">Sesiones
            </h2>
        </div>

        <p class="mt-1 text-sm text-gray-500">Sesión de desarrollo colaborativo de diagrama de secuencia
        </p> --}}

        <div class="md:flex md:items-center md:justify-between">
            <div
                class="inline-flex overflow-hidden bg-gray-300 border divide-x rounded-lg rtl:flex-row-reverse border-gray-400 divide-gray-400">
                <button id="btn-todo" class="px-5 py-2 btn text-xs font-medium text-gray-700 btn-activo hover:bg-gray-100">
                    Ver todo
                </button>

                <button id="btn-my"
                    class="px-5 py-2 btn text-xs font-medium text-gray-700 transition-colors duration-200 hover:bg-gray-100">
                    Mis sesiones
                </button>

                <button id="btn-other"
                    class="px-5 py-2 btn text-xs font-medium text-gray-700 transition-colors duration-200 hover:bg-gray-100">
                    Otras sesiones
                </button>
            </div>
            {{-- buscador --}}
            <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input type="text" placeholder="Buscar sesión"
                    class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 focus:border-blue-700 dark:focus:border-blue-700 focus:ring-blue-700 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
        </div>
        <!-- component -->
        {{-- all --}}
        <section class="w-full flex flex-wrap" id="all">
            @foreach ($allsesiones as $sesion)
                <div class="lg:w-1/3 md:w-1/2 pr-4 pb-4 w-full">
                    <div
                        class="p-8 rounded-xl border border-gray-200 bg-white duration-300 hover:scale-105 hover:shadow-xl shadow-md">
                        <a
                            href="{{ isset($sesion->pivot) ? route('sesion.other.show', $sesion->id) : route('sesion.show', $sesion->id) }}">
                            <div class="my-4 flex flex-col text-base items-center justify-center h-32">
                                <svg class="h-10 w-10" width="800px" height="800px" viewBox="0 0 512 512" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>project</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Combined-Shape" fill="#000000" transform="translate(64.000000, 34.346667)">
                                            <path
                                                d="M192,7.10542736e-15 L384,110.851252 L384,332.553755 L192,443.405007 L1.42108547e-14,332.553755 L1.42108547e-14,110.851252 L192,7.10542736e-15 Z M42.666,157.654 L42.6666667,307.920144 L170.666,381.82 L170.666,231.555 L42.666,157.654 Z M341.333,157.655 L213.333,231.555 L213.333,381.82 L341.333333,307.920144 L341.333,157.655 Z M192,49.267223 L66.1333333,121.936377 L192,194.605531 L317.866667,121.936377 L192,49.267223 Z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <h2 class="text-lg font-medium text-gray-700 uppercase text-center"
                                    style="overflow-wrap: break-word;">{{ $sesion->titulo }} ({{$sesion->id}})
                                </h2>
                                <div class="pt-1">
                                    @if ($sesion->estado == \App\Models\Sesion::ACTIVO)
                                        <span id="estado{{ $sesion->id }}"
                                            class="estado{{ $sesion->id }} px-2 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:text-green-400">{{ $sesion->estado }}</span>
                                    @else
                                        <span id="estado{{ $sesion->id }}"
                                            class="estado{{ $sesion->id }} px-2 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:text-red-400">{{ $sesion->estado }}</span>
                                    @endif
                                </div>

                            </div>

                        </a>
                    </div>
                </div>
            @endforeach
        </section>
        {{-- my --}}
        <section class="w-full flex flex-wrap" id="my" style="display: none">
            <div class="lg:w-1/3 md:w-1/2 pr-4 pb-4 w-full">
                <div class="p-8 rounded-xl border border-gray-200 bg-white">
                    <button type="button" onclick="openModal()" class="w-full h-full">
                        <div class="my-4 flex flex-col text-base items-center justify-center h-32">
                            <svg class="h-8 w-8" width="800px" height="800px" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7 7V1H8V7H14V8H8V14H7V8H1V7H7Z"
                                    fill="#000000" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
            @foreach ($sesiones as $sesion)
                <div class="lg:w-1/3 md:w-1/2 pr-4 pb-4 w-full">
                    <div
                        class="p-8 rounded-xl border border-gray-200 bg-white duration-300 hover:scale-105 hover:shadow-xl shadow-md">
                        <a href="{{ route('sesion.show', $sesion->id) }}">
                            <div class="my-4 flex flex-col text-base items-center justify-center h-32">
                                <svg class="h-10 w-10" width="800px" height="800px" viewBox="0 0 512 512" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>project</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Combined-Shape" fill="#000000" transform="translate(64.000000, 34.346667)">
                                            <path
                                                d="M192,7.10542736e-15 L384,110.851252 L384,332.553755 L192,443.405007 L1.42108547e-14,332.553755 L1.42108547e-14,110.851252 L192,7.10542736e-15 Z M42.666,157.654 L42.6666667,307.920144 L170.666,381.82 L170.666,231.555 L42.666,157.654 Z M341.333,157.655 L213.333,231.555 L213.333,381.82 L341.333333,307.920144 L341.333,157.655 Z M192,49.267223 L66.1333333,121.936377 L192,194.605531 L317.866667,121.936377 L192,49.267223 Z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <h2 class="text-lg font-medium text-gray-700 uppercase text-center"
                                    style="overflow-wrap: break-word;">{{ $sesion->titulo }} ({{$sesion->id}})
                                </h2>
                                <div class="pt-1">
                                    @if ($sesion->estado == \App\Models\Sesion::ACTIVO)
                                        <span id="estado{{ $sesion->id }}"
                                            class="estado{{ $sesion->id }} px-2 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:text-green-400">{{ $sesion->estado }}</span>
                                    @else
                                        <span id="estado{{ $sesion->id }}"
                                            class="estado{{ $sesion->id }} px-2 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:text-red-400">{{ $sesion->estado }}</span>
                                    @endif
                                </div>

                            </div>

                        </a>
                    </div>
                </div>
            @endforeach
        </section>
        {{-- other --}}
        <section class="w-full flex flex-wrap" id="other" style="display: none">
            @foreach ($othersesiones as $sesion)
                <div class="lg:w-1/3 md:w-1/2 pr-4 pb-4 w-full">
                    <div
                        class="p-8 rounded-xl border border-gray-200 bg-white duration-300 hover:scale-105 hover:shadow-xl shadow-md">
                        <a href="{{ route('sesion.other.show', $sesion->id) }}">
                            <div class="my-4 flex flex-col text-base items-center justify-center h-32">
                                <svg class="h-10 w-10" width="800px" height="800px" viewBox="0 0 512 512"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>project</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="Combined-Shape" fill="#000000"
                                            transform="translate(64.000000, 34.346667)">
                                            <path
                                                d="M192,7.10542736e-15 L384,110.851252 L384,332.553755 L192,443.405007 L1.42108547e-14,332.553755 L1.42108547e-14,110.851252 L192,7.10542736e-15 Z M42.666,157.654 L42.6666667,307.920144 L170.666,381.82 L170.666,231.555 L42.666,157.654 Z M341.333,157.655 L213.333,231.555 L213.333,381.82 L341.333333,307.920144 L341.333,157.655 Z M192,49.267223 L66.1333333,121.936377 L192,194.605531 L317.866667,121.936377 L192,49.267223 Z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <h2 class="text-lg font-medium text-gray-700 uppercase text-center"
                                    style="overflow-wrap: break-word;">{{ $sesion->titulo }} ({{$sesion->id}})
                                </h2>
                                <div class="pt-1">
                                    @if ($sesion->estado == \App\Models\Sesion::ACTIVO)
                                        <span id="estado{{ $sesion->id }}"
                                            class="estado{{ $sesion->id }} px-2 py-1 text-xs text-green-600 bg-green-100 rounded-full dark:text-green-400">{{ $sesion->estado }}</span>
                                    @else
                                        <span id="estado{{ $sesion->id }}"
                                            class="estado{{ $sesion->id }} px-2 py-1 text-xs text-red-600 bg-red-100 rounded-full dark:text-red-400">{{ $sesion->estado }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    {{-- MODAL --}}
    <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div
            class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Crear sesión</p>
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
                <form action="{{ route('sesion.store') }}" method="POST">
                    @csrf
                    <div class="mb-5 mt-2">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="titulo"
                                    class="block text-sm font-medium leading-6 text-gray-700">Título</label>
                                <div>
                                    <input type="text" name="titulo" id="titulo" autocomplete="given-titulo"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <span id="errorTitulo"
                                        class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button type="button"
                            class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancelar</button>
                        <button type="submit"
                            class="focus:outline-none px-4 bg-teal-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
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

        .btn-activo {
            background-color: #ffffff;
            /* color de fondo cuando está activo */
            color: #374151;
            /* color del texto cuando está activo */
        }
    </style>
    {{-- JS --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // SESIONES
            socket.on('sesionActiva', function(sesion) {
                console.log('sesion activa:', sesion);
                let str = sesion;
                let num = str.substring(5); 
                var spans = $(".estado" + num);
                console.log("buscando el span: .estado"+num);
                spans.each(function() {
                    $(this).removeClass('text-red-600 bg-red-100 dark:text-red-400');
                    $(this).addClass('text-green-600 bg-green-100 dark:text-green-400');
                    $(this).text('Activo');
                });
                console.log(num)
            });

            socket.on('canalCerrado', function(datos) {
                var canal=datos.canal;
                console.log("canal cerrado: ",canal);
                let str = canal;
                let num = str.substring(5); 
                var spans = $(".estado" + num);
                spans.each(function() {
                    $(this).removeClass('text-green-600 bg-green-100 dark:text-green-400');
                    $(this).addClass('text-red-600 bg-red-100 dark:text-red-400');
                    $(this).text('Inactivo');
                });
                console.log(num)
            });




            $('#btn-todo').click(function() {
                $('.btn').removeClass('btn-activo');
                $(this).addClass('btn-activo');
                // Oculta todas las filas que no son de encabezado
                $('#my').hide();
                $('#other').hide();
                // Muestra todas las filas que no son de encabezado
                $('#all').show();
            });
            $('#btn-my').click(function() {
                $('.btn').removeClass('btn-activo');
                $(this).addClass('btn-activo');
                // Oculta todas las filas que no son de encabezado
                $('#all').hide();
                $('#other').hide();
                // Muestra solo las filas que corresponden a enfermeras
                $('#my').show();
            });
            $('#btn-other').click(function() {
                $('.btn').removeClass('btn-activo');
                $(this).addClass('btn-activo');
                // Oculta todas las filas que no son de encabezado
                $('#all').hide();
                $('#my').hide();
                // Muestra solo las filas que corresponden a médicos
                $('#other').show();
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
