<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'paket';

    protected $fillable = [
        'jenis',
        'deskripsi',
        'harga',
        'jumlah',
        'satuan_harga',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
