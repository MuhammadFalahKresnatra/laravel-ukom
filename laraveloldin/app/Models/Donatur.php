<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $fillable = [
        'idprogram',
        'nominal',
        'pembayaran',
        'dukungan',
        'nama',
        'asalkota',
        'telp',
        'email',
        'doa',
    ];
}
