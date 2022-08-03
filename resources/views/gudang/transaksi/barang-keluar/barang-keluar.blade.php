@extends('layout.layout')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Barang Keluar</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Barang Keluar</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Barang Keluar</h4>
                                    
                                <a class="btn btn-success btn-round ml-auto" href="/barang-keluar/add">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </a>

                                <button class="btn btn-primary btn-round ml-2" data-toggle="modal" data-target="#modalCetak">
                                    <i class="fa fa-print"></i>
                                    Cetak Data
                                </button>

                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Barang Keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCetak">Cetak Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/barang-keluar/cetak" method="get" enctype="multipart/form-data" target="_blank">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tgl_mulai" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tgl_selesai" required>
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection