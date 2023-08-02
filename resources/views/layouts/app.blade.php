<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PressIt</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style>
        .scrollbar-hidden::-webkit-scrollbar{
            display: none;
        }
        .max-h-64 {
            max-height: 16rem;
        }
        /*Quick overrides of the form input as using the CDN version*/
        .form-input,
        .form-textarea,
        .form-select,
        .form-multiselect {
            background-color: #edf2f7;
        }
    </style>

    {{-- apline js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body x-data="{'loginOpen': false, 'registerOpen': false, 'regisDetail':false}" x-on:keydown.escape="loginOpen=false, registerOpen=false">
    <div id="spin-wrapper" class="w-full h-screen absolute flex items-center justify-center bg-white z-50">
        <ion-icon name="reload-outline" class="w-20 animate-spin"></ion-icon>
    </div>

    <nav class="py-9 px-4 z-50">
        @include('layouts.navigation')
    </nav>

    <div class="absolute flex justify-center top-0 left-0">
        @include('auth.login')
        @include('auth.register')
    </div>

    <div class="container flex justify-center mx-auto flex-col">
        @yield('body')
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script>
        var loader = document.getElementById("spin-wrapper");

        window.addEventListener("load", function() {
            loader.style.display = "none";
        })
    </script>
</body>
</html>