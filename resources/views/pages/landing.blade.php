@extends('layouts.app')

@section('body')

{{-- Hero section --}}
<section id="section1" class="lg:mx-[128px] md:mx-16 mx-4 flex justify-center flex-col">
    <div class="container px-4 py-28 lg:py-0">
        <div class="grid grid-cols-12 items-center">
            <div class="lg:order-1 col-span-12 lg:h-[577px] lg:col-span-4 order-2 -z-50">
                <div class="lg:flex lg:flex-col">
                    <button class="lg:mx-0 px-8 py-4 w-fit bg-white text-pink flex gap-2 text-xl font-bold drop-shadow-sm-shadow rounded-full mx-auto">
                        Explore the Fresh Look!
                    </button>
                    <h1 class="lg:w-[412px] lg:h-[249px] lg:text-start lg:text-[69px] md:text-[56px] md:my-[43px] mt-4 mb-6 text-center font-bold text-[40px] text-grey leading-tight">Make <span class="text-pink typing" id="typing-text"></span> always Fresh!</h1>
                    <p class="lg:w-full lg:text-start lg:mt-16 md:text-[18px] md:w-3/4 md:mb-[43px] mx-auto mb-8 text-center text-grey opacity-50 text-base font-inter">We will provide a gentle and caring touch to your clothes, ensuring they look fresh and perfectly pressed</p>
                </div>
                <script>
                    const text = "your clothes";
                    const span = document.getElementById("typing-text");
                
                    function typeWriter(text, span) {
                      let charIndex = 0;
                      const typingInterval = setInterval(function() {
                        if (charIndex < text.length) {
                          span.textContent += text.charAt(charIndex);
                          charIndex++;
                        } else {
                          clearInterval(typingInterval);
                          setTimeout(function() {
                            reverseType(text, span);
                          }, 1000); // Jeda sebelum animasi reverse dimulai
                        }
                      }, 150); // Waktu antara setiap huruf muncul
                    }
                
                    function reverseType(text, span) {
                      let charIndex = text.length - 1;
                      const reversingInterval = setInterval(function() {
                        if (charIndex >= 0) {
                          span.textContent = text.substring(0, charIndex);
                          charIndex--;
                        } else {
                          clearInterval(reversingInterval);
                          setTimeout(function() {
                            typeWriter(text, span);
                          }, 1000); // Jeda sebelum animasi typing dimulai lagi
                        }
                      }, 150); // Waktu antara setiap huruf dihapus
                    }
                
                    typeWriter(text, span);
                </script>
            </div>
            <div class="lg:order-2 col-span-12 lg:col-span-8 order-1 text-center relative w-[772px] h-[726px]">
                <div class="w-[772px] h-[287px] relative top-0 left-0 flex flex-row items-center">
                    <img src="{{ asset('storage/assets/earth-vector.png') }}" alt="" class="w-[660px] h-[268px] relative top-[17px] left-[46px]">
                    <img src="{{ asset('storage/assets/icon-ironpress11.png') }}" alt="" class="w-[44px] h-[33px] absolute top-[42px] left-[88px]">
                    <img src="{{ asset('storage/assets/icon-ironpress12.png') }}" alt="" class="w-[230px] h-[211px] absolute top-[63px] left-[0px] z-10">
                    <img src="{{ asset('storage/assets/icon-ironpress2.png') }}" alt="" class="w-[391px] h-[199px] absolute top-[1px] left-[211px] z-10">
                    <img src="{{ asset('storage/assets/icon-ironpress3.png') }}" alt="" class="w-[160px] h-[240px] absolute top-[3px] left-[612px] z-10">
                    <img src="{{ asset('storage/assets/hanger.png') }}" alt="" class="w-[52px] h-[52px] absolute top-[118px] left-[656px] z-10 transform rotate-[10deg]">
                </div>
                <div class="col-span-6 absolute w-[575px] h-[632px] top-[75px] left-[91px] flex flex-row justify-between items-center">
                    <div class="col-span-3 flex flex-col justify-between gap-7">
                        <img src="{{ asset('storage/assets/hero1.png') }}" alt="" class="w-full layer" data-speed="3">
                        <img src="{{ asset('storage/assets/hero3.png') }}" alt="" class="w-full layer" data-speed="2">
                    </div>
                    <img src="{{ asset('storage/assets/hero2.png') }}" alt="" class="w-[272px] h-[400px] layer" data-speed="4">
                </div>
                <img src="{{ asset('storage/assets/icon1.png') }}" alt="" class="absolute top-[341px] left-[56px] layer" data-speed="-1">
                <img src="{{ asset('storage/assets/icon2.png') }}" alt="" class="absolute top-[649px] left-[474px] layer" data-speed="5">
                <img src="{{ asset('storage/assets/icon3.png') }}" alt="" class="absolute top-[488px] left-[592px] layer" data-speed="-2">
            </div>
            <!-- JavaScript using GSAP -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    const layers = $('.layer');
                    
                    $(document).mousemove(function(event) {
                        const mouseX = event.pageX;
                        const mouseY = event.pageY;
                        
                        layers.each(function() {
                            const speed = parseFloat($(this).data('speed'));
                            const newX = (window.innerWidth - mouseX) * speed / 100;
                            const newY = (window.innerHeight - mouseY) * speed / 100;
                            
                            gsap.to(this, {
                                x: newX,
                                y: newY,
                                duration: 1,
                                ease: "power2.out"
                            });
                        });
                    });
                });
            </script>

        </div>
    </div>
</section>

{{-- Service section --}}
<section id="section2" class="lg:px-[128px] md:px-16 px-4 lg:pt-64 pb-[68px] relative bg-[url('/public/storage/assets/bg1.png')] bg-cover bg-no-repeat bg-top">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 items-center">
            <div class="lg:col-span-4 col-span-12 flex gap-4 flex-col text-center lg:text-start">
                <span class="text-red-700 text font-bold leading-tight sm:mb-4">SERVICE</span>
                <h1 class="font-bold text-5xl leading-tight text-grey sm:mb-16">The best service we provide for you</h1>
            </div>
            <div class="service lg:col-span-8 col-span-12 bg-transparent sm:w-auto w-full flex lg:flex-row flex-col gap-4 items-center overflow-y-scroll scrollbar-hidden py-6 px-3">
                @if ($pakets->count() > 0)
                    @foreach ($pakets as $paket)
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 drop-shadow-lg-shadow">
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
                        <a href="{{ route('book', ['id' => $paket->id]) }}" class="button-paket text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</a>
                        @else
                        <button x-on:click="if (showConfirmation()) registerOpen = true" class="button-paket text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</button>
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

@once
    <script>
        const navLinks = document.querySelectorAll('nav li[data-section]');
        const sections = document.querySelectorAll('section');

        window.addEventListener('scroll', () => {
        let currentSection = null;

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 80;
            const sectionBottom = sectionTop + section.clientHeight;

            if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
            currentSection = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            if (link.getAttribute('data-section') === currentSection) {
            link.classList.add('font-bold');
            link.classList.remove('opacity-50');
            link.classList.remove('font-normal');
            } else {
            link.classList.remove('font-bold');
            link.classList.add('font-normal');
            link.classList.add('opacity-50');
            }
        });
        });

        introJs().setOptions({
            dontShowAgain: true,
            dontShowAgainCookieDays: 1,
            showProgress: true,
            showBullets: false,
            steps: [{
                title: 'Selamat Datang di PressIt',
                intro: 'Silahkan mengikuti tour singkat Kami'
            },{
                element: document.querySelector('.service'),
                title: 'Service Kami!',
                intro: 'Kami menyediakan beberapa service untuk memperhalus dan merapikan Pakaian Anda',
                position: 'left'
            },{
                element: document.querySelector('.button-paket'),
                intro: 'Ayo pesan layanan kami sekarang!',
                position: 'top',
            },{
                title: 'Register atau Login',
                intro: 'Tapi jangan lupa buat Akun-Mu dulu di pojok kanan atas!',
            },{
                element: document.querySelector('.button-login'),
                intro: 'Disini!'
            }]
        }).start();
    </script>
@endonce

<section>

</section>

@endsection