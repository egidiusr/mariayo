<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = BarangMasuk::join('barang', 'barang.id', '=', 'barang_masuk.id_barang')
            ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
            ->select('barang_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
            ->get();

        $barang = Barang::all();

        return view('gudang.transaksi.barang_masuk.barang_masuk', compact('barang', 'barang_masuk'));
    }

    public function create()
    {
        $barang = Barang::all();

        return view('gudang.transaksi.barang_masuk.add', compact('barang'));
    }
}
