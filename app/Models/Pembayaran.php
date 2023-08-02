<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pembayaran';

    protected $fillable = [
        'id',
        'pemesanan_id',
        'bukti_pembayaran',
        'tipe_pengambilan',
        'total',
        'tanggal_pembayaran',
        'waktu_pembayaran',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class);
    }
}
