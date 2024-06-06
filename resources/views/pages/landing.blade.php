@extends('layouts.app')

@section('body')

<div class="fixed bottom-6 right-6 rounded-full h-20 w-20 items-center justify-center z-50">
    <a href="https://wa.me/6281234567890?text=Hallo%20admin!%20" target="_blank" class="bg-green-500 hover:bg-green-700 text-white w-full h-full py-2 px-4 rounded-full flex flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
        </svg>
    </a>
</div>


{{-- Hero section --}}
<section id="section1" class="lg:mx-auto md:mx-auto flex justify-center flex-col container text-center">
    <div class="container px-4 py-28 lg:py-0">
        <div class="grid grid-cols-12 items-center">
            <div class="lg:order-1 col-span-12 lg:h-[577px] lg:col-span-4 mt-16 order-2 -z-50">
                <div class="lg:flex lg:flex-col">
                    <button class="lg:mx-0 px-8 py-4 w-fit bg-white text-pink flex gap-2 text-xl font-bold drop-shadow-sm-shadow rounded-full mx-auto">
                        Explore the Fresh Look!
                    </button>
                    <h1 class="lg:w-[412px] lg:h-[249px] lg:text-start lg:text-[69px] md:text-[56px] md:my-[43px] mt-4 mb-6 text-center font-bold text-[40px] text-grey leading-tight">Make <span class="text-pink typing" id="typing-text">your clothes</span> always Fresh!</h1>
                    <p class="lg:w-full lg:text-start lg:mt-16 md:text-[18px] md:w-3/4 md:mb-[43px] mx-auto mb-8 text-center text-grey opacity-50 text-base font-inter">We will provide a gentle and caring touch to your clothes, ensuring they look fresh and perfectly pressed</p>
                </div>
                {{-- <script>
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
                </script> --}}
            </div>
            <div class="lg:order-2 col-span-12 lg:col-span-8 order-1 mx-auto text-center relative lg:w-[772px] md:w-[772px] w-[396px] lg:h-[726px] md:h-[713px] h-[366px]">
                <div class="lg:w-[772px] md:w-[772px] w-[396px] lg:h-[287px] md:h-[287px] h-[147px] relative top-0 left-0 flex flex-row items-center">
                    <img src="{{ asset('storage/assets/earth-vector.png') }}" alt="" class="lg:w-[660px] md:w-[660px] lg:h-[268px] md:h-[268px] w-[339px] h-[137px] relative lg:top-[17px] md:top-[17px] lg:left-[46px] md:left-[46px] top-[9px] left-[28px]">
                    <img src="{{ asset('storage/assets/icon-ironpress11.png') }}" alt="" class="lg:w-[44px] md:w-[44px] w-[18px] lg:h-[33px] md:h-[33px] h-[16px] absolute lg:top-[42px] md:top-[42px] top-[17px] lg:left-[88px] md:left-[88px] left-[52px]">
                    <img src="{{ asset('storage/assets/icon-ironpress12.png') }}" alt="" class="lg:w-[230px] md:w-[230px] w-[118px] lg:h-[211px] md:h-[211px] h-[109px] absolute lg:top-[63px] md:top-[63px] top-[32px] left-0 z-10">
                    <img src="{{ asset('storage/assets/icon-ironpress2.png') }}" alt="" class="lg:w-[391px] md:w-[391px] w-[201px] lg:h-[199px] md:h-[199px] h-[104px] absolute lg:top-[1px] md:top-[1px] top-0 lg:left-[211px] md:left-[211px] left-[108px] z-10">
                    <img src="{{ asset('storage/assets/icon-ironpress3.png') }}" alt="" class="lg:w-[160px] md:w-[160px] w-[87px] lg:h-[240px] md:h-[240px] h-[125px] absolute lg:top-[3px] md:top-[3px] top-0 lg:left-[612px] md:left-[612px] left-[309px] z-10">
                    <img src="{{ asset('storage/assets/hanger.png') }}" alt="" class="lg:w-[52px] md:w-[52px] w-[32px] lg:h-[52px] md:h-[52px] h-[32px] absolute lg:top-[118px] md:top-[118px] top-[42px] lg:left-[656px] md:left-[656px] left-[333px] z-10 transform rotate-[10deg]">
                </div>
                <div class="lg:col-span-6 col-span-12 absolute lg:w-[575px] md:w-[575px] w-[295px] lg:h-[632px] md:h-[632px] h-[324px] lg:top-[75px] md:top-[75px] top-[38px] lg:left-[91px] md:left-[91px] left-[47px] flex flex-row justify-between items-center">
                    <div class="lg:col-span-3 col-span-6 flex flex-col justify-between gap-7">
                        <img src="{{ asset('storage/assets/hero1.png') }}" alt="" class="w-full layer" data-speed="3">
                        <img src="{{ asset('storage/assets/hero3.png') }}" alt="" class="w-full layer" data-speed="2">
                    </div>
                    <img src="{{ asset('storage/assets/hero2.png') }}" alt="" class="lg:w-[272px] md:w-[272px] w-[140px] lg:h-[400px] md:h-[400px] h-[205px] layer" data-speed="4">
                </div>
                <img src="{{ asset('storage/assets/icon1.png') }}" alt="" class="absolute lg:top-[341px] md:top-[341px] top-[175px] lg:left-[56px] md:left-[56px] left-[29px] lg:w-[82px] md:w-[82px] w-[33px] lg:h-[82px] md:h-[82px] h-[33px] drop-shadow-md-shadow layer" data-speed="-1">
                <img src="{{ asset('storage/assets/icon2.png') }}" alt="" class="absolute lg:top-[649px] md:top-[649px] top-[365px] lg:left-[474px] md:left-[474px] left-[244px] lg:w-[77px] md:w-[77px] w-[33px] lg:h-[77px] md:h-[77px] h-[33px] drop-shadow-md-shadow layer" data-speed="5">
                <img src="{{ asset('storage/assets/icon3.png') }}" alt="" class="absolute lg:top-[488px] md:top-[488px] top-[282px] lg:left-[592px] md:left-[592px] left-[305px] lg:w-[166px] md:w-[166px] w-[85px] drop-shadow-md-shadow layer" data-speed="-2">
            </div>
            <!-- JavaScript using GSAP -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            {{-- <script>
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
            </script> --}}

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

        // introJs().setOptions({
        //     dontShowAgain: true,
        //     dontShowAgainCookieDays: 1,
        //     showProgress: true,
        //     showBullets: false,
        //     steps: [{
        //         title: 'Selamat Datang di PressIt',
        //         intro: 'Silahkan mengikuti tour singkat Kami'
        //     },{
        //         element: document.querySelector('.service'),
        //         title: 'Service Kami!',
        //         intro: 'Kami menyediakan beberapa service untuk memperhalus dan merapikan Pakaian Anda',
        //         position: 'left'
        //     },{
        //         element: document.querySelector('.button-paket'),
        //         intro: 'Ayo pesan layanan kami sekarang!',
        //         position: 'top',
        //     },{
        //         title: 'Register atau Login',
        //         intro: 'Tapi jangan lupa buat Akun-Mu dulu di pojok kanan atas!',
        //     },{
        //         element: document.querySelector('.button-login'),
        //         intro: 'Disini!'
        //     }]
        // }).start();
    </script>
@endonce

<section>

</section>

@endsection