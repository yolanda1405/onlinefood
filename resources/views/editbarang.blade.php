foreach($barang as $br)
<form action="/barang/editpost/" enctype="multipart/form-data" method="post">
    @csrf
    <div>
        <label for="">Nama Barang</label>
        <input type="text" class="form-control" name="nama_barang" value="{{$br -> nama_barang}}">
        @error('nama_barang')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="">Harga Barang</label>
        <input type="number" class="form-control" name="harga" value="{{$br -> harga}}" require>
        @error('harga')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="">Stock Barang</label>
        <input type="number" class="form-control" name="stok" value="{{$br -> stok}}">
        @error('stok')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div>
        <label for="">Bonus</label>
        <select name="ket" id="" class="form-control">
            <option value="Tidak Ada."> Pilih Bonus </option>
            <option value="Gratis 2 Minuman"> Gratis 2 Minuman" </option>
            <option value="Beli 3 Gratis 1"> Beli 3 Gratis 1 </option>
            <option value="Beli 1 Gratis 1"> Beli 3 Gratis 1 </option>
        </select>
    </div>
    <div>
        <label for="">Upload Gambar</label>
        <input type="file" class="form-control" name="gambar" value="{{$br -> gambar }}">
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-sm btn-success" style="width: 200px;"> Simpan </button>
        <button type="reset" class="btn btn-sm btn-danger"> Reset </button>
    </div>
</form>
endforeach