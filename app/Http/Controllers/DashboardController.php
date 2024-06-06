<?php

namespace App\Http\Controllers;

use App\Models\Batas;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Pengembalian;
use App\Models\Pengiriman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function banned(User $record)
    {
        $user = User::findOrFail($record->id);

        $user->update([
            'status' => 'banned',
        ]);

        // dd($pemesanans);

        return redirect()->route('/admin/users/customers');
    }

    public function createcust()
    {
        $users = User::where('usertype', 'customer')->get();

        return view('pages.dashboard.createcust', compact('users'));
    }

    public function createpack(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
        ]);

        $pakets = Paket::all();
        $users = User::findOrFail($request->user_id);

        return view('pages.dashboard.createpack', compact('users', 'pakets'));
    }

    public function create(Request $request, string $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
        ]);

        $pakets = Paket::findOrFail($id);
        $users = User::findOrFail($request->user_id);

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

        return view('pages.dashboard.create', compact('pakets', 'users', 'orderNumber', 'allBookings', 'bookingRanges', 'tomorrow', 'bookingReady', 'bookingReadyRanges'));
    }
    
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
            'total' => $request->total_harga,
        ]);

        $pembayarans = Pembayaran::create([
            'pemesanan_id' => $pemesanans->id,
        ]);

        Pengiriman::create([
            'pembayaran_id' => $pembayarans->id,
        ]);

        return redirect()->route('close-tab');
    }

    public function cancel(Pemesanan $record)
    {
        $pemesanans = Pemesanan::findOrFail($record->id);
        $batasPemesan = Batas::where('id', $pemesanans->batas_id)->first();

        if ($pemesanans->status != 'waiting') {
            return back();
        }

        // Perform the cancellation logic (change status to 'cancelled')
        $pemesanans->update([
            'status' => 'cancelled',
        ]);

        $kurangBatas = $batasPemesan->batas - $pemesanans->jumlah;

        $batasPemesan->update([
            'batas' => $kurangBatas,
        ]);

        // dd($pemesanans);

        return redirect()->route('close-tab');
    }

    public function edit(Pemesanan $record)
    {
        $pemesanans = Pemesanan::findOrFail($record->id);
        $users = User::findOrFail($pemesanans->users_id);

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

        return view('pages.dashboard.edit', compact('pemesanans', 'users', 'allBookings', 'bookingRanges', 'tomorrow', 'bookingReady', 'bookingReadyRanges', 'batasOld'));
    }

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

        if ($pemesanans->status != 'waiting') {
            return back();
        }

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

        return redirect()->route('close-tab');

    }

    public function refund(Pemesanan $record)
    {
        $pemesanans = Pemesanan::findOrFail($record->id);
        $pembayarans = Pembayaran::where('pemesanan_id', $pemesanans->id)->firstOrFail();

        return view('pages.dashboard.refund', compact('pemesanans', 'pembayarans'));
    }

    public function refundPay(Request $request, string $id)
    {
        $this->validate($request, [
            'bukti_pengembalian' => 'required',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        if (!$pembayaran->pengembalian()->exists()) {
            $pengembalian = Pengembalian::create([
                'pembayaran_id' => $pembayaran->id,
                'bukti_pengembalian' => $request->bukti_pengembalian,
            ]);
        } else {
            $pengembalian = Pengembalian::where('pembayaran_id', $pembayaran->id);
        }

        if ($request->hasFile('bukti_pengembalian')) {

            $bukti = $request->file('bukti_pengembalian');
            $bukti->storeAs('public/', $bukti->hashName());
            
            if (isset($pengembalian->bukti_pengembalian)) {
                Storage::delete('public/'.$pengembalian->bukti_pengembalian);
            }

            $pengembalian->update([
                'bukti_pengembalian' => $bukti->hashName(),
            ]);

        } else {
            return back();
        }

        return redirect()->route('close-tab');
    }

}
