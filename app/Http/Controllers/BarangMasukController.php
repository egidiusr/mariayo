<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = BarangMasuk::join('barang', 'barang.id', '=', 'barang_masuk.id_barang')
            ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
            ->select('barang_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
            ->get();

        $barang = Barang::all();

        return view('gudang.transaksi.barang-masuk.barang-masuk', compact('barang', 'barang_masuk'));
    }

    public function add()
    {
        $barang = Barang::all();

        $q = DB::table('barang_masuk')->select(DB::raw('MAX(RIGHT(no_barang_masuk,4)) as kode'));

        $kd = "";
        if ($q->count()  > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd  = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        // return "NBM-".$kd;

        return view('gudang.transaksi.barang-masuk.add', compact('barang', 'kd'));
    }

    public function ajax(Request $request)
    {
        $id_barang['id_barang'] = $request->id_barang;
        $ajax_barang            = Barang::where('id', $id_barang)->get();

        return view('gudang.transaksi.barang-masuk.ajax', compact('ajax_barang'));
    }

    public function store(Request $request)
    {
        BarangMasuk::create([
            'no_barang_masuk'   => $request->no_barang_masuk,
            'id_barang'         => $request->id_barang,
            'id_user'           => $request->id_user,
            'tgl_barang_masuk'  => $request->tgl_barang_masuk,
            'jml_barang_masuk'  => $request->jml_barang_masuk,
            'total'             => $request->total,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        $barang = Barang::find($request->id_barang);

        $barang->stok    += $request->jml_barang_masuk;
        $barang->save();

        return redirect('/barang-masuk')->with('success', 'Berhasil menambah data');
    }

    public function cetak_barang_masuk(Request $request)
    {
        $tgl_mulai   = $request->tgl_mulai;
        $tgl_selesai  = $request->tgl_selesai;

        if ($tgl_mulai and $tgl_selesai) {
            $barang_masuk = BarangMasuk::join('barang', 'barang.id', '=', 'barang_masuk.id_barang')
                ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                ->select('barang_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                ->whereBetween('barang_masuk.tgl_barang_masuk', [$tgl_mulai, $tgl_selesai])
                ->get();

            $sum_total = BarangMasuk::whereBetween('tgl_barang_masuk', [$tgl_mulai, $tgl_selesai])->sum('total');
        } else {
            $barang_masuk = BarangMasuk::join('barang', 'barang.id', '=', 'barang_masuk.id_barang')
                ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                ->select('barang_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                ->get();
        }

        return view('gudang.transaksi.barang-masuk.cetak', compact('barang_masuk', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }
}
