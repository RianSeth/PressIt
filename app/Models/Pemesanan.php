<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemesanan';

    protected $fillable = [
        'id',
        'nomor_pemesanan',
        'users_id',
        'paket_id',
        'address',
        'jumlah',
        'total_price',
        'tipe_pickup',
        'harga_kurir',
        'status',
        'batas_id',
        'total',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Menghitung total_price
            $model->total_price = $model->jumlah * $model->paket->harga;

            //Menghitung total akhir
            if ($model->tipe_pickup == 'kurir') {
                $model->total = $model->total_price + $model->harga_kurir;
            } else {
                $model->total = $model->total_price;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function pengerjaan()
    {
        return $this->hasOne(Pengerjaan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function batas()
    {
        return $this->belongsTo(Batas::class);
    }
}
