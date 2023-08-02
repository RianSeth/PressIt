@extends('layouts.app')

@section('body')

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
                        <span class="pb-1 md:pb-0 text-sm">Data Pemesanan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!--Section container-->
    <section x-data="calc()" x-effect="setEndDate()" class="w-full lg:w-4/5">
        <form onsubmit="return confirm('Sudah Yakin dengan Data yang Dimasukkan?');" action="{{ route('bookupdate', $pemesanans->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!--Title-->
        <h1 class="flex items-center font-sans font-bold break-normal text-gray-700 px-2 text-xl mt-12 lg:mt-0 md:text-2xl">
            Sesuaikan Pemesanan Anda
        </h1>

        <!--divider-->
        <hr class="bg-gray-300 my-12">

        {{-- Data Pemesanan --}}
        <!--Title-->
        <h2 id='section1' class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">Pemesanan Anda</h2>

        <!--Card-->
        <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">

            {{-- Nomor Pemesanan --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nomor Pemesanan
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="{{ $pemesanans->nomor_pemesanan }}" required readonly>
                    <p class="py-2 text-sm text-gray-600">*nomor pemesanan anda</p>
                </div>
            </div>

            {{-- Nama pelanggan --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nama Anda
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="{{ $users->name }}" readonly>
                    <p class="py-2 text-sm text-gray-600">*nama anda</p>
                </div>
            </div>

            {{-- Telephone Pelanggan --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Telephone Anda
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="{{ $users->address_user->telp }}" readonly>
                    <p class="py-2 text-sm text-gray-600">*konfirmasi nomor anda, jika ada kesalahan silahkan ke profil</p>
                </div>
            </div>

            {{-- Jenis Paket --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Jenis Paket
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="{{ $pemesanans->paket->jenis }}" readonly>
                    <p class="py-2 text-sm text-gray-600">*paket pilihan anda</p>
                </div>
            </div>

            {{-- Alamat pelanggan --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                        Alamat Anda
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea name="address" class="form-textarea block w-full focus:bg-white" id="alamat my-textarea" rows="8" required x-model="address1">{{ $pemesanans->address }}</textarea>
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
                    <select name="tipe_pengambilan" class="form-input block w-full focus:bg-white" id="my-textfield" x-model="pickup">
                        <option value="" hidden>--Pilih--</option>
                        <option value="kurir" {{ $pemesanans->tipe_pickup == $antar ? 'selected' : '' }} >Sewa Kurir</option>
                        <option value="mandiri" {{ $pemesanans->tipe_pickup == $ambil ? 'selected' : '' }} >Ambil Mandiri</option>
                    </select>
                    <p class="py-2 text-sm text-gray-600">*bisa diambil sendiri atau pakai "kurir" (akan ada biaya tambahan)</p>
                </div>
            </div>

            {{-- Jumlah --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Jumlah
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="jumlah" class="form-input block w-full focus:bg-white" id="jumlah my-textfield" type="number" placeholder="jumlah kilogram" x-model="quantity" @input="update_total" @change="reset_start_date" required>
                    @if ($pemesanans->paket->jenis === 'Biasa')
                    <p class="py-2 text-sm text-gray-600">*jumlah kilo (paket biasa)</p>
                    @else
                    <p class="py-2 text-sm text-gray-600">*jumlah pakaian (paket khusus)</p>
                    @endif
                </div>
            </div>

            <input type="hidden" name="batas" x-model:value="newBatas" value="{{ $batasOld }}">

            {{-- Tanggal Mulai Pemesanan --}}
            <div class="md:flex mb-6">
                <div x-data="{showBooked : false}" class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Tanggal Pemesanan
                    </label>
                    <div x-on:click="showBooked = !showBooked" class="h-min w-max cursor-pointer bg-slate-600 text-slate-900 p-1 rounded-md my-2 shadow-md hover:bg-slate-400">
                        See Available
                    </div>
                    <div x-show="showBooked" class="absolute backdrop-blur-sm bg-black/30 p-2 rounded-md">
                        @foreach ($allBookings as $booking)
                            @php
                                $strtDate = strftime('%d %B %Y', strtotime($booking->tanggal_mulai));
                                $enDate = strftime('%d %B %Y', strtotime($booking->tanggal_selesai));
                                $tomorrow1 = date('Y-m-d', strtotime('+1 day'));
                            @endphp
                            @if ($strtDate < strtotime($tomorrow1))
                                @if ($booking->count() > 0)
                                    <p>Booked/Full: {{ $strtDate }} - {{  $enDate }}</p>
                                @else
                                    <p>Empty</p>
                                @endif
                            @endif
                        @endforeach
                        <hr>
                        @foreach ($bookingReady as $booking)
                            @php
                                $strtDate = strftime('%d %B %Y', strtotime($booking->tanggal_mulai));
                                $enDate = strftime('%d %B %Y', strtotime($booking->tanggal_selesai));
                                $tomorrow1 = date('Y-m-d', strtotime('+1 day'));
                            @endphp
                            @if ($strtDate < strtotime($tomorrow1))
                                @if ($booking->count() > 0)
                                    <p>Terkumpul: {{ $booking->batas }}/40kg</p>
                                    <p>Durasi   : {{ $strtDate }} - {{ $enDate }}</p>
                                    <hr>
                                @else
                                    <p>Empty</p>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="md:w-2/3">
                    <input name="tanggal_mulai" class="date startDate form-input block w-full focus:bg-white" id="my-textfield" type="text" placeholder="Masukkan tanggal mulai" required x-model="startDate" x-bind:value="startDate" @input="setEndDate">
                    <p class="py-2 text-sm text-gray-600">*tanggal anda ingin mengirim baju</p>
                    <p class="py-2 text-sm font-red" x-text="message"></p>
                </div>
            </div>
            @once
                {{-- Datepicker --}}
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <script>
                    const bookingRanges = @json($bookingRanges);
                    const tomorrow = @json($tomorrow);
                    flatpickr('.date', {
                        minDate: tomorrow,
                        dateFormat: "Y-m-d",
                        disable: bookingRanges,
                    });
                </script>
            @endonce

            {{-- Tanggal Selesai Pemesanan --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Tanggal Selesai
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="tanggal_selesai" class="date endDate form-input block w-full focus:bg-white" id="my-textfield" type="text" placeholder="Tanggal selesai penyetrikaan" required readonly x-bind:min="startDate" x-model="endDate" x-effect="setEndDate()">
                    <p class="py-2 text-sm text-gray-600">*tanggal selesai setrika baju</p>
                </div>
            </div>

            {{-- Sub Total Harga --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Sub Total Harga
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="total_price" class="form-input block w-full focus:bg-white" id="total_harga my-textfield" type="number" value="{{ $pemesanans->total_price }}" x-bind:value="totalHarga.toFixed(0)" required readonly>
                    <p class="py-2 text-sm text-gray-600">*berdasarkan jumlah yang dimasukkan</p>
                </div>
            </div>

        </div>
        <!--/Card-->
        {{-- Data Pemesanan --}}

        <!--divider-->
        <hr class="bg-gray-300 my-12">

        {{-- Konfirmasi Data --}}
        <!--Title-->
        <h2 id='section3' class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">Konfirmasi</h2>

        <!--Card-->
        <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
            <blockquote class="border-l-4 border-yellow-600 italic my-4 pl-8 md:pl-12">Periksa kembali data Anda sebelum "Konfirmasi", jika ada kesalahan silahkan kembali atau tekan "Ubah Data Pemesanan"</blockquote>

                <div class="pt-8">

                    <button type="submit" class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mr-4" type="button">
                        Konfirmasi
                    </button>

                    <button class="shadow bg-yellow-100 hover:bg-yellow-200 focus:shadow-outline focus:outline-none text-gray-700 font-bold py-2 px-4 rounded mr-4" type="button">
                        <a href="#section1">
                            Ubah Data Pemesanan
                        </a>
                    </button>

                    {{-- @include('pages.booking.confbooked') --}}

                </div>
        </div>
        </form>
    </section>

    <!--Back link -->
    <div class="w-full lg:w-4/5 lg:ml-auto text-base md:text-sm text-gray-600 px-4 py-24 mb-12">
        <span class="text-base text-yellow-600 font-bold">&lt;</span> <a href="{{ route('booking') }}" class="text-base md:text-sm text-yellow-600 font-bold no-underline hover:underline">Back Home</a>
    </div>

</div>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    // Live auto calculate
    function calc() {
        return {
            address1: "{{ $pemesanans->address }}",
            pickup: "{{ $pemesanans->tipe_pickup }}",
            price: {{ $pemesanans->paket->harga }},
            quantityWarning: false,
            quantity: {{ $pemesanans->jumlah }},
            startDate: new Date(' {{ $pemesanans->batas->tanggal_mulai }} '),
            endDate: new Date(' {{ $pemesanans->batas->tanggal_selesai }} '),
            bookingRanges: @json($bookingRanges),
            showDateNotAvailable: false,
            totalHarga: {{ ($pemesanans->pembayaran->total > 0) ? $pemesanans->pembayaran->total : $pemesanans->total_price }},
            bookingReadyRanges: @json($bookingReadyRanges),
            newBatas: {{ $batasOld }},
            message: "",

            

            update_total() {
                let price = parseFloat(this.price);
                let quantity = parseFloat(this.quantity);

                if (!isNaN(price) && !isNaN(quantity)) {
                    this.totalHarga = price * quantity;
                } else {
                    this.totalHarga = 0;
                }

                // Check if quantity is 0 and show/hide the warning message
                this.quantityWarning = quantity === 0;
            },

            setEndDate() {
                let startDate = new Date(this.startDate);
                let endDate = new Date(this.startDate);
                endDate.setDate(endDate.getDate() + 1);
                // console.log(this.startDate);
                // console.log(this.endDate);

                for (const range of this.bookingReadyRanges) {
                    let from = new Date(range.from);
                    let to = new Date(range.to);

                    let batas;
                    let newBatas;

                    console.log("startDate:", startDate);
                    console.log("endDate:", endDate);
                    console.log("from:", from);
                    console.log("to:", to);

                    if (range.id === {{ $pemesanans->batas_id }}) {
                        batas = {{ $batasOld }};
                        newBatas = parseInt(batas) + parseInt(this.quantity);
                        this.newBatas = newBatas;
                    } else {
                        batas = range.batas;
                        newBatas = parseInt(batas) + parseInt(this.quantity);
                        this.newBatas = newBatas;
                    }

                    console.log(newBatas);
                    // console.log(from);
                    // console.log(to);

                    if (startDate >= from && startDate <= to) {
                        if (newBatas <= 40) {
                            this.newBatas = newBatas;
                            document.querySelector('.startDate').value = from.toISOString().slice(0, 10);
                            document.querySelector('.endDate').value = to.toISOString().slice(0, 10);
                            this.message = "*Tanggal yang Anda pilih berada di list booking dan jumlah Anda masih mencukupi dari total batas (kurang dari 40KG), silahkan lihat pada tombol 'See Available'";
                        } else {
                            this.newBatas = newBatas;
                            document.querySelector('.startDate').value = '';
                            document.querySelector('.endDate').value = '';
                            this.message = "*Tanggal yang Anda pilih berada di list booking dan jumlah Anda melewati dari total batas (lebih dari 40KG), silahkan lihat pada tombol 'See Available'";
                        }
                        return;
                    }
                    
                    if (endDate >= from && endDate < to) {
                        if (newBatas <= 40) {
                            this.newBatas = newBatas;
                            document.querySelector('.startDate').value = from.toISOString().slice(0, 10);
                            document.querySelector('.endDate').value = to.toISOString().slice(0, 10);
                            this.message = "**Tanggal yang Anda pilih berada di list booking dan jumlah Anda masih mencukupi dari total batas (kurang dari 40KG), silahkan lihat pada tombol 'See Available'";
                            console.log(this.startDate);
                            console.log(this.endDate);
                        } else {
                            this.newBatas = newBatas;
                            document.querySelector('.startDate').value = '';
                            document.querySelector('.endDate').value = '';
                            this.message = "**Tanggal yang Anda pilih berada di list booking dan jumlah Anda melewati dari total batas (lebih dari 40KG), silahkan lihat pada tombol 'See Available'";
                        }
                        return;
                    }

                    if (startDate != from && endDate != to) {
                        if (endDate != from && startDate != to) {
                            newBatas = this.quantity;
                            if (newBatas <= 40) {
                                this.newBatas = newBatas;
                                document.querySelector('.startDate').value = startDate.toISOString().slice(0, 10);
                                // Gunakan variabel sementara untuk menghitung endDate
                                let tempEndDate = new Date(startDate);
                                tempEndDate.setDate(tempEndDate.getDate() + 1);
                                document.querySelector('.endDate').value = tempEndDate.toISOString().slice(0, 10);
                                this.message = "*Anda memilih tanggal baru (tidak ada di list) dan jumlah yang Anda berikan mencukupi 'kurang dari 40KG'";
                            } 

                            if (newBatas > 40) {
                                this.newBatas = newBatas;
                                document.querySelector('.startDate').value = "";
                                // Gunakan variabel sementara untuk menghitung endDate
                                let tempEndDate = new Date(startDate);
                                tempEndDate.setDate(tempEndDate.getDate() + 1);
                                document.querySelector('.endDate').value = "";
                                this.message = "*Anda memilih tanggal baru (tidak ada di list) dan jumlah yang Anda berikan melewati 'lebih dari 40KG'";
                            }
                        }
                    }
                }



                // Check if startDate or endDate exists in bookingReadyRanges from or to
                // let foundRange = this.bookingReadyRanges.find(range => {
                //     let rangeStart = new Date(range.from);
                //     let rangeEnd = new Date(range.to);
                //     console.log(rangeStart);
                //     console.log(rangeEnd);
                //     return (
                //         (startDate >= rangeStart && startDate <= rangeEnd) || (endDate >= rangeStart && endDate <= rangeEnd)
                //     );
                // });

                // if (foundRange) {
                //     // Find matched batas for startDate or endDate
                //     let matchedBatas = this.findMatchedBatas(startDate, endDate);

                //     if (matchedBatas) {
                //         if (matchedBatas.batas <= 40) {
                //             this.startDate = foundRange.from;
                //             this.endDate = foundRange.to;
                //             // Save batas to the batas column
                //             let newBatas = matchedBatas.batas + this.quantity;
                //         } else {
                //             this.startDate = '';
                //             this.endDate = '';
                //             // Display notification: Anda tidak berada dalam batas pakaian pada tanggal startDate - endDate
                //         }   
                //     }
                // } else {
                //     // Replace these conditions with your actual paket type check
                //     let newBatas = this.quantity + matchedBatas.batas;
                //     // Insert new entry to the bookingReadyRanges with startDate, endDate (startDate + 1), and batas
                // }
            },

            reset_start_date() {
                this.startDate = '';
                this.endDate = '';
            },

            // checkDateRange() {
            //     for (const range of bookingRanges) {
            //         let startDate = new Date(this.startDate);
            //         let endDate = new Date(this.endDate);
            //         let from = new Date(range.from);
            //         let to = new Date(range.to);

            //         console.log("from:", from);
            //         console.log("to:", to);
            //         console.log("start:", startDate);
            //         console.log("finsih:", endDate);

            //         if ((startDate >= from && startDate <= to) || (from >= startDate && from <= endDate)) {
            //             // Jika ditemukan tumpang tindih, set isOverlap menjadi true dan keluar dari loop
            //             this.startDate = '';
            //             this.$refs.endDateInput.value = '';
            //             this.showDateNotAvailable = true;
            //             break;
            //         }else {
            //             this.showDateNotAvailable = false; continue;
            //         } 
            //     }
                
            // },
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
</div>
@endsection