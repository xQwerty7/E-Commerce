<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
@extends('welcome')
@section('konten')

    <body>
        <?php
        $rec = DB::table('tbstok')->where('id', $id)->first();
        $idsatuanrec=DB::table('tbsatuan')->get();
        $idkategorirec=DB::table('tbkategori')->get();
        ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Dosen</h3>
            </div>
            <form action="{{ url('stok/' . $id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode</label><br>
                        <input type="text" class="form-control" name="kode" value="{{ $rec->kode_stok }}">
                    </div>
                    <div class="form-group">
                        <label>Nama</label><br>
                        <input type="text" class="form-control" name="nama" value="{{ $rec->nama }}">
                    </div>
                    <div class="form-group">
                        <label>Saldo Awal</label><br>
                        <input type="text" class="form-control" name="saldoawal" value="{{ $rec->saldo_awal }}">
                    </div>
                    <div class="form-group">
                        <label>Harga Beli</label><br>
                        <input type="text" class="form-control" name="hargabeli" value="{{ $rec->harga_beli }}">
                    </div>
                    <div class="form-group">
                        <label>Harga Jual</label><br>
                        <input type="text" class="form-control" name="hargajual" value="{{ $rec->harga_jual }}">
                    </div>
                    <div class="form-group">
                        <label>Harga Modal</label><br>
                        <input type="text" class="form-control" name="hargamodal" value="{{ $rec->harga_modal }}">
                    </div>
                    @foreach (['foto_barang'] as $fileName)
                        <div class="form-group">
                            <label for="{{ $fileName }}Input">{{ ucfirst($fileName) }}</label>
                            <div class="input-group">
                                <input type="file" class="custom-file-input" name="fotobarang[]"
                                    id="{{ $fileName }}Input" accept="image/*" onchange="updateFileName(this)" multiple>
                                <label class="custom-file-label" for="{{ $fileName }}Input">Choose file</label>
                            </div>
                        </div><br>
                    @endforeach
                    <div class="form-group">
                        <label>Deskripsi Barang</label><br>
                        <input type="text" class="form-control" name="deskripsibarang" value="{{ $rec->deskripsi_barang }}">
                    </div>
                    <div class="form-group">
                        <label>Satuan</label><br>
                        <select id="satuan" class="form-control" name="satuan" value="{{ $rec->id_satuan }}">
                            @foreach ($idsatuanrec as $option)
                                <option value="{{ $option->id }}" {{ $rec->id_satuan == $option->id ? 'selected' : '' }}>
                                    {{ $option->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label><br>
                        <select id="kategori" class="form-control" name="kategori" value="{{ $rec->id_kategori }}">
                            @foreach ($idkategorirec as $option)
                                <option value="{{ $option->id }}" {{ $rec->id_kategori == $option->id ? 'selected' : '' }}>
                                    {{ $option->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
        </div>
    </body>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = input.nextElementSibling;
            label.innerText = fileName;
        }
    </script>
@stop

</html>
