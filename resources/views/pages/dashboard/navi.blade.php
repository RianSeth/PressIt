<!DOCTYPE html>
<html lang="en">
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
        html {
            scroll-behavior: smooth;
        }

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

        .typing::after {
            border-right: 3px solid black; /* Efek kursor */
            animation: typing 5s steps(22) infinite, blink-caret 1s infinite step-end;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: black; }
        }
    </style>

    {{-- apline js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <nav id="headerNav" class="lg:mx-[128px] xl:mx-[128px] md:mx-0 mx-auto lg:py-2 xl:py-2 lg:px-4 xl:px-4 z-50 lg:sticky xl:sticky lg:top-1 xl:top-1 xl:rounded-full lg:my-1 xl:my-1 lg:backdrop-blur-sm xl:backdrop-blur-sm lg:transition-all">
        <div>
            <h2 class="sr-only">Steps</h2>
        
            <div
            class="relative after:absolute after:inset-x-0 after:top-1/2 after:block after:h-0.5 after:-translate-y-1/2 after:rounded-lg after:bg-gray-100"
            >
            <ol class="relative z-10 flex justify-between text-sm font-medium text-gray-500">
                <li class="flex items-center gap-2 bg-white p-2">
                    <span class="size-6 rounded-full {{ request()->routeIs('createcust') ? 'bg-blue-600 text-white' : 'bg-gray-100' }} text-center text-[10px]/6 font-bold"> 1 </span>
            
                    <span class="hidden sm:block"> Customer </span>
                </li>
        
                <li class="flex items-center gap-2 bg-white p-2">
                <span class="size-6 rounded-full {{ request()->routeIs('createpack') ? 'bg-blue-600 text-white' : 'bg-gray-100' }} text-center text-[10px]/6 font-bold">
                    2
                </span>
        
                <span class="hidden sm:block"> Package </span>
                </li>
        
                <li class="flex items-center gap-2 bg-white p-2">
                <span class="size-6 rounded-full {{ request()->routeIs('create') ? 'bg-blue-600 text-white' : 'bg-gray-100' }} text-center text-[10px]/6 font-bold"> 3 </span>
        
                <span class="hidden sm:block"> Detail Order </span>
                </li>
            </ol>
            </div>
        </div>
    </nav>
    <div class="">
        @yield('body1')
    </div>
</body>
</html>