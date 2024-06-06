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
        /* html {
            scroll-behavior: smooth;
        } */

        .scrollbar-hidden::-webkit-scrollbar {
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

        .typing::after {
            border-right: 3px solid black;
            /* Efek kursor */
            animation: typing 5s steps(22) infinite, blink-caret 1s infinite step-end;
        }

        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent;
            }

            50% {
                border-color: black;
            }
        }
    </style>

    {{-- apline js --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Intro js --}}
    <link rel="stylesheet" href="https://unpkg.com/intro.js/introjs.css">
    <script src="https://unpkg.com/intro.js/intro.js"></script>

    {{-- Animate On Scroll --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body x-data="{ 'loginOpen': false, 'registerOpen': false, 'regisDetail': false }" x-on:keydown.escape="loginOpen=false, registerOpen=false">
    <!-- Main modal -->
    @if (Auth::user() && Auth::user()->status == 'banned')
        <div class="fixed z-50 inset-0 flex items-center justify-center overflow-hidden">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div
                class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Anda di BANNED!!!!
                    </h3>
                    <div class="mt-2">
                        <ul class="list-disc list-inside">
                            <li>Anda telah di BANNED akibat kesalahan yang Anda dilakukan</li>
                            <li>Coba hubungi admin untuk pemulihan akun</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <div id="spin-wrapper" class="w-full h-screen absolute flex items-center justify-center bg-white z-50">
        <ion-icon name="reload-outline" class="w-20 animate-spin"></ion-icon>
    </div> --}}

    <nav id="headerNav"
        class="lg:mx-[128px] xl:mx-[128px] md:mx-0 mx-auto lg:py-2 xl:py-2 lg:px-4 xl:px-4 z-50 lg:sticky xl:sticky lg:top-1 xl:top-1 lg:bg-slate-400 xl:bg-slate-400 lg:bg-opacity-50 xl:bg-opacity-50 lg:rounded-full xl:rounded-full lg:my-1 xl:my-1 lg:backdrop-blur-sm xl:backdrop-blur-sm lg:transition-all">
        @include('layouts.navigation')
    </nav>
    <script>
        const headerNav = document.getElementById('headerNav');
        let lastScrollTop = 0;

        window.addEventListener('scroll', () => {
            const screenWidth = window.innerWidth;

            // Only apply the animation on large displays
            if (screenWidth >= 1024) {
                const scrollTop = window.scrollY;

                if (scrollTop > lastScrollTop) {
                    // Scroll down
                    headerNav.style.transform = 'translateY(-100%)';
                } else {
                    // Scroll up
                    headerNav.style.transform = 'translateY(0)';
                }

                lastScrollTop = scrollTop;
            } else {
                headerNav.style.transform = '';
            }
        });
    </script>

    <div class="absolute flex justify-center top-0 left-0">
        @include('auth.login')
        @include('auth.register')
    </div>

    <div class="">
        @yield('body')
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script>
        // var loader = document.getElementById("spin-wrapper");

        // window.addEventListener("load", function() {
        //     loader.style.display = "none";
        // })
    </script>
</body>

</html>
