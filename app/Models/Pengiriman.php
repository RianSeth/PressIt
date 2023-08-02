<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengiriman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengiriman';

    protected $fillable = [
        'id',
        'pembayaran_id',
        'status',
        'tanggal_pengiriman',
        'waktu_pengiriman',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
