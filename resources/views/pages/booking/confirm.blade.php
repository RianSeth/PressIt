{{-- Form data yang dikirim --}}

<div 
class="absolute container flex justify-center top-0 w-full h-screen left-0 z-50 mx-8"
role="dialog"
tabindex="-1"
x-show="PemesanModal"
x-on:click.away="PemesanModal = false"
x-cloak
x-transition
>
<div id="spin-wrapper" class="w-screen h-screen absolute bg-white z-50"></div>
    <div class="fixed flex justify-center items-center w-full h-full bg-black/50">

        <form action="{{ route('bookstore') }}" method="post" enctype="multipart/form-data" class="fixed overflow-auto h-5/6 w-3/4 p-8 leading-normal rounded shadow bg-white"> {{-- route(booking.store) --}}
            @csrf

            <div>

                {{-- Nomor Pemesanan --}}
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Nomor Pemesanan
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="nomor_pemesanan" class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="{{ $orderNumber }}" readonly>
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
                        <input type="hidden" name="users_id" value="{{ $users->id }}">
                        <p class="py-2 text-sm text-gray-600">*nama anda</p>
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
                        <input class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="{{ $pakets->jenis }}" readonly>
                        <input type="hidden" name="paket_id" value="{{ $pakets->id }}">
                        <p class="py-2 text-sm text-gray-600">*paket pilihan anda</p>
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
                        <input name="jumlah" class="form-input block w-full focus:bg-white" id="jumlah my-textfield" type="number" placeholder="jumlah kilogram" x-bind:value="quantity" readonly>
                        {{-- Display warning message --}}
                        <div x-show="quantity === 0" class="text-red-500 mt-2">Anda belum memasukkan jumlah!</div>
                        @if ($pakets->jenis === 'Biasa')
                        <p class="py-2 text-sm text-gray-600">*jumlah kilo (paket biasa)</p>
                        @else
                        <p class="py-2 text-sm text-gray-600">*jumlah pakaian (paket khusus)</p>
                        @endif
                    </div>
                </div>

                <input type="hidden" name="batas" x-model:value="newBatas">

                {{-- Tanggal Mulai --}}
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Tanggal Pemesanan dan Mulai
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="tanggal_mulai" class="form-input block w-full focus:bg-white" id="my-textfield" type="date" placeholder="tanggal mulai" x-bind:value="startDate" readonly>
                        <p class="py-2 text-sm text-gray-600">*tanggal mulai penyetrikaan</p>
                    </div>
                </div>

                {{-- Tanggal Selesai --}}
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Tanggal Selesai
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="tanggal_selesai" class="form-input block w-full focus:bg-white" id="my-textfield" type="date" placeholder="tanggal selesai" x-bind:value="endDate" readonly>
                        <p class="py-2 text-sm text-gray-600">*tanggal selesai penyetrikaan</p>
                    </div>
                </div>


                {{-- Total Harga --}}
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Total Harga
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="total_harga" class="form-input block w-full focus:bg-white" id="total_harga my-textfield" type="number" x-bind:value="totalHarga.toFixed(0)" readonly>
                        <p class="py-2 text-sm text-gray-600">*berdasarkan jumlah yang dimasukkan</p>
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
                        <input type="text" name="tipe_pengambilan" class="form-input block w-full focus:bg-white" id="my-textfield" x-bind:value="pickup" readonly>
                        <p class="py-2 text-sm text-gray-600">*bisa diambil sendiri atau pakai "kurir" (akan ada biaya tambahan)</p>
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
                        <textarea name="address" class="form-textarea block w-full focus:bg-white" id="alamat1 my-textarea" value="" rows="8" readonly x-text="address1"></textarea>
                        <p class="py-2 text-sm text-gray-600">*perhatikan alamat anda</p>
                    </div>
                </div>

            </div>

            <div class="fixed bottom-9">
                <button x-bind:disabled="quantity === 0" class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mr-4">
                    Kirim
                </button>

                <button x-on:click="PemesanModal = false" onclick="event.preventDefault();" class="shadow bg-yellow-100 hover:bg-yellow-200 focus:shadow-outline focus:outline-none text-gray-700 font-bold py-2 px-4 rounded mr-4">
                    Kembali
                </button>
            </div>

        </form>

    </div>
</div>