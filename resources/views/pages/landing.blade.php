@extends('layouts.app')

@section('body')

{{-- Hero section --}}
<section id="section1" class="w-full">
    <div class="container px-4 py-28 lg:py-16">
        <div class="grid grid-cols-12 items-center">
            <div class="lg:order-1 col-span-12 lg:col-span-4 order-2 -z-50">
                <div>
                    <button class="lg:mx-0 px-8 py-4 bg-white text-pink flex gap-2 text-xl font-bold drop-shadow-sm-shadow rounded-full mx-auto">
                        Explore the Fresh Look!
                    </button>
                    <h1 class="lg:text-start lg:text-[69px] md:text-[56px] md:my-[43px] mt-4 mb-6 text-center font-bold text-[40px] text-grey leading-tight">Make <span class="text-pink">your clothes</span> always Fresh!</h1>
                    <p class="lg:w-full lg:text-start md:text-[18px] md:w-3/4 md:mb-[43px] mx-auto mb-8 text-center text-grey opacity-50 text-base font-inter">We will provide a gentle and caring touch to your clothes, ensuring they look fresh and perfectly pressed</p>
                </div>
            </div>
            <div class="lg:order-2 col-span-12 lg:col-span-8 order-1">
                <img src="{{ asset('storage/assets/hero.png') }}" alt="" class="w-full">
            </div>
        </div>
    </div>
</section>

{{-- Service section --}}
<section id="section2" class="lg:py-16 mb-[68px]">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 items-center">
            <div class="lg:col-span-4 col-span-12 flex gap-4 flex-col text-center lg:text-start">
                <span class="text-pink font-bold leading-tight sm:mb-4">SERVICE</span>
                <h1 class="font-bold text-5xl leading-tight text-grey sm:mb-16">The best service we provide for you</h1>
            </div>
            <div class="lg:col-span-8 col-span-12 bg-transparent sm:w-auto w-full flex lg:flex-row flex-col gap-4 items-center overflow-y-scroll scrollbar-hidden py-6 px-3">
                @if ($pakets->count() > 0)
                    @foreach ($pakets as $paket)
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 drop-shadow-xl-shadow">
                        <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">Paket {{ $paket->jenis }}</h5>
                        <div class="flex items-baseline text-gray-900 dark:text-white">
                            <span class="text-3xl font-semibold">Rp</span>
                            <span class="text-5xl font-extrabold tracking-tight">{{ $paket->harga }}</span>
                            <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">/{{ $paket->satuan_harga }}</span>
                        </div>
                        <ul role="list" class="space-y-5 my-7">
                            <li class="flex space-x-3 items-center">
                                <svg class="flex-shrink-0 w-4 h-4 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <textarea class="text-base font-normal text-gray-500 dark:text-gray-400 w-full h-40 overflow-y-auto scrollbar-hidden resize-none rounded-lg bg-transparent" disabled>{{ $paket->deskripsi }}
                                </textarea>
                            </li>
                        </ul>
                        @auth
                        <a href="{{ route('book', ['id' => $paket->id]) }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</a>
                        @else
                        <button x-on:click="if (showConfirmation()) registerOpen = true" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</button>
                        <script>
                            function showConfirmation() {
                                return confirm("You don't have an account. Create an account?");
                            }
                        </script>
                        @endauth
                    </div>
                    @endforeach
                    @foreach ($pakets as $paket)
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">Paket {{ $paket->jenis }}</h5>
                        <div class="flex items-baseline text-gray-900 dark:text-white">
                            <span class="text-3xl font-semibold">Rp</span>
                            <span class="text-5xl font-extrabold tracking-tight">{{ $paket->harga }}</span>
                            <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">/{{ $paket->satuan_harga }}</span>
                        </div>
                        <ul role="list" class="space-y-5 my-7">
                            <li class="flex space-x-3 items-center">
                                <svg class="flex-shrink-0 w-4 h-4 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <textarea class="text-base font-normal text-gray-500 dark:text-gray-400 w-full h-40 overflow-y-auto scrollbar-hidden resize-none rounded-lg bg-transparent" disabled>{{ $paket->deskripsi }}
                                </textarea>
                            </li>
                        </ul>
                        @auth
                        <a href="{{ route('book', ['id' => $paket->id]) }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</a>
                        @else
                        <button x-on:click="if (showConfirmation()) registerOpen = true" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</button>
                        <script>
                            function showConfirmation() {
                                return confirm("You don't have an account. Create an account?");
                            }
                        </script>
                        @endauth
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    // <!-- Scroll Spy -->
    // Cache selectors
    var lastId,
        topMenu = $("#menu-content"),
        topMenuHeight = topMenu.outerHeight()+175,
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
        var item = $($(this).attr("href"));
        if (item.length) { return item; }
        });

    // Bind click handler to menu items
    // so we can get a fancy scroll animation
    menuItems.click(function(e){
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
    $('html, body').stop().animate({ 
        scrollTop: offsetTop
    }, 300);
    if (!helpMenuDiv.classList.contains("hidden")) {
            helpMenuDiv.classList.add("hidden");
        }
    e.preventDefault();
    });

    // Bind to scroll
    $(window).scroll(function(){
    // Get container scroll position
    var fromTop = $(this).scrollTop()+topMenuHeight;

    // Get id of current scroll item
    var cur = scrollItems.map(function(){
        if ($(this).offset().top < fromTop)
        return this;
    });
    // Get the id of the current element
    cur = cur[cur.length-1];
    var id = cur && cur.length ? cur[0].id : "";

    if (lastId !== id) {
        lastId = id;
        // Set/remove active class
        menuItems
            .parent().removeClass("font-bold border-yellow-600")
            .end().filter("[href='#"+id+"']").parent().addClass("font-bold border-yellow-600");
    }                   
    });
</script>

@endsection