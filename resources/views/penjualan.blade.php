<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Penjualan</title>
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
                        <h2>Tabel Penjualan</h2>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nobukti</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Tanggal</th>
                                    <th>Status Pembayaran</th>
                                    <th>Bukti Pembayaran</th>
                                    <th colspan="3" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 0; @endphp
                                @foreach ($rec as $key => $value)
                                @php
                                $no++;
                                @endphp
                                <tr>
                                    <td class="align-middle">{{ $no }}</td>
                                    <td class="align-middle">{{ $value->nobukti }}</td>
                                    <td class="align-middle">{{ $value->namaPelanggan }}</td>
                                    <td class="align-middle">Rp. {{ number_format($value->total, 0, ',', '.') }}</td>
                                    <td class="align-middle">{{ $value->created_at }}</td>
                                    <td class="align-middle">
                                        @if ($value->status == 1)
                                        verified
                                        @else
                                        unverified
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{{ $value->nobukti }}">
                                            Bukti Bayar
                                        </button>
                                    </td>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal{{ $value->nobukti }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal{{ $value->nobukti }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{ $value->nobukti }}Label">Bukti Bayar</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    @if (!empty($value->buktibayar))
                                                    <!-- Gambar dengan link untuk membuka di tab baru -->
                                                    <a href="{{ asset($value->buktibayar) }}" target="_blank">
                                                        <img src="{{ asset($value->buktibayar) }}" alt="Bukti Pembayaran {{ $value->nobukti }}" style="max-width: 100%;" class="img-fluid">
                                                    </a>
                                                    @else
                                                    No Image
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td class="align-middle">
                                        <form action="{{ route('update-status', $value->nobukti) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                @if ($value->status == 1)
                                                <i class='bx bx-x'></i>
                                                @else
                                                <i class='bx bx-check'></i>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('reject-order', $value->nobukti) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Reject
                                            </button>
                                        </form>
                                    </td>                                    
                                    <td class="align-middle">
                                        <form action="{{ route('detail-penjualan', $value->nobukti) }}" method="GET">
                                            <button type="submit" class="btn btn-info">
                                                <i class='bx bx-detail'></i> Detail
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
        </div>
    </section>
</body>
@stop

</html>
