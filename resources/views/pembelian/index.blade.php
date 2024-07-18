<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @extends('welcome')
    @section('konten')
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Pembelian</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('pembelian.reset') }}" class="btn btn-primary mb-3">Input Pembelian</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Bukti</th>
                    <th>Tanggal Beli</th>
                    <th>Pemasok</th>
                    <th>Keterangan</th>
                    <th>Nama Barang</th>
                    <th>QTY</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($value as $pembelian)
                    <tr>
                        <td>{{ $pembelian->nobukti }}</td>
                        <td>{{ $pembelian->tanggal_beli }}</td>
                        <td>@php
                            $pemasokInfo = DB::table('tbpemasok')
                                ->where('id', $pembelian->pemasok)
                                ->first();
                            echo $pemasokInfo ? $pemasokInfo->nama : '';
                        @endphp</td>
                        <td>{{ $pembelian->keterangan }}</td>
                        <td>@php
                            $idstokInfo = DB::table('tbstok')
                                ->where('id', $pembelian->idstok)
                                ->first();
                            echo $idstokInfo ?  $idstokInfo->nama : '';
                        @endphp</td>
                        <td>{{ $pembelian->quantity }}</td>
                        <td>Rp. {{ number_format($pembelian->harga, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($pembelian->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@stop
</html>
