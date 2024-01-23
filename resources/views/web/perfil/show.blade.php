@extends('layouts.appdiagramador')
@section('contenido')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            {{-- seccion update perfil informacion --}}
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-section-title>
                        <x-slot name="title">Información del perfil</x-slot>
                        <x-slot name="description">Actualiza la información del perfil y la dirección de correo electrónico
                            de tu cuenta.</x-slot>
                    </x-section-title>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form method="POST" action="/ruta-de-envio" class="md:grid md:grid-cols-1 md:gap-6">
                            @csrf
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                                    <div class="grid grid-cols-6 gap-6">
                                        <!-- Aquí van los campos del formulario -->
                                        <div class="col-span-6 sm:col-span-4">
                                            <!-- Profile Photo File Input -->
                                            <input type="file" id="photo" name="foto" class="hidden"
                                                onchange="loadFile(event)">
                                            <label for="photo">Foto de perfil</label>

                                            <!-- Current Profile Photo -->
                                            <div class="mt-2" id="currentPhoto">
                                                <img id="current" src="{{ $user->url_photo }}" alt="foto de perfil"
                                                    class="rounded-full h-48 w-48 object-cover">
                                            </div>

                                            <!-- New Profile Photo Preview -->
                                            <div class="mt-2" id="newPhoto" style="display: none;">
                                                <img id="output" class="rounded-full h-48 w-48 object-cover">
                                            </div>

                                            <button
                                                class="mt-2 me-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                                type="button" onclick="document.getElementById('photo').click()">
                                                Seleccionar una nueva foto
                                            </button>

                                            <button type="button"
                                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                onclick="removePhoto()">
                                                Remover foto
                                            </button>

                                            <div id="photoError" class="mt-2"></div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" name="name" id="name" autocomplete="given-name"
                                                value="{{ $user->name }}"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <span id="errorname"
                                                class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="lastname"
                                                class="block text-sm font-medium text-gray-700">Apellido</label>
                                            <input type="text" name="lastname" id="lastname" autocomplete="given-name"
                                                value="{{ $user->lastname }}"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <span id="errorlastname"
                                                class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Correo</label>
                                            <input type="email" name="email" id="email" autocomplete="given-name"
                                                value="{{ $user->email }}"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <span id="erroremail"
                                                class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="fecha_nacimiento"
                                                class="block text-sm font-medium text-gray-700">Fecha de
                                                nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                                autocomplete="given-name" value="{{ $user->fecha_nacimiento }}"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <span id="errorfecha_nacimiento"
                                                class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="genero"
                                                class="block text-sm font-medium text-gray-700">Género</label>
                                            <select name="genero" id="genero"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="M" {{ $user->genero == 'M' ? 'selected' : '' }}>
                                                    Masculino
                                                </option>
                                                <option value="F" {{ $user->genero == 'F' ? 'selected' : '' }}>Femenino
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="direccion"
                                                class="block text-sm font-medium text-gray-700">Dirección</label>
                                            <input type="text" name="direccion_envio" id="direccion_envio"
                                                autocomplete="given-name" value="{{ $user->direccion_envio }}"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <span id="errordireccion_envio"
                                                class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="gps"
                                                class="block text-sm font-medium text-gray-700">Gps</label>
                                            @php
                                                $partes = explode(',', $user->gps);
                                                $latitud = $partes[0];
                                                $longitud = $partes[1];
                                            @endphp
                                            <div class="col-span-full">
                                                <label for="gps"
                                                    class="block text-sm leading-6 font-medium text-gray-700 dark:text-white">Ubicación</label>
                                                <div class="block w-full rounded-md border-0 py-1.5 sm:leading-6">
                                                    <input type="hidden" id="lati" name="latitud"
                                                        value={{ $latitud }}>
                                                    <input type="hidden" id="longi" name="longitud"
                                                        value={{ $longitud }}>

                                                    <div id="map" style="height: 400px; "> </div>
                                                    <!-- Aquí irá el mapa de Google Maps -->
                                                    {{-- <input type="hidden" id="gps" name="gps"> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div
                                    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                    <button type="button" id="btn-save-information" data-user={{ Auth::user()->id }}
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <x-section-border />
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-section-title>
                        <x-slot name="title">Contraseña</x-slot>
                        <x-slot name="description">Actualiza la contraseña de acceso a tu cuenta.</x-slot>
                    </x-section-title>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="md:grid md:grid-cols-1 md:gap-6">
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="current_password"
                                                class="block text-sm font-medium text-gray-700">Contraseña actual</label>
                                            <input type="password" name="current_password" id="current_password"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <div>
                                                <span id="errorcurrent_password"
                                                    class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                            </div>
                                            <div>
                                                <input type="checkbox"
                                                    class="bg-gray-50 text-sm border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded"
                                                    onclick="mostrarContrasena('current_password')"> <small> Mostrar
                                                    Contraseña
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="new_password"
                                                class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <div>
                                                <span id="errornew_password"
                                                    class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                            </div>
                                            <div>
                                                <input type="checkbox"
                                                    class="bg-gray-50 text-sm border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded"
                                                    onclick="mostrarContrasena('new_password')"> <small> Mostrar Contraseña
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="new_password_confirmation"
                                                class="block text-sm font-medium text-gray-700">Confirmar nueva
                                                contraseña</label>
                                            <input type="password" name="new_password_confirmation"
                                                id="new_password_confirmation"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            <div>
                                                <span id="errornew_password_confirmation"
                                                    class="error-message mt-1 text-sm leading-6 text-pink-600"></span>
                                            </div>
                                            <div>
                                                <input type="checkbox"
                                                    class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded"
                                                    onclick="mostrarContrasena('new_password_confirmation')">
                                                <small> Mostrar Contraseña </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                    <button type="button" id="btn-save-password" data-user="{{ Auth::user()->id }}"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-section-border />

            </div>
            {{-- CSS --}}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

            {{-- js --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl8DaopxOLYwyY0gJV2fUky4_X99ZFwJY&callback=initMap" async
                defer></script>
            <script>
                function initMap() {
                    var lati = document.getElementById('lati').value;
                    var longi = document.getElementById('longi').value;
                    console.log(lati);
                    if (lati != "") {
                        const map = new google.maps.Map(document.getElementById('map'), {
                            center: {
                                lat: parseFloat(lati),
                                lng: parseFloat(longi)
                            },
                            zoom: 13,
                        });
                        const marker = new google.maps.Marker({
                            position: {
                                lat: parseFloat(lati),
                                lng: parseFloat(longi)
                            },
                            map: map,
                            title: 'Ubicacion de Mercado el Quior',
                            draggable: true
                        });

                        // Agrega un evento 'dragend' al marcador para actualizar los campos de entrada cuando el marcador se mueva
                        marker.addListener('dragend', function() {
                            document.getElementById('lati').value = marker.getPosition().lat();
                            document.getElementById('longi').value = marker.getPosition().lng();
                        });
                    }
                }
                window.initMap = initMap;
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
                var btnInformation = document.getElementById('btn-save-information');
                var btnPassword = document.getElementById('btn-save-password');

                btnInformation.addEventListener('click', function() {
                    var inputPhoto = document.getElementById('photo');
                    var userId = this.dataset.user;
                    var name = getValueWithValidation('name', 'campo requerido');
                    var lastname = getValueWithValidation('lastname', 'campo requerido');
                    var email = getValueWithValidation('email', 'campo requerido');
                    var fecha_nacimiento = getValueWithValidation('fecha_nacimiento', 'campo requerido');
                    var genero = document.getElementById('genero').value;
                    var direccion_envio = getValueWithValidation('direccion_envio', 'campo requerido');
                    var lati = document.getElementById('lati').value;
                    var longi = document.getElementById('longi').value;
                    var formData = new FormData();

                    var gps = lati + "," + longi;
                    formData.append('user_id', userId);
                    formData.append('name', name);
                    formData.append('lastname', lastname);
                    formData.append('fecha_nacimiento', fecha_nacimiento);
                    formData.append('genero', genero);
                    formData.append('direccion_envio', direccion_envio);
                    formData.append('gps', gps);
                    formData.append('email', email);
                    var apiUrl = new URL('/api/cliente/perfil', window.location.origin);
                    console.log(apiUrl)
                    if (inputPhoto.value != "") { //verifica si coloco una foto nueva
                        var file = inputPhoto.files[0];
                        formData.append('foto', file);
                        console.log(file);
                        console.log(formData);
                        console.log("con foto nueva");
                        console.log('User ID: ', userId);

                    }
                    console.log("sin foto nueva");
                    fetch(apiUrl, {
                            method: 'POST',

                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success:', data.data);
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            var imgcurrent = document.getElementById('current');
                            var inputPhoto = document.getElementById('photo');
                            imgcurrent.src = data.data['url_photo'];
                            inputPhoto.value = '';
                            console.log("ingresa a success");
                            toastr.success("Información del perfil actualizado exitosamente");
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            console.log("Error al subir las imágenes");
                            toastr.error(error);

                        });

                    console.log(inputPhoto);
                    console.log('El botón ha sido clickeado');
                });
                btnPassword.addEventListener('click', function() {
                    var currentPass = getValueWithValidation('current_password', 'Campo requerido');
                    var newPass = getValueWithValidationPassword('new_password', 'Campo requerido');
                    var newPassConfirmation = getValueWithValidationPassword('new_password_confirmation',
                        'Campo requerido');
                    var userId = this.dataset.user;
                    var apiUrl = new URL('/api/cliente/password', window.location.origin);
                    if (currentPass == '' || newPass == '' || newPassConfirmation == '') {
                        return;
                    }

                    console.log(apiUrl)
                    var formData = new FormData();
                    formData.append('user_id', userId);
                    formData.append('current_password', currentPass);
                    formData.append('new_password', newPass);
                    formData.append('new_password_confirmation', newPassConfirmation);

                    fetch(apiUrl, {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => {
                            console.log("response: ", response);
                            if (!response.ok) {
                                return response.json().then(error => {
                                    error.status = response
                                        .status; // Agregar el código de estado al objeto de error
                                    throw error;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Success:', data);
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            console.log("ingresa a success");
                            toastr.success("Contraseña actualizada exitosamente");
                            document.getElementById('current_password').value = '';
                            document.getElementById('new_password').value = '';
                            document.getElementById('new_password_confirmation').value = '';
                        })
                        .catch((error) => {
                            console.log("entra al error");
                            console.error('Error:', error);
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            if (error.status === 400) {
                                var errorCurrentPass = document.getElementById("errorcurrent_password");
                                errorCurrentPass.innerText = "Contraseña actual incorrecta";
                            }
                            if (error.status === 401) {
                                var errorCurrentPass = document.getElementById("errornew_password");
                                errorCurrentPass.innerText = "Contraseña nueva debe ser distinta a la actual";
                            }
                            // errornew_password_confirmation
                            if (error.status === 422) {
                                var errorPassCon = document.getElementById("errornew_password_confirmation");
                                errorPassCon.innerText = "Confirmación de contraseña no coincide";
                            }

                            toastr.error(error.message);
                        });

                });

                function getValueWithValidation(nameInput, valueShow) {
                    try {
                        console.log("encuentra: ", nameInput);
                        var dataValue = document.getElementById(nameInput).value;
                        console.log("encuentra value: ", dataValue);
                        if (dataValue.trim() === '') {
                            document.getElementById('error' + nameInput).innerText = valueShow;
                        } else {
                            document.getElementById('error' + nameInput).innerText = '';
                        }
                        return dataValue;
                    } catch (error) {
                        console.error('ha ocurrido un error en getValueWithValidation => ', error);
                        return null; // Puedes devolver un valor predeterminado o null en caso de error
                    }
                }

                function getValueWithValidationPassword(nameInput, valueShow) {
                    try {
                        console.log("encuentra: ", nameInput);
                        var dataValue = document.getElementById(nameInput).value;
                        console.log("encuentra value: ", dataValue);
                        if (dataValue.trim() === '') {
                            document.getElementById('error' + nameInput).innerText = valueShow;
                        } else if (dataValue.length < 8) {
                            document.getElementById('error' + nameInput).innerText = 'El valor debe contener al menos 8 caracteres';
                            dataValue = '';
                        } else {
                            document.getElementById('error' + nameInput).innerText = '';
                        }
                        return dataValue;
                    } catch (error) {
                        console.error('ha ocurrido un error en getValueWithValidation => ', error);
                        return null; // Puedes devolver un valor predeterminado o null en caso de error
                    }
                }

                function mostrarContrasena(id) {
                    var x = document.getElementById(id);
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
                // input de la foto
                function loadFile(event) {
                    var output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    console.log(output.src);
                    output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                        document.getElementById('newPhoto').style.display = 'block';
                        document.getElementById('currentPhoto').style.display = 'none';
                    }
                }

                function removePhoto() {
                    var inputPhoto = document.getElementById('photo');
                    console.log(inputPhoto.value);
                    document.getElementById('newPhoto').style.display = 'none';
                    document.getElementById('currentPhoto').style.display = 'block';
                    document.getElementById('output').src = '';
                    inputPhoto.value = '';
                }
            </script>
        @endsection
