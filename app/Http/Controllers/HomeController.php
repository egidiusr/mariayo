<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class HomeController extends Controller
{
    public function home()
    {
        // Data barang
        $barang = Barang::count();

        // Data kategori
        $kategori = Kategori::count();

        // Data user
        $user = User::count();

        // format tanggal untuk filter
        $date = date('Y-m-d');

        // Data barang masuk hari ini
        $barang_masuk = BarangMasuk::where('tgl_barang_masuk', '=', $date)->count();

        // Data barang keluar hari ini
        $barang_keluar = BarangKeluar::where('tgl_barang_keluar', '=', $date)->count();;

        return view(
            '/home',
            compact(
                'user',
                'kategori',
                'barang',
                'barang_masuk',
                'barang_keluar'
            )
        );
    }
}
