<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir stok</title>
</head>
@extends('welcome')
@section('konten')

    <body>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir stok</h3>
            </div>

            <form action="{{ url('stok') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="alamat">Kode:</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Saldo Awal:</label>
                        <input type="text" class="form-control" id="saldoawal" name="saldoawal" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Harga Beli:</label>
                        <input type="text" class="form-control" id="hargabeli" name="hargabeli" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Harga Jual:</label>
                        <input type="text" class="form-control" id="hargajual" name="hargajual" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Harga Modal:</label>
                        <input type="text" class="form-control" id="hargamodal" name="hargamodal" required>
                    </div>

                    <label for="exampleInputFile">Foto Barang</label>
                    <div class="input-group">
                        <input type="file" class="custom-file-input" name="fotobarang[]" id="fotobarangInput"
                            accept="image/*" required onchange="updateFileName(this)" multiple>
                        <label class="custom-file-label">Choose file</label>
                    </div><br>

                    <div class="form-group">
                        <label for="alamat">Deskripsi Barang:</label>
                        <input type="text" class="form-control" id="deskripsibarang" name="deskripsibarang" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="alamat">Satuan:</label>
                        <input type="text" class="form-control" id="satuan" name="satuan">
                    </div> --}}
                    <div class="form-group">
                        <label for="nim">Satuan:</label>
                        <select id="satuan" class="form-control" name="satuan" required>
                            <?php
                            $item = DB::table('tbsatuan')->get();
                            $id_satuan = 0;
                            ?>
                            @foreach ($item as $key)
                                <?php
                                if ($id_satuan == $key->id) {
                                    echo "<option selected='selected' value='" . $key->id . "'>" . $key->nama . '</option>';
                                } else {
                                    echo "<option value='" . $key->id . "'>" . $key->nama . '</option>';
                                }
                                ?>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nim">Kategori:</label>
                        <select id="kategori" class="form-control" name="kategori" required>
                            <?php
                            $item = DB::table('tbkategori')->get();
                            $id_kategori = 0;
                            ?>
                            @foreach ($item as $key)
                                <?php
                                if ($id_kategori == $key->id) {
                                    echo "<option selected='selected' value='" . $key->id . "'>" . $key->nama . '</option>';
                                } else {
                                    echo "<option value='" . $key->id . "'>" . $key->nama . '</option>';
                                }
                                ?>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
@stop
<script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        var label = input.nextElementSibling;
        label.innerText = fileName;
    }
</script>

</html>
