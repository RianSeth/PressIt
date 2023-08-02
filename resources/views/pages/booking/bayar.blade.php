@extends('layouts.app')

@section('body')

<div>
    <div>

        <head>
            {{-- style --}}
            {{-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> --}}
            <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet">
            <!-- Tambahkan link ke library jQuery dan jQuery UI -->
            {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
        </head>
        
        <!--Back link -->
        <div class="w-full lg:w-4/5 lg:ml-auto text-base md:text-sm text-gray-600 px-2 mb-8">
        <span class="text-base text-yellow-600 font-bold">&lt;</span> <a href="{{ route('booking') }}" class="text-base md:text-sm text-yellow-600 font-bold no-underline hover:underline">Back Home</a>
    </div>
    
    <!--Container-->
    <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-1 mt-16">
    
        <div class="w-full lg:w-1/5 px-6 text-xl text-gray-800 leading-normal">
            <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">Menu</p>
            <div class="block lg:hidden sticky inset-0">
                <button id="menu-toggle" class="flex w-full justify-end px-3 py-3 bg-white lg:bg-transparent border rounded border-gray-600 hover:border-yellow-600 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 float-right" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </button>
            </div>
            <div class="w-full sticky inset-0 hidden max-h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 my-2 lg:my-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20" style="top:6em;" id="menu-content">
                <ul class="list-reset py-2 md:py-0">
                    <li class="py-1 md:my-2 hover:bg-yellow-100 lg:hover:bg-transparent border-l-4 border-transparent font-bold border-yellow-600">
                        <a href='#section1' class="block pl-4 align-middle text-gray-700 no-underline hover:text-yellow-600">
                            <span class="pb-1 md:pb-0 text-sm">Pembayaran</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    
        <!--Section container-->
        <section x-data="calc()" x-effect="setEndDate()" class="w-full lg:w-4/5">
            <form onsubmit="return confirm('Sudah Yakin dengan Pembayaran yang Dimasukkan?');" action="{{ route('bookpayupdate', $pemesanans->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <!--Title-->
                <h1 class="flex items-center font-sans font-bold break-normal text-gray-700 px-2 text-xl mt-12 lg:mt-0 md:text-2xl">
                    Perhatikan Pembayaran Anda
                </h1>

                <!--divider-->
                <hr class="bg-gray-300 my-12">

                {{-- Pembayaran --}}
                <!--Title-->
                <h2 id='section1' class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">Pembayaran Anda</h2>
        
                <!--Card-->
                <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
        
                    {{-- Alamat pelanggan --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                                Alamat Anda
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea name="address" class="form-textarea block w-full focus:bg-white" id="alamat my-textarea" rows="8" required>{{ $pemesanans->address }}</textarea>
                            <p class="py-2 text-sm text-gray-600">*perhatikan alamat anda</p>
                        </div>
                    </div>

                    {{-- Tipe Pengambilan --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Tipe Pickup
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            @php
                                $antar = "kurir";
                                $ambil = "mandiri";
                            @endphp
                            <input type="text" name="tipe_pickup" class="form-input block w-full focus:bg-white" id="my-textfield" value="{{ $pemesanans->tipe_pickup }}" readonly>
                            {{-- <select name="tipe_pickup" class="form-input block w-full focus:bg-white" id="my-textfield" readonly>
                                <option value="" hidden>--Pilih--</option>
                                <option value="kurir" {{ $pemesanans->tipe_pickup == $antar ? 'selected' : '' }} >Sewa Kurir</option>
                                <option value="mandiri" {{ $pemesanans->tipe_pickup == $ambil ? 'selected' : '' }} >Ambil Mandiri</option>
                            </select> --}}
                            <p class="py-2 text-sm text-gray-600">*bisa diambil sendiri atau pakai "kurir" (akan ada biaya tambahan)</p>
                        </div>
                    </div>

                    {{-- Total Harga Akhir --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Total Harga
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            @if (($pemesanans->tipe_pickup == 'kurir') && ($pemesanans->harga_kurir > 0))
                                @php
                                    $total = $pemesanans->harga_kurir + $pemesanans->total_price;
                                @endphp
                                <input name="total" class="form-input block w-full focus:bg-white" id="my-textfield" type="number" value="{{ $total }}" readonly >
                            @else
                                <input name="total" class="form-input block w-full focus:bg-white" id="my-textfield" type="number" value="{{ $pemesanans->total_price }}" readonly >    
                            @endif
                            <p class="py-2 text-sm text-gray-600">*total harga fix yang perlu anda bayarkan (bertambah jika menggunakan kurir)</p>
                        </div>
                    </div>

                    @if ($pemesanans->tipe_pickup === 'kurir')
                        @if ($pemesanans->harga_kurir > 0)
                            {{-- QR Code pembayaran --}}
                            <div class="md:flex mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                        Pembayaran
                                    </label>
                                </div>
                                <div x-data="{ showQRCode: false }" class="md:w-2/3">
                                    <p @click="showQRCode = !showQRCode" class="form-input block w-full focus:bg-white cursor-pointer" id="my-textfield">Tekan menampilkan QR Code</p>
                                    <p class="py-2 text-sm text-gray-600">Jangan lupa untuk selalu Screenshoot bukti bahwa Anda sudah MEMBAYAR!</p>
                                    <div class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showQRCode" x-on:click.away="showQRCode = !showQRCode">
                                        <div x-on:click="showQRCode = !showQRCode" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center flex-col">
                                            <img src="{{ asset('storage/qris.png') }}" alt="Preview Gambar" class="w-3/4 h-3/4 object-contain rounded">
                                            <p class="py-2 text-sm text-black">Jangan lupa untuk selalu Screenshoot bukti bahwa Anda sudah MEMBAYAR!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Bukti Pembayaran --}}
                            <div class="md:flex mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                        Bukti Pembayaran
                                    </label>
                                </div>
                                <div x-data="{ imagePreview: null, showPreview: false }" class="md:w-2/3">
                                    <input name="bukti_pembayaran" class="form-input block w-full focus:bg-white" id="my-textfield" type="file" x-on:change="handleImagePreview($event)">
                                    <p class="py-2 text-sm text-gray-600">*berikan bukti cukup berupa format .jpg|.jpeg|.png</p>
                                    @if (isset($pemesanans->pembayaran->bukti_pembayaran))
                                    <img @click="showPreview = !showPreview" x-bind:src="imagePreview" src="{{ asset('storage/'.$pemesanans->pembayaran->bukti_pembayaran) }}" alt="Preview Gambar" class="w-32 h-32 object-cover rounded">
                                    <div class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showPreview" x-on:click.away="showPreview = !showPreview">
                                        <div x-on:click="showPreview = !showPreview" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center">
                                            <img x-bind:src="imagePreview" src="{{ asset('storage/'.$pemesanans->pembayaran->bukti_pembayaran) }}" alt="Preview Gambar" class="w-2/4 h-2/4 object-contain rounded">
                                        </div>
                                    </div>
                                    @else
                                    <img @click="showPreview = !showPreview" x-bind:src="imagePreview" alt="Preview Gambar" class="w-32 h-32 object-cover rounded">
                                    <div class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showPreview" x-on:click.away="showPreview = !showPreview">
                                        <div x-on:click="showPreview = !showPreview" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center">
                                            <img x-bind:src="imagePreview" alt="Preview Gambar" class="w-2/4 h-2/4 object-contain rounded">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @else
                        <p class="py-2 text-sm text-gray-600">Tunggu Admin sedang menyesuaikan harga kurir untuk Anda</p>
                        @endif
                    @else
                    {{-- QR Code pembayaran --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Pembayaran
                            </label>
                        </div>
                        <div x-data="{ showQRCode: false }" class="md:w-2/3">
                            <p @click="showQRCode = !showQRCode" class="form-input block w-full focus:bg-white cursor-pointer" id="my-textfield">Tekan menampilkan QR Code</p>
                            <p class="py-2 text-sm text-gray-600">Jangan lupa untuk selalu Screenshoot bukti bahwa Anda sudah MEMBAYAR!</p>
                            <div class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showQRCode" x-on:click.away="showQRCode = !showQRCode">
                                <div x-on:click="showQRCode = !showQRCode" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center flex-col">
                                    <img src="{{ asset('storage/qris.png') }}" alt="Preview Gambar" class="w-3/4 h-3/4 object-contain rounded">
                                    <p class="py-2 text-sm text-black">Jangan lupa untuk selalu Screenshoot bukti bahwa Anda sudah MEMBAYAR!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bukti Pembayaran --}}
                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Bukti Pembayaran
                            </label>
                        </div>
                        <div x-data="{ imagePreview: null, showPreview: false }" class="md:w-2/3">
                            <input name="bukti_pembayaran" class="form-input block w-full focus:bg-white" id="my-textfield" type="file" x-on:change="handleImagePreview($event)">
                            <p class="py-2 text-sm text-gray-600">*berikan bukti cukup berupa format .jpg|.jpeg|.png</p>
                            @if (isset($pemesanans->pembayaran->bukti_pembayaran))
                            <img @click="showPreview = !showPreview" x-bind:src="imagePreview" src="{{ asset('storage/'.$pemesanans->pembayaran->bukti_pembayaran) }}" alt="Preview Gambar" class="w-32 h-32 object-cover rounded">
                            <div class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showPreview" x-on:click.away="showPreview = !showPreview">
                                <div x-on:click="showPreview = !showPreview" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center">
                                    <img x-bind:src="imagePreview" src="{{ asset('storage/'.$pemesanans->pembayaran->bukti_pembayaran) }}" alt="Preview Gambar" class="w-2/4 h-2/4 object-contain rounded">
                                </div>
                            </div>
                            @else
                            <img @click="showPreview = !showPreview" x-bind:src="imagePreview" alt="Preview Gambar" class="w-32 h-32 object-cover rounded">
                            <div class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showPreview" x-on:click.away="showPreview = !showPreview">
                                <div x-on:click="showPreview = !showPreview" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center">
                                    <img x-bind:src="imagePreview" alt="Preview Gambar" class="w-2/4 h-2/4 object-contain rounded">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
        
                </div>
                <!--/Card-->
                {{-- Pembayaran --}}

                <!--divider-->
                <hr class="bg-gray-300 my-12">
        
                {{-- Konfirmasi Data --}}
                <!--Title-->
                <h2 id='section2' class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">Konfirmasi</h2>
        
                <!--Card-->
                <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
                    <blockquote class="border-l-4 border-yellow-600 italic my-4 pl-8 md:pl-12">Periksa kembali data Anda dengan tombol "Konfirmasi" dibawah, jika ada kesalahan silahkan kembali dan tekan "Ubah Data Pemesanan"</blockquote>
        
                    <div x-data="{'PemesanModal' : false}" x-on:keydown.escape="PemesanModal=false" class="pt-8">

                        <button type="submit" class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mr-4" type="button">
                            Konfirmasi
                        </button>

                        <button class="shadow bg-yellow-100 hover:bg-yellow-200 focus:shadow-outline focus:outline-none text-gray-700 font-bold py-2 px-4 rounded mr-4" type="button">
                            <a href="#section1">
                                Ubah Data Pemesanan
                            </a>
                        </button>

                    </div>
                </div>

            </form>
    
        </section>
    
        <!--Back link -->
        <div class="w-full lg:w-4/5 lg:ml-auto text-base md:text-sm text-gray-600 px-4 py-24 mb-12">
            <span class="text-base text-yellow-600 font-bold">&lt;</span> <a href="{{ route('booking') }}" class="text-base md:text-sm text-yellow-600 font-bold no-underline hover:underline">Back Home</a>
        </div>
    
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    // Live auto calculate
    function calc() {
        return {
            imagePreview: null,

            handleImagePreview(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            },
        };
    }

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