<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\User;

class LaporanController extends Controller
{
    public function lap_user()
    {
        $user = User::all();

        return view('admin.laporan.user.lap_user', compact('user'));
    }

    public function cetak_user()
    {
        $user = User::all();

        return view('admin.laporan.user.cetak', compact('user'));
    }
}
