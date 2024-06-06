<?php

namespace App\Http\Livewire;

use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PemesanansList extends Component
{
    use WithPagination;

    protected $listeners = ['orderUpdated' => '$refresh'];

    public function render()
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

        return view('livewire.pemesanans-list', compact('users', 'pemesanans'));
    }
}
