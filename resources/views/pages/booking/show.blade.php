<div class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center z-50" x-show="showPayment" x-on:click.away="showPayment = !showPayment">
    <div x-on:click="showPayment = !showPayment" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center">
        <div class="m-0 w-[250px]" id="order-receipt">
            <div class="p-5 text-xs bg-white">
                <div>
                    <div class="flex flex-col">
                        <h1 class="m-0 text-gray-800 text-xl font-medium">Press It</h1>
                        @php
                            $currentDate = date('d-m-Y');
                        @endphp
                        <p class="m-0 text-gray-600 text-xs">Date: {{ $currentDate }}</p>
                        <p class="m-0 text-gray-600 text-xs">Order Number: {{ $pmsn->nomor_pemesanan }}</p>
                    </div>
                    <hr class="my-4 ">
                    <div>
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span class="font-medium text-base">Payable to :</span>
                        <span class="font-medium text-base">{{ $pmsn->user->name }}</span>
                    </div>
                    <span>---</span>
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span>Detail Address :</span>
                        <span>{{ $pmsn->address }}</span>
                    </div>
                    <hr class="my-4 ">
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span class="font-medium text-base">Service :</span>
                        <span class="font-medium text-base">{{ $pmsn->paket->jenis }}</span>
                    </div>
                    <span>---</span>
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span>Price :</span>
                        <span>Rp {{ number_format($pmsn->paket->harga, 0, ',', '.') }}/{{ $pmsn->paket->satuan_harga }}</span>
                    </div>
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span>Tanggal Mulai :</span>
                        <span>{{ $pmsn->batas->tanggal_mulai }}</span>
                    </div>
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span>Tanggal Selesai :</span>
                        <span>{{ $pmsn->batas->tanggal_selesai }}</span>
                    </div>
                    <hr class="my-4 ">
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span class="font-medium text-base">Your Order :</span>
                    </div>
                    <span>---</span>
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span>Quantity :</span>
                        <span>{{ $pmsn->jumlah }} {{ $pmsn->paket->satuan_harga == 'pakaian' ? 'Pakaian' : 'KG' }}</span>
                    </div>
                    <div class="flex flex-row flex-wrap justify-between mb-1">
                        <span>Pickup ({{ $pmsn->tipe_pickup }}) :</span>
                        <span>Rp {{ number_format($pmsn->harga_kurir, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex flex-row flex-wrap justify-between mb-2 print:mb-2">
                        <span>Sub Total : </span>
                        <span>Rp {{ number_format($pmsn->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex flex-row flex-wrap justify-between">
                        <span class="font-medium text-lg print:text-lg">Total</span><span class="text-lg font-medium">Rp {{ number_format($pmsn->pembayaran->total, 0, ',', '.') }}</span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>