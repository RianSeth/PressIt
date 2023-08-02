<div class="container mx-auto" x-data="{navOpen : true}">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl italic order-1 sm:order-2"><a href="/">PressIt</a></h1>
        <svg @click="navOpen = !navOpen" class="order-2 sm:order-1 lg:hidden" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M28.38 0H11.62C4.34 0 0 4.34 0 11.62V28.36C0 35.66 4.34 40 11.62 40H28.36C35.64 40 39.98 35.66 39.98 28.38V11.62C40 4.34 35.66 0 28.38 0ZM30 30.5H10C9.18 30.5 8.5 29.82 8.5 29C8.5 28.18 9.18 27.5 10 27.5H30C30.82 27.5 31.5 28.18 31.5 29C31.5 29.82 30.82 30.5 30 30.5ZM30 21.5H10C9.18 21.5 8.5 20.82 8.5 20C8.5 19.18 9.18 18.5 10 18.5H30C30.82 18.5 31.5 19.18 31.5 20C31.5 20.82 30.82 21.5 30 21.5ZM30 12.5H10C9.18 12.5 8.5 11.82 8.5 11C8.5 10.18 9.18 9.5 10 9.5H30C30.82 9.5 31.5 10.18 31.5 11C31.5 11.82 30.82 12.5 30 12.5Z" fill="#5D50C6"/>
        </svg>
        <div class="order-2 hidden lg:block" id="menu-content">
            <ul class="flex gap-16">
                <li class="text-grey font-bold text-sm font-circular">
                    <a href="/#section1">Home</a>
                </li>
                <li class="text-grey font-normal text-sm font-circular opacity-50">
                    <a href="/#section2">Service</a>
                </li>
            </ul>
        </div>
        <div class="order-3 hidden sm:block" x-data="{openProfil : false}">
            @if (Route::has('login'))
                @auth
                    <button @click="openProfil = !openProfil" class="grow bg-white px-8 py-4 font-bold text-grey rounded-full text-sm shadow-xl">
                        {{ Auth::user()->name }}
                    </button>
                    <ul x-show="openProfil"
                        x-on:click.away="openProfil = false"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="bg-white rounded shadow-md mr-7 absolute mt-24 top-0 right-0 w-36 overflow-auto z-30 list-reset scrollbar-hidden"
                        >
                        <li>
                            @if (Auth::user()->usertype == 'admin')
                                <a href="/admin" class="px-4 py-2 block hover:bg-gray-400 no-underline hover:no-underline">
                                    Dashboard
                                </a>
                            @endif
                        </li>
                        <li>
                            <a href="{{ route('booking') }}" class="px-4 py-2 block hover:bg-gray-400 no-underline hover:no-underline">
                                My Order
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="px-4 py-2 block text-yellow-600 font-bold hover:bg-yellow-600 hover:text-white no-underline hover:no-underline"
                            >
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @else
                    <button x-on:click="loginOpen = true" class="grow bg-white px-8 py-4 font-bold text-grey rounded-full text-sm shadow-xl">Login</button>
                    @if (Route::has('register'))
                        <button x-on:click="registerOpen = true" class="grow bg-purple px-8 py-4 font-bold text-white rounded-full text-sm shadow-xl">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
    <div 
        x-show="navOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        x-data="{open : false}" class="lg:hidden fixed bottom-0 right-0 left-0 p-4 bg-white border">
        <ul class="flex justify-between md:justify-around">
            <li>
                <a href="#section1" class="flex justify-center flex-col items-center gap-1">
                    <ion-icon name="home-outline" class="text-purple text-2xl"></ion-icon>
                    <span class="text-purple opacity-50 text-base font-bold font-normal">Home</span>
                </a>
            </li>
            <li>
                <a href="#section2" class="flex justify-center flex-col items-center gap-1">
                    <ion-icon name="build-outline" class="text-grey text-2xl"></ion-icon>
                    <span class="text-grey opacity-50 text-base font-bold font-normal">Service</span>
                </a>
            </li>
            <li class="md:hidden">
                <button @click="open = !open" class="flex justify-center flex-col items-center gap-1">
                    <ion-icon name="ellipsis-vertical-outline" class="text-grey text-2xl"></ion-icon>
                    <span class="text-grey opacity-50 text-base font-bold font-normal">More</span>
                </button>
            </li>
        </ul>
        <div 
            x-show="open"
            x-on:click.away="openProfil = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            x-data="{openProfil1 : false}"
            class="w-3/4 absolute bottom-24 left-1/2 -translate-x-1/2 flex justify-center gap-4 ">
            @if (Route::has('login'))
                @auth
                    <button @click="openProfil1 = !openProfil1" class="bg-white px-8 py-4 font-bold text-grey rounded-full text-sm shadow-xl">
                        {{ Auth::user()->name }}
                    </button>
                    <ul x-show="openProfil1"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        >
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="absolute text-grey font-normal text-sm font-circular opacity-50 bottom-20 right-40 border py-1 px-2 shadow-xl bg-slate-300 rounded-sm"
                            >
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('login') }}" class="grow bg-white px-8 py-4 font-bold text-grey rounded-full text-sm shadow-xl text-center">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="grow bg-purple px-8 py-4 font-bold text-white rounded-full text-sm shadow-xl text-center">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</div>