<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengerjaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengerjaan';

    protected $fillable = [
        'users_id',
        'pemesanan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
