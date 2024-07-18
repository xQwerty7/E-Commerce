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
        $rec = DB::table('tbpemasok')
            ->where('id', $id)
            ->first();
        ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Dosen</h3>
            </div>
            <form action="{{ url('pemasok/' . $id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama: </label><br>
                        <input type="text" class="form-control" name="nama" value="{{ $rec->nama }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat: </label><br>
                        <input type="text" class="form-control" name="alamat" value="{{ $rec->alamat }}">
                    </div>
                    <div class="form-group">
                        <label>No HP: </label><br>
                        <input type="text" class="form-control" name="nohp" value="{{ $rec->nohp }}">
                    </div>
                </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
@stop

</html>
