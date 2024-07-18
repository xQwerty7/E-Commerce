<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemasok</title>
</head>
@extends('welcome')
@section('konten')

    <body>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir Pemasok</h3>
            </div>

            <form action="{{ url('pemasok') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="alamat">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">No HP:</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" required>
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
