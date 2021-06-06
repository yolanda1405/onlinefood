@foreach($databr as $br)
<div>
    @method('PUT')
    <input type="hidden" name='id' value="{{$br -> id}}" id="id_data">
    <label for="">Nama Barang</label>
    <input type="text" class="form-control" name="nama_barang" value="{{$br -> nama_barang}}" >
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
    <br>
    <img id='blah' src="{{ asset('barang/'. $br -> gambar)}}" class="img-thumbnail" width='200px' alt="" srcset="">
    <label for="">Upload Gambar</label>
    <!-- <input type="file" accept='image/*' class="form-control" name="gambar" onchange="readURL(this)"
        value="{{$br -> gambar }}"> -->
    <x-inputfile />
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#blah").attr("src", e.target.result).width(150).height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</div>
<div>
    <label for="">Keterangan</label>
    <input type="text" class="form-control" name="ket" value="{{$br -> ket}}" require>
    @error('ket')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@endforeach
<script>
    $('form[id="form-edit"]').attr("action","{{ $url_action }}")
</script>
