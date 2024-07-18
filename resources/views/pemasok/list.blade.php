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
                            <h2>Tabel Pemasok</h2>
                            <a href="{{ '/pemasok/create' }}"><button class="btn btn-primary">Tambah
                                    Pemasok</button></a><br>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                @php
                                    $rec = DB::table('tbpemasok')->paginate(8);
                                    $no = 0;
                                @endphp
                                @foreach ($rec as $key => $value)
                                    @php
                                        $no++;
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->alamat }}</td>
                                            <td>{{ $value->nohp }}</td>
                                            <td><a href="{{ url('pemasok/' . $value->id) }}" class="btn btn-secondary"><i
                                                        class='bx bxs-edit bx-sm bx-tada-hover'></i></a></td>
                                            <td>
                                                <form action="{{ url('pemasok/' . $value->id) }}" method="POST"
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
                                            <a class="page-link" href="{{ $rec->previousPageUrl() }}" aria-label="Previous">
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
