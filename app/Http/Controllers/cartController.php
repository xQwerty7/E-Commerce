<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;    

class cartController extends Controller
{
    public function index(){

        $idpelanggan = auth()->user()->id;
        $cartItems = DB::table('tbkeranjang')
            ->leftJoin('tbstok', 'tbstok.id', '=', 'tbkeranjang.id_stok')
            ->leftJoin('tbkategori', 'tbkategori.id', '=', 'tbstok.id_kategori')
            ->leftJoin('tbpelanggan', 'tbpelanggan.id_pelanggan', '=', 'tbkeranjang.id_pelanggan')
            ->leftJoin('tbsatuan', 'tbsatuan.id', '=', 'tbstok.id_satuan')
            ->select('tbkeranjang.*', 'tbstok.*', 'tbpelanggan.nama_pelanggan as namaPelanggan', 'tbkategori.nama as namaKategori', 'tbsatuan.nama as namaSatuan')
            ->where('tbkeranjang.id_pelanggan', $idpelanggan)
            ->get();

        return view('cart')
        ->with('cartItems', $cartItems);
    }

    // 
// YourController.php
public function addToCart(Request $request, $id)
{
    $idpelanggan = auth()->user()->id;
    $quantity = $request->input('quantity');

    $stok = DB::table('tbstok')
        ->leftJoin('tbsatuan', 'tbsatuan.id', '=', 'tbstok.id_satuan')
        ->leftJoin('tbkategori', 'tbkategori.id', '=', 'tbstok.id_kategori')
        ->select('tbstok.*', 'tbsatuan.nama as satuan', 'tbkategori.nama as kategori')
        ->where('tbstok.id', $id)
        ->first();

    $existingCart = DB::table('tbkeranjang')
        ->where('id_pelanggan', $idpelanggan)
        ->where('id_stok', $id)
        ->first();

    if ($existingCart) {
        DB::table('tbkeranjang')
            ->where('id', $existingCart->id)
            ->increment('quantity', $quantity);
    } else {
        DB::table('tbkeranjang')->insert([
            'id_pelanggan' => $idpelanggan,
            'id_stok' => $id,
            'quantity' => $quantity,
            'harga' => $stok->harga_jual,
            'tanggal' => now(),
        ]);
    }

    return redirect()->back()->with('status', 'Product added to cart!');
}



    public function updatecart(Request $request, $id)
    {
        $idpelanggan = Auth::id();
        $newQty = $request->input('quantity');

        // Update the quantity in the database
        DB::table('tbkeranjang')
            ->where('id_stok', $id)
            ->where('id_pelanggan', $idpelanggan)
            ->update(['quantity' => $newQty]);

        // Optionally, you can flash a message to the session to indicate success
        return redirect()->back();
    }
    public function deleteCart($id)
    {
        $idpelanggan = auth()->user()->id;
        

        DB::table('tbkeranjang')
            ->where('id_pelanggan', $idpelanggan)
            ->where('id_stok', $id)
            ->delete();

        Alert::success('Success', 'Product Berhasil Dihapus dari keranjang');
        return redirect()->back();
    }
}
