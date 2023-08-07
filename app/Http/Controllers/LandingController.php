<?php

namespace App\Http\Controllers;

use App\Models\Batas;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Pengerjaan;
use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPackageTools\Package;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakets = Paket::all();
        return view('pages.landing', compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $pakets = Paket::findOrFail($id);
        $users = Auth::user();

        // Generate the next order number
        $lastOrder = Pemesanan::orderByDesc('id')->first();
        $increment = $lastOrder ? intval(substr($lastOrder->nomor_pemesanan, -3)) + 1 : 1;
        $orderNumber = 'ORD-' . str_pad($increment, 3, '0', STR_PAD_LEFT);

        // Mengambil semua data batas dari tabel batas
        $allBookings = Batas::where('batas', 40)->get();

        // Array untuk menyimpan rentang tanggal dari pemesanan
        $bookingRanges = [];

        foreach ($allBookings as $booking) {
            $bookingRanges[] = [
                'from' => $booking->tanggal_mulai,
                'to' => $booking->tanggal_selesai,
            ];
        }

        $bookingReady = Batas::whereRaw('batas < 40')
                            ->orderBy('tanggal_mulai', 'desc')
                            ->get();
        $bookingReadyRanges = [];

        foreach ($bookingReady as $bookingRead) {
            $bookingReadyRanges[] = [
                'from' => $bookingRead->tanggal_mulai,
                'to' => $bookingRead->tanggal_selesai,
                'batas' => $bookingRead->batas,
            ];
        }

        $tomorrow = Carbon::tomorrow();

        return view('pages.book', compact('pakets', 'users', 'orderNumber', 'allBookings', 'bookingRanges', 'tomorrow', 'bookingReady', 'bookingReadyRanges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nomor_pemesanan' => 'required',
            'users_id' => 'required',
            'paket_id' => 'required',
            'jumlah' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'batas' => 'required',
            'total_harga' => 'required',
            'address' => 'required',
            'tipe_pengambilan',
        ]);

        $batas = Batas::where('tanggal_mulai', $request->tanggal_mulai)->first();

        if ($batas) {
            if ($batas->tanggal_mulai == $request->tanggal_mulai) {
                $jumlahBatas = $batas->batas + $request->jumlah;
                $batas->update([
                    'batas' => $jumlahBatas,
                ]);
            }
        } else {
            $batas = Batas::create([
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'batas' => $request->jumlah,
            ]);
        }

        $pemesanans = Pemesanan::create([
            'nomor_pemesanan' => $request->nomor_pemesanan,
            'users_id' => $request->users_id,
            'paket_id' => $request->paket_id,
            'address' => $request->address,
            'jumlah' => $request->jumlah,
            'total_price' => $request->total_harga,
            'tipe_pickup' => $request->tipe_pengambilan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'batas_id' => $batas->id,
        ]);

        $pembayarans = Pembayaran::create([
            'pemesanan_id' => $pemesanans->id,
        ]);

        Pengiriman::create([
            'pembayaran_id' => $pembayarans->id,
        ]);

        return redirect()->route('booking')->with(['success', 'Pemesanan Anda telah berhasil, silahkan selalu cek status pemesanan pada tombol kanan atas']);
    }

    public function list()
    {
        $users = Auth::user();

        $statusOrder = ['pickup', 'process', 'waiting', 'pending', 'finished', 'cancelled'];
        $pemesanans = Pemesanan::where('users_id', $users->id)
                                ->whereIn('status', $statusOrder)
                                ->orderByRaw("FIELD(status, '" . implode("','", $statusOrder) . "')")
                                ->orderBy('created_at', 'desc')
                                ->Paginate(6);
        // $pembayarans = Pembayaran::where('pemesanan_id', $pemesanans->id);
        // $pengirimans = Pengiriman::where('pembayaran_id', $pembayarans->id);
        return view('pages.booking.list', compact('users', 'pemesanans'));
    }

    public function cancel(string $id)
    {
        $pemesanans = Pemesanan::findOrFail($id);
        $batasPemesan = Batas::where('id', $pemesanans->batas_id)->first();


        // Perform the cancellation logic (change status to 'cancelled')
        $pemesanans->update([
            'status' => 'cancelled',
        ]);

        $kurangBatas = $batasPemesan->batas - $pemesanans->jumlah;

        $batasPemesan->update([
            'batas' => $kurangBatas,
        ]);

        // dd($pemesanans);

        return redirect()->route('booking')->with('success', 'Pemesanan telah berhasil dibatalkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = Auth::user();
        $pemesanans = Pemesanan::findOrFail($id);

        // Mengambil semua data batas dari tabel batas
        $allBookings = Batas::where('batas', 40)
                            ->whereNotIn('id', [$pemesanans->batas_id])
                            ->get();

        // Array untuk menyimpan rentang tanggal dari pemesanan
        $bookingRanges = [];

        foreach ($allBookings as $booking) {
            $bookingRanges[] = [
                'from' => $booking->tanggal_mulai,
                'to' => $booking->tanggal_selesai,
            ];
        }

        $bookingReady = Batas::where(function ($query) use ($pemesanans) {
            $query->where('batas', '<', 40)
                  ->orWhere('id', $pemesanans->batas_id);
            })
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
        $bookingReadyRanges = [];

        foreach ($bookingReady as $bookingRead) {
            $bookingReadyRanges[] = [
                'from' => $bookingRead->tanggal_mulai,
                'to' => $bookingRead->tanggal_selesai,
                'id' => $bookingRead->id,
                'batas' => $bookingRead->batas,
            ];
        }

        $batasOld = Batas::find($pemesanans->batas_id);
        $batasOld = $batasOld->batas - $pemesanans->jumlah;

        $tomorrow = Carbon::tomorrow();

        return view('pages.booking.edit', compact('pemesanans', 'users', 'allBookings', 'bookingRanges', 'tomorrow', 'bookingReady', 'bookingReadyRanges', 'batasOld'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'address' => 'required',
            'jumlah' => 'required',
            'total_price' => 'required',
            'tipe_pengambilan',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'batas' => 'required',
        ]);

        $pemesanans = Pemesanan::findOrFail($id);
        $batasPemesan = Batas::where('id', $pemesanans->batas_id)->first();
        $batas = Batas::where('tanggal_mulai', $request->tanggal_mulai)->first();

        if ($batas) {
            if ($pemesanans->batas_id == $batas->id && $batas->tanggal_mulai == $request->tanggal_mulai) {
                $jumlahBatas = ($batas->batas - $pemesanans->jumlah) + $request->jumlah;
                $batas->update([
                    'batas' => $jumlahBatas,
                ]);
            } else if ($pemesanans->batas_id != $batas->id && $batas->tanggal_mulai == $request->tanggal_mulai) {
                //batas pada data yang dulu dikurangi dengan jumlah data yang lama pada pemesanan
                $kurangBatas = $batasPemesan->batas - $pemesanans->jumlah;
                //jumlah batas yang baru
                $jumlahBatas = $batas->batas + $request->jumlah;
                $batas->update([
                    'batas' => $jumlahBatas,
                ]);
                $batasPemesan->update([
                    'batas' => $kurangBatas,
                ]);
            }
        } else {
            $kurangBatas = $batasPemesan->batas - $pemesanans->jumlah;
            $batasPemesan->update([
                'batas' => $kurangBatas,
            ]);

            $batas = Batas::create([
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'batas' => $request->jumlah,
            ]);
        } 
        
        $pemesanans->update ([
            'address' => $request->address,
            'jumlah' => $request->jumlah,
            'total_price' => $request->total_price,
            'tipe_pickup' => $request->tipe_pengambilan,
            'batas_id' => $batas->id,
        ]);

        return redirect()->route('booking')->with('success', 'Pemesanan berhasil diperbarui')
                                            ->with('alert', 'Segerakan pembayaran!');

    }

    public function editPay(string $id)
    {
        $pemesanans = Pemesanan::findOrFail($id);

        return view('pages.booking.bayar', compact('pemesanans'));
    }

    public function updatePay(Request $request, string $id)
    {
        $this->validate($request, [
            'address' => 'required',
            'tipe_pickup' => 'required',
            'total' => 'required',
            'bukti_pembayaran',
        ]);

        $pemesanans = Pemesanan::findOrFail($id);
        $pembayarans = Pembayaran::where('pemesanan_id', $pemesanans->id);

        if ($request->hasFile('bukti_pembayaran')) {

            $bukti = $request->file('bukti_pembayaran');
            $bukti->storeAs('public/', $bukti->hashName());
            
            if (isset($pembayarans->bukti_pembayaran)) {
                Storage::delete('public/'.$pembayarans->bukti_pembayaran);
            }

            $pemesanans->update([
                'address' => $request->address,
                'tipe_pickup' => $request->tipe_pickup,
            ]);

            $pembayarans->update([
                'bukti_pembayaran' => $bukti->hashName(),
                'total' => $request->total,
            ]);

        } else {
            $pemesanans->update([
                'address' => $request->address,
                'tipe_pickup' => $request->tipe_pickup,
            ]);

            $pembayarans->update([
                'total' => $request->total,
            ]);
        }

        return redirect()->route('booking')->with('success', 'Anda telah membayar, tunggu Admin memeriksa pembayaran');

    }

    public function download(Pemesanan $record)
    {
        $pemesanans = Pemesanan::findOrFail($record->id);
        
        $pembayarans = Pembayaran::where('pemesanan_id', $pemesanans->id)->get();

        return view('pages.booking.receipt', compact('pemesanans', 'pembayarans'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
