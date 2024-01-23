<!-- Search button -->
<div id="notificationComponent" class="relative inline-flex">
    <!-- Button -->
    <button id="notificationButton"
        class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-slate-200 rounded-full"
        aria-haspopup="true">
        <span class="sr-only">Notifications</span>
        <svg class="w-4 h-4" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-current text-slate-500 dark:text-slate-400"
                d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V12l2.699-1.542A7.454 7.454 0 006.5 11c3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0z" />
            <path class="fill-current text-slate-400 dark:text-slate-500"
                d="M16 9.5c0-.987-.429-1.897-1.147-2.639C14.124 10.348 10.66 13 6.5 13c-.103 0-.202-.018-.305-.021C7.231 13.617 8.556 14 10 14c.449 0 .886-.04 1.307-.11L15 16v-4h-.012C15.627 11.285 16 10.425 16 9.5z" />
        </svg>
        @auth
            @if (Auth::user()->unreadNotifications->count() > 0)
                <div id="notification" data-user="{{ Auth::user()->id }}"
                    class="absolute bottom-4 left-6 w-5 h-5 bg-rose-500 border-1 border-white rounded-full flex items-center justify-center">
                    <span class="text-xxs text-white">{{ Auth::user()->unreadNotifications->count() }}</span>
                </div>
            @else
                <div id="notification" data-user="{{ Auth::user()->id }}"
                    class="absolute top-0 right-0 w-2.5 h-2.5 bg-rose-500 border-2 border-white rounded-full">
                </div>
            @endif
        @endauth


    </button>
    <!-- Modal dialog -->
    <div id="notificationModal"
        class="origin-top-left absolute top-full right-1 z-10 min-w-80 bg-white border border-slate-200 rounded shadow-lg overflow-hidden mt-1"
        style="display: none;">
        <ul>
            @auth
                <div class="border-b border-slate-200 last:border-0 bg-gray-200">
                    <h1 class="px-4">Notificaciones nuevas</h1>
                </div>
                @forelse (Auth::user()->unreadNotifications as $notification)
                    @if ($notification->data['accion'] == 'Invitación')
                        <li class="border-b border-slate-200 last:border-0">
                            <a class="block py-2 px-4 hover:bg-slate-50"
                                href="{{ route('sesion.other.show', $notification->data['id']) }}">
                                <span class="block text-sm mb-2">📣 <span
                                        class="font-medium text-slate-800 ">Invitación</span> Te
                                    invitan a formar parte del equipo para la sesión
                                    <span
                                        class="font-medium text-slate-800 ">{{ $notification->data['titulo'] }}</span></span>
                                <span
                                    class="block text-xs font-medium text-slate-400">{{ $notification->data['time'] }}</span>
                            </a>
                        </li>
                    @elseif($notification->data['accion'] == 'Aceptación')
                        <li class="border-b border-slate-200 last:border-0">
                            <a class="block py-2 px-4 hover:bg-slate-50"
                                href="{{ route('sesion.show', $notification->data['id']) }}">
                                <span class="block text-sm mb-2">📣 <span
                                        class="font-medium text-slate-800 ">Aceptación</span> El usuario
                                    <span
                                        class="font-medium text-slate-800 ">{{ $notification->data['titulo'] }}</span></span>
                                <span
                                    class="block text-xs font-medium text-slate-400">{{ $notification->data['time'] }}</span>
                            </a>
                        </li>
                    @endif
                @empty
                    <span class="block text-sm mb-2 px-4">
                        No hay notificaciones nuevas</span>
                @endforelse
                <div class="border-b border-slate-200  last:border-0 bg-gray-200">
                    <h1 class="px-4">Notificaciones leídas</h1>
                </div>
                @php
                    $c = 0;
                    // accionid; //id de la tabla
                    // accion;   //accion de la notificacion
                    // titulo;   //titulo que se mostrará en la notificacion
                    // tabla;    //nombre de la tabla
                @endphp
                @forelse (Auth::user()->readNotifications as $notification)
                    @if ($c < 3)
                        @if ($notification->data['accion'] == 'Invitación')
                            <li class="border-b border-slate-200 last:border-0">
                                <a class="block py-2 px-4 hover:bg-slate-50" href="#">
                                    <span class="block text-sm mb-2">📣 <span
                                            class="font-medium text-slate-800">Invitación</span> Te
                                        invitan a formar parte del equipo para la sesión
                                        {{ $notification->data['titulo'] }}</span>
                                    <span
                                        class="block text-xs font-medium text-slate-400">{{ $notification->data['time'] }}</span>
                                </a>
                            </li>
                        @elseif($notification->data['accion'] == 'Aceptación')
                            <li class="border-b border-slate-200 last:border-0">
                                <a class="block py-2 px-4 hover:bg-slate-50"
                                    href="{{ route('sesion.show', $notification->data['id']) }}">
                                    <span class="block text-sm mb-2">📣 <span
                                            class="font-medium text-slate-800 ">Aceptación</span> El usuario
                                        <span
                                            class="font-medium text-slate-800 ">{{ $notification->data['titulo'] }}</span></span>
                                    <span
                                        class="block text-xs font-medium text-slate-400">{{ $notification->data['time'] }}</span>
                                </a>
                            </li>
                        @endif
                        @php
                            $c++;
                        @endphp
                    @endif
                @empty
                    <span class="block text-sm mb-2 px-4">
                        No hay notificaciones leídas</span>
                @endforelse
                <li class="border-b border-slate-200  last:border-0">
                    <a class="block py-2 px-4 hover:bg-slate-50" href="#notificacion">
                        <span class="block text-sm mb-2">
                            Ver todas las notificaciones</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</div>
{{-- css --}}
<style>
    .text-xxs {
        font-size: 0.6rem;
    }
</style>

{{-- js --}}
<script>
    document.getElementById('notificationButton').addEventListener('click', function(event) {
        event.preventDefault();
        var notificationModal = document.getElementById('notificationModal');
        var notificationCount = document.getElementById('notification');
        var userId = notificationCount.dataset.user;
        console.log("user_id: ", userId);
        if (notificationModal.style.display === "none") {

            console.log("abre modal notificacion");
            if (notificationCount != null) {
                var spanChild = notificationCount.querySelector('span');
                if (spanChild) {
                    // Si existe, lo elimina
                    console.log("elimina el span de hijo")
                    // peticion post
                    var apiUrl = new URL('/api/marcar-notificaciones', window.location.origin);
                    console.log(apiUrl)
                    var data = {
                        user_id: userId
                    };
                    notificationModal.style.display = "block"; //borrar si desmarco el fetch
                    fetch(apiUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(data),
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success:', data);
                            notificationCount.removeChild(spanChild);
                            notificationCount.classList.remove('flex', 'items-center', 'justify-center',
                                'bottom-4',
                                'left-6', 'w-5', 'h-5', 'border-1');
                            notificationCount.classList.add('top-0', 'right-0', 'w-2.5', 'h-2.5',
                                'border-2');
                            notificationModal.style.display = "block";
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            // Aquí puedes agregar el código que quieras ejecutar si ocurrió un error
                        });
                } else {
                    notificationModal.style.display = "block";
                }


                // fin peticion post

            }
        } else {
            notificationModal.style.display = "none";
            console.log("cierra modal notificacion");
        }
    });

    window.addEventListener('click', function(event) {
        var notificationModal = document.getElementById('notificationModal');

        if (!document.getElementById('notificationComponent').contains(event.target)) {
            notificationModal.style.display = "none";
            // Comprueba si notificationCount tiene un hijo span
        }
    });
</script>
