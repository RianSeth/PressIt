@extends('layouts.app')

@section('body')
<div class="flex flex-col justify-center w-full mb-8">

    @if(session()->has('success'))
        <div x-data="{ showToast: true }" x-show="showToast" id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{ Session::get('success') }}</div>
            <button @click="showToast = false" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    @if (session()->has('alert'))
        <div x-data="{ showAlert: true }" x-show="showAlert" id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{ Session::get('alert') }}</div>
            <button @click="showAlert = false" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif

    <div class="shadow-md sm:rounded-lg">
        <table class="block overflow-x-auto scrollbar-hidden w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-md">
            <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                @if ($pemesanans->count() > 0)
                    Perhatian!
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                        Jangan lupa untuk terus periksa pemesanan Anda, Silahkan lakukan 'Chenga Booking' pada pemesanan yang sedang 'waiting'<br>
                        *Lakukan pembayaran, (tidak diproses ketika belum terdapat bukti bayar)<br>
                        *Pilih tipe antar/jemput pakaian anda (akan ada tambahan harga untuk jasa kurir) <br>
                    </p>
                @endif
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nomor Pemesanan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jenis Paket
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah/Satuan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SubTotal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jadwal|Pemesanan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bukti Pembayaran
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipe Pickup
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga Kirim/Jemput
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Akhir
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        -
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($pemesanans->count() > 0)
                    @foreach ($pemesanans as $pmsn)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
                            <th scope="row">
                                <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pmsn->nomor_pemesanan }}
                                </div>
                            </th>
                            <td>
                                <div class="px-6 py-4">
                                {{ $pmsn->paket->jenis }}
                                </div>
                            </td>
                            <td>
                                <div class="px-6 py-4">
                                {{ $pmsn->jumlah }} / {{ $pmsn->paket->satuan_harga }}
                                </div>
                            </td>
                            <td>
                                <div class="px-6 py-4">
                                {{ $pmsn->total_price }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $strtDate = strftime('%d %B %Y', strtotime($pmsn->batas->tanggal_mulai));
                                    $enDate = strftime('%d %B %Y', strtotime($pmsn->batas->tanggal_selesai));
                                @endphp
                                <div class="px-6 py-4">
                                {{ $strtDate }} <br>
                                - {{ $enDate }}
                                </div>
                            </td>
                            <td x-data="{ showPreview: false }">
                                <button x-on:click="showPreview = !showPreview" class="block px-6 py-4">
                                    @if ($pmsn->pembayaran !== null && $pmsn->pembayaran->count() > 0)
                                    @if ($pmsn->pembayaran->bukti_pembayaran !== null)
                                    <img src="{{ asset('storage/' . $pmsn->pembayaran->bukti_pembayaran) }}" alt="Preview Gambar" class="w-10 h-10 object-cover rounded">
                                    @endif
                                    @endif
                                </button>
                                @if ($pmsn->pembayaran !== null && $pmsn->pembayaran->count() > 0)
                                @if ($pmsn->pembayaran->bukti_pembayaran !== null)
                                <div x-show="showPreview" class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showPreview" x-on:click.away="showPreview = !showPreview">
                                    <div x-on:click="showPreview = !showPreview" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center">
                                        <img src="{{ asset('storage/'.$pmsn->pembayaran->bukti_pembayaran) }}" alt="Preview Gambar" class="w-2/4 h-2/4 object-contain rounded">
                                    </div>
                                </div>
                                @endif
                                @endif
                            </td>
                            <td>
                                <div class="px-6 py-4">
                                    @if ($pmsn->pembayaran !== null && $pmsn->pembayaran->count() > 0)
                                    {{ $pmsn->tipe_pickup }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="px-6 py-4">
                                    @if ($pmsn->pembayaran !== null && $pmsn->pembayaran->count() > 0)
                                    @if ($pmsn->tipe_pickup == 'kurir')
                                    {{ $pmsn->harga_kurir }}
                                    @else
                                    -
                                    @endif
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="px-6 py-4">
                                    {{ $pmsn->total }}
                                </div>
                            </td>
                            <td>
                                <div class="px-6 py-4">
                                {{ $pmsn->status }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if ($pmsn->status === 'waiting' || ($pmsn->status === 'pending' || $pmsn->status === 'pickup'))
                                    <a href="{{ route('bookedit', $pmsn->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Change Booking</a>
                                @endif
                            </td>
                            <td x-data="{ showPayment: false }" class="px-6 py-4 text-right">
                                @if ($pmsn->status == 'waiting' )
                                    @if ($pmsn->tipe_pickup == 'kurir' && $pmsn->harga_kurir > 0)
                                        <a href="{{ route('bookpay', $pmsn->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Payment</a>
                                    @else
                                        @if ($pmsn->tipe_pickup == 'mandiri')
                                        <a href="{{ route('bookpay', $pmsn->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            Payment</a>
                                        @endif
                                    @endif
                                @else
                                    @if ($pmsn->status !== 'cancelled' && isset($pmsn->pembayaran->bukti_pembayaran))
                                        <button x-on:click="showPayment = !showPayment" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            Faktur</button>
                                        @include('pages.booking.show')
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if ($pmsn->status === 'waiting' || $pmsn->status === 'pending')
                                    <form onsubmit="return confirm('Apakah Anda Yakin Membatalkan Pemesanan?');" action="{{ route('bookcancel', $pmsn->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        {{-- <input type="hidden" name="status" value="cancelled"> --}}
                                        <button type="submit" class="font-medium text-orange dark:text-orange hover:underline">Cancel</button>
                                    </form>
                                @endif
                            </td>
                            <td x-data="{ showPreview2: false }" >
                                @php
                                    $pengembalian = $pmsn->pembayaran->pengembalian ?? null;
                                @endphp
                                @if (isset($pengembalian))
                                    <button x-on:click="showPreview2 = !showPreview2" class="block px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        @if ($pmsn->status === 'cancelled' && $pmsn->pembayaran->bukti_pembayaran != null)
                                        Refund
                                        @endif
                                    </button>
                                    @if ($pmsn->status === 'cancelled' && $pmsn->pembayaran->bukti_pembayaran != null)
                                    <div x-show="showPreview2" class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center" x-show="showPreview2" x-on:click.away="showPreview2 = !showPreview2">
                                        <div x-on:click="showPreview2 = !showPreview2" class="fixed left-0 top-0 w-full h-screen bg-black/50 flex justify-center items-center">
                                            <img src="{{ asset('storage/' . $pengembalian->bukti_pengembalian) }}" alt="Preview Gambar" class="w-2/4 h-2/4 object-contain rounded">
                                        </div>
                                    </div>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="https://wa.me/6285349111065?text=Hallo%20admin!%20Pemesanan%20Saya%0A%0ANo.%20{{$pmsn->nomor_pemesanan}}%0ALayanan%20{{$pmsn->paket->jenis}}%0ASubtotal%20Rp.{{$pmsn->total_price}}%0ATanggal%20pemesanan:%20{{$strtDate}}%20hingga%20{{$enDate}}%0APengantaran%20{{$pmsn->tipe_pickup}}%0ATotal%20harga%20Rp.{{$pmsn->total}}%0A%0A%5Btanyakan%20disini%5D" target="_blank" class="font-medium text-green-500 dark:text-green-500 hover:underline">Chat WhatsApp</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Tidak ada pemesanan
                        </th>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr class="font-semibold text-white dark:text-white bg-gray-600">
                    <th scope="row" class="px-6 py-3 text-sm">Total Order</th>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3">{{ $pemesanans->count() }}</td>
                </tr>
            </tfoot>
        </table>
        {{ $pemesanans->onEachSide(1)->links('pagination::tailwind') }}
    </div>

</div>
@endsection