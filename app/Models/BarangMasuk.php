<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';
    protected $fillable = [
        'no_barang_masuk',
        'id_barang',
        'id_user',
        'tgl_barang_masuk',
        'jml_barang_masuk',
        'total',
        'created_at',
        'updated_at',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
