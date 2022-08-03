@foreach ($ajax_barang as $b)

    <div class="form-group">
        <label>Harga</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Rp</span>
            </div>
                <input type="text" class="form-control" id="harga" name="harga" value="{{ $b->harga }}" readonly required>
        </div>
    </div>

@endforeach