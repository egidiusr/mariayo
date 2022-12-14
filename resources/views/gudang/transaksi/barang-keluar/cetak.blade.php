<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Barang Keluar</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body style="background-color:white;" onload="window.print()">
    <style>
        .line-tittle {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <td align="center">
                                <span style="line-height: 1.6; font-weight: bold;">
                                    SISTEM INVENTORY
                                    <br>
                                    MARIAYO
                                </span>
                            </td>
                        </tr>
                    </table>

                    <hr class="line-title">
                    <p align="center">
                        LAPORAN DATA BARANG KELUAR
                    </p>
                    <p align="center">
                        Periode tanggal {{ date('d-F-Y', strtotime($tgl_mulai)) }} hingga {{ date('d-F-Y', strtotime($tgl_selesai)) }}
                    </p>
                <hr/>

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>No Barang Keluar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Tanggal Keluar</th>
                        <th>Harga</th>
                        <th>Jumlah Barang</th>
                        <th>Total</th>
                    </tr>

                    @if ($sum_total == 0)

                        <tr>
                            <td colspan="8">
                                <center>
                                    <b>
                                        Data tidak tersedia pada periode tanggal {{ date('d-F-Y', strtotime($tgl_mulai)) }} hingga {{ date('d-F-Y', strtotime($tgl_selesai)) }}
                                    </b>
                                </center>
                            </td>
                        </tr>
                            
                        @else
                            @php $no=1; @endphp
                            @foreach ($barang_keluar as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->no_barang_keluar }}</td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td>{{ $row->nama_kategori }}</td>
                                    <td>{{ date('d F Y', strtotime($row->tgl_barang_keluar)) }}</td>
                                    <td>Rp. {{ number_format($row->harga) }}</td>
                                    <td>{{ $row->jml_barang_keluar }} Unit</td>
                                    <td>Rp. {{ number_format($row->total) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="7">Total Harga</td>
                                <td>Rp. {{ number_format($sum_total) }}</td>
                            </tr>

                        @endif
                </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>