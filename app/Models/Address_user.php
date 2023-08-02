<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address_user extends Model
{
    use HasFactory;

    protected $table = 'address_user';

    protected $fillable = [
        'telp',
        'address',
        'users_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
