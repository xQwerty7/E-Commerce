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
                            <h2>Tabel stok</h2>
                            <a href="{{ '/' }}"><button class="btn btn-primary float-right">Kembali Ke Halaman
                                    Utama</button></a>
                            <a href="{{ '/stok/create' }}"><button class="btn btn-primary">Tambah
                                    stok</button></a><br>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Saldo Awal</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Modal</th>
                                        <th>Foto Barang</th>
                                        <th>Deskripsi Barang</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                        <th colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                @php
                                    $rec = DB::table('tbstok')->paginate(8);
                                    $no = 0;

                                @endphp
                                @foreach ($rec as $key => $value)
                                    @php
                                        // Uraikan JSON menjadi array untuk setiap item
                                        $images = json_decode($value->foto_barang, true);
                                        // Ambil gambar pertama
                                        $firstImage = $images[0] ?? null;
                                        $no++;
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">{{ $no }}</td>
                                            <td class="align-middle">{{ $value->kode_stok }}</td>
                                            <td class="align-middle">{{ $value->nama }}</td>
                                            <td class="align-middle">{{ $value->saldo_awal }}</td>
                                            <td class="align-middle">{{ $value->harga_beli }}</td>
                                            <td class="align-middle">{{ $value->harga_jual }}</td>
                                            <td class="align-middle">{{ $value->harga_modal }}</td>
                                            @foreach (['foto_barang'] as $fileName)
                                                <td class="align-middle">
                                                    <img src="{{ asset('fotobarang/' . $firstImage) }}"
                                                        alt="{{ $fileName }}"
                                                        style="max-width: 100px; max-height: 100px;" data-toggle="modal"
                                                        data-target="#{{ $fileName . $value->id }}">

                                                    <div class="modal fade" id="{{ $fileName . $value->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        {{ ucfirst($fileName) }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="modal-body">
                                                                        <div class="mt-2 text-center">
                                                                            <img src="{{ asset('fotobarang/' . $value->$fileName) }}"
                                                                                alt="{{ $fileName }}"
                                                                                class="img-fluid">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endforeach
                                            <td class="align-middle">{{ $value->deskripsi_barang }}</td>
                                            <td class="align-middle">
                                            @php
                                                $idsatuanInfo = DB::table('tbsatuan')
                                                    ->where('id', $value->id_satuan)
                                                    ->first();
                                                echo $idsatuanInfo ? $idsatuanInfo->nama : '';
                                            @endphp</td>
                                            <td class="align-middle">
                                            @php
                                                $idkategoriInfo = DB::table('tbkategori')
                                                    ->where('id', $value->id_kategori)
                                                    ->first();
                                                echo $idkategoriInfo ? $idkategoriInfo->nama : '';
                                            @endphp</td>
                                            {{-- <td class="align-middle">{{ $value->id_kategori }}</td> --}}
                                            <td class="align-middle"><a href="{{ url('stok/' . $value->id) }}"
                                                    class="btn btn-secondary"><i
                                                        class='bx bxs-edit bx-sm bx-tada-hover'></i></a></td>
                                            <td class="align-middle">
                                                <form action="{{ url('stok/' . $value->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary">
                                                        <i class='bx bxs-trash bx-sm bx-spin'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between mb-3 align-items-center">
                                <a href="{{ '/' }}" class="btn btn-success mt-3">Kembali</a>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination mb-0 mt-2">
                                        <li class="page-item {{ $rec->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $rec->previousPageUrl() }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo; Previous</span>
                                            </a>
                                        </li>

                                        @for ($i = 1; $i <= $rec->lastPage(); $i++)
                                            <li class="page-item {{ $rec->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $rec->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        <li class="page-item {{ $rec->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $rec->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">Next &raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </body>
@stop

</html>
