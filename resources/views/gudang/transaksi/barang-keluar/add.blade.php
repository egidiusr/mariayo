@extends('layout.layout')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tambah Barang Keluar</h4>
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
                        <a href="#">Tambah</a>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Barang Keluar</div>
                        </div>
                            <form action="/barang-keluar/store" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" value="{{ Auth::user()->id }}" name="id_user" required>

                                <div class="card-body">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nomor Barang Keluar</label>
                                            <input type="text" class="form-control" name="no_barang_keluar" id="no_barang_keluar" value="{{ 'NBK-'.$kd }}" readonly required>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Barang Keluar</label>
                                            <input type="date" class="form-control" name="tgl_barang_keluar" id="tgl_barang_keluar" required>
                                        </div>
                    
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select name="id_barang" id="id_barang" class="form-control" required>
                                                <option value="" hidden="">-- Pilih Barang --</option>
                    
                                                @foreach ($barang as $b)
                                                    <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                    
                                        <div id="detail_barang"></div>
                    
                                        <div class="form-group">
                                            <label>Jumlah Barang</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" placeholder="Jumlah Barang" name="jml_barang_keluar" id="jml_barang_keluar" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Unit</span>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <label>Total</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Total" name="total" id="total" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                                    <a href="/barang-keluar" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
                                </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#jml_barang_keluar, #harga").keyup(function() {
            var jml_barang_keluar  = $("#jml_barang_keluar").val();
            var harga              = $("#harga").val();

            var total = parseInt(harga) * parseInt(jml_barang_keluar);
            $("#total").val(total);
        });
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script type="text/javascript">
    $("#id_barang").change(function(){
        var id_barang = $("#id_barang").val();
        $.ajax({
            type: "GET",
            url : "/barang-keluar/ajax",
            data: "id_barang="+id_barang,
            cache: false,
            success: function(data){
                $("#detail_barang").html(data);
            }
        });
    });
</script>

@endsection