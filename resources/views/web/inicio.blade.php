@extends('layouts.appdiagramador')

@section('contenido')
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

    <div>
        {{-- <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-8 lg:max-w-7xl lg:px-8"> --}}




    </div>
    {{-- js --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var typed = new Typed('#titleContainer', {
                strings: ['Diagrama de secuencia, una experiencia colaborativa', ' Tu mejor opción'],
                typeSpeed: 60,
                backSpeed: 60,
                loop: true
            });
        });
    </script>
@endsection
