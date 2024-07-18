<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
    public function index()
    {
        $idpelanggan = auth()->user()->id;
    
        $cartItems = DB::table('tbkeranjang')
            ->leftJoin('tbstok', 'tbstok.id', '=', 'tbkeranjang.id_stok')
            ->select('tbkeranjang.*', 'tbstok.nama', 'tbstok.harga_jual')
            ->where('tbkeranjang.id_pelanggan', $idpelanggan)
            ->get();
    
        $totalHarga = 0;
        foreach ($cartItems as $item) {
            $totalHarga += $item->harga * $item->quantity;
        }
    
        return view('checkout', compact('cartItems', 'totalHarga'));
    }

    public function prosescheckout(Request $request)
    {
        // Generate nobukti
        $nobukti = 'J' . now()->format('YmdHis') . rand(1000, 9999);
    
        // Validate request
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'buktibayar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = Auth::user();
        
        // Handle file upload
        $buktiBayar = $request->file('buktibayar');
        $extension = $buktiBayar->getClientOriginalExtension(); // Get file extension
        $buktiBayarName = 'bukti_bayar_' . time() . '.' . $extension; // Unique file name
    
        // Move file to public directory
        $buktiBayar->move(public_path('bukti_bayar'), $buktiBayarName);
    
        // Path file for database storage
        $buktiBayarPath = 'bukti_bayar/' . $buktiBayarName;
    
        DB::table('tbpelanggan')->insert([
            'kode_pelanggan' => $user->id,
            'nobukti' => $nobukti,
            'nama_pelanggan' => $user->name,
            'alamat_pelanggan' => $request->address,
            'nohp' => $request->phone,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        $datakeranjang = DB::table('tbkeranjang')
            ->where('id_pelanggan', $user->id)
            ->get();
    
        $totalHarga = 0;
        foreach ($datakeranjang as $value) {
            $totalHarga += $value->harga * $value->quantity;
        }
    
        // Insert into tbjual table
        DB::table('tbjual')->insert([
            'nobukti' => $nobukti,
            'tgl' => now(),
            'idpelanggan' => $user->id,
            'keterangan' => 'Pembelian Barang',
            'total' => $totalHarga,
            'buktibayar' => $buktiBayarPath // Save the file path in the database
        ]);
    
        // Loop to insert into tbmutasi table and delete from tbkeranjang
        foreach ($datakeranjang as $item) {
            // Insert into tbmutasi table
            DB::table('tbmutasi')->insert([
                'nobukti' => $nobukti,
                'id_stok' => $item->id_stok,
                'quantity' => $item->quantity,
                'mk' => 'K',
                'harga' => $item->harga,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('tbkeranjang')->where('id', $item->id)->delete();
        }

        return redirect('thankyou');
    }
}
