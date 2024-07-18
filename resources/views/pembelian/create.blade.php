<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @extends('welcome')
    @section('konten')
    </head>

    <body>
        <div class="container mt-5">
            <h2>Input Pembelian</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="purchaseForm" action="{{ route('pembelian.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nobukti" class="form-label">No Bukti</label>
                    <input type="text" class="form-control" id="nobukti" name="nobukti" value="{{ $nobukti }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="tanggal_beli" class="form-label">Tanggal Beli</label>
                    <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli"
                        value="{{ $tanggal_beli }}">
                </div>

                <div class="mb-3">
                    <label for="pemasok" class="form-label">Pemasok</label>
                    <select class="form-control" id="pemasok" name="pemasok">
                        <option value="">-- Pilih Pemasok --</option>
                        <?php
                        $rec = DB::table('tbpemasok')->get();
                        ?>

                        @foreach ($rec as $key)
                            <option value="{{ $key->id }}" {{ $pemasok == $key->id ? 'selected' : '' }}>
                                {{ $key->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <select class="form-control" id="idstok" name="idstok">
                        <option value="">-- Pilih Barang --</option>
                        <?php $rec = DB::table('tbstok')->get(); ?>
                        @foreach ($rec as $key)
                            <option value="{{ $key->id }}" data-harga="{{ $key->harga_jual }}">{{ $key->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga">
                </div>


                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Pemasok</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($value as $pembelian)
                        <tr>
                            <td>@php
                                $idstokInfo = DB::table('tbstok')
                                    ->where('id', $pembelian->idstok)
                                    ->first();
                                echo $idstokInfo ? $idstokInfo->nama : '';
                            @endphp</td>

                            <td>@php
                                $pemasokInfo = DB::table('tbpemasok')
                                    ->where('id', $pembelian->pemasok)
                                    ->first();
                                echo $pemasokInfo ? $pemasokInfo->nama : '';
                            @endphp</td>

                            <td>{{ $pembelian->quantity }}</td>
                            <td>Rp. {{ number_format($pembelian->harga, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($pembelian->sub_total, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var namaSelect = document.getElementById('idstok');
                var hargaInput = document.getElementById('harga');

                namaSelect.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var selectedHarga = selectedOption.getAttribute('data-harga');

                    // Set the hargaInput value based on selectedHarga
                    hargaInput.value = selectedHarga;
                });
            });
        </script>
    </body>
@endsection

</html>
