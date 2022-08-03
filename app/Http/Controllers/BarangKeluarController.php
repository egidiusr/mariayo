<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluar = BarangKeluar::join('barang', 'barang.id', '=', 'barang_keluar.id_barang')
            ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
            ->select('barang_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
            ->get();

        $barang = Barang::all();

        return view('gudang.transaksi.barang-keluar.barang-keluar', compact('barang', 'barang_keluar'));
    }

    public function add()
    {
        $barang = Barang::all();

        $q = DB::table('barang_keluar')->select(DB::raw('MAX(RIGHT(no_barang_keluar,4)) as kode'));

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

        return view('gudang.transaksi.barang-keluar.add', compact('barang', 'kd'));
    }

    public function ajax(Request $request)
    {
        $id_barang['id_barang'] = $request->id_barang;
        $ajax_barang            = Barang::where('id', $id_barang)->get();

        return view('gudang.transaksi.barang-keluar.ajax', compact('ajax_barang'));
    }

    public function store(Request $request)
    {
        $barang = Barang::find($request->id_barang);

        if ($barang->stok < $request->jml_barang_keluar) {
            return redirect('/barang-keluar/add')->with('error', 'Jumlah barang melebihi stok');
        } else {
            BarangKeluar::create([
                'no_barang_keluar'  => $request->no_barang_keluar,
                'id_barang'         => $request->id_barang,
                'id_user'           => $request->id_user,
                'tgl_barang_keluar' => $request->tgl_barang_keluar,
                'jml_barang_keluar' => $request->jml_barang_keluar,
                'total'             => $request->total,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            $barang->stok    -= $request->jml_barang_keluar;
            $barang->save();

            return redirect('/barang-keluar')->with('success', 'Berhasil menambah data');
        }
    }

    public function cetak_barang_keluar(Request $request)
    {
        $tgl_mulai   = $request->tgl_mulai;
        $tgl_selesai  = $request->tgl_selesai;

        if ($tgl_mulai and $tgl_selesai) {
            $barang_keluar = BarangKeluar::join('barang', 'barang.id', '=', 'barang_keluar.id_barang')
                ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                ->select('barang_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                ->whereBetween('barang_keluar.tgl_barang_keluar', [$tgl_mulai, $tgl_selesai])
                ->get();

            $sum_total = BarangKeluar::whereBetween('tgl_barang_keluar', [$tgl_mulai, $tgl_selesai])->sum('total');
        } else {
            $barang_keluar = BarangKeluar::join('barang', 'barang.id', '=', 'barang_keluar.id_barang')
                ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                ->select('barang_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                ->get();
        }

        return view('gudang.transaksi.barang-keluar.cetak', compact('barang_keluar', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }
}
