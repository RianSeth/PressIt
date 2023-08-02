<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'batas';

    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai',
        'batas',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
