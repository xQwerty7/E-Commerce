<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        td {
            text-align: center;
        }

        tr {
            text-align: center;
        }
    </style>
    <title>list</title>
</head>
@extends('welcome')
@section('konten')

    <body>
        {{ $pesan ?? '' }} <br>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Detail Penjualan</h2>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Quantity</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach($items as $item)
                                    @php
                                        $no++;
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->nama}}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($item->harga*$item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>                                                      
                            <div class="d-flex justify-content-between mb-3 align-items-center">
                                <a href="{{ '/penjualan' }}" class="btn btn-success mt-3">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </body>
@stop

</html>
