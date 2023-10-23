<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProgramDonasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'program',
        'namainstansi',
        'telp',
        'email',
        'image',
        'namaprogram',
        'maksimaldonasi',
        'rincian',
        'namayayasan',
        'tujuandonasi',
        'alamat',
        'status',
    ];

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/posts/' . $image),
        );
    }
}
