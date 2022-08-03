<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Barang</title>

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
                        LAPORAN DATA BARANG
                    </p>
                <hr/>

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>

                    @php $no=1; @endphp
                    @foreach ($barang as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nama_barang }}</td>
                            <td>{{ $row->harga }}</td>
                            <td>{{ $row->stok }}</td>
                        </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>