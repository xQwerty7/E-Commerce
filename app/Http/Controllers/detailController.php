<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class detailController extends Controller
{
    public function index(Request $r, $id){
        $stok = DB::table('tbstok')
            ->leftJoin('tbkategori', 'tbkategori.id', '=', 'tbstok.id_kategori')
            ->leftJoin('vsaldoakhir', 'vsaldoakhir.id', '=', 'tbstok.id')
            ->select('tbstok.*', 'tbkategori.nama as namakategori', 'vsaldoakhir.saldoakhir')
            ->where('tbstok.id', $id)->first();
            
        return view('detail')->with('stok', $stok);
    }

    public function showOrders() {
        $userId = Auth::id();
    
        $rec = DB::table('tbjual')
            ->leftJoin('tbmutasi', 'tbmutasi.nobukti', '=', 'tbjual.nobukti')
            ->select(
                'tbjual.nobukti',
                'tbmutasi.status as status',
                'tbmutasi.created_at as created_at',
                'tbjual.total as total'
            )
            ->where('tbjual.idpelanggan', $userId)
            ->orderBy('created_at', 'desc')
            ->groupBy('tbjual.nobukti', 'tbmutasi.status', 'tbjual.total', 'tbmutasi.created_at')
            ->get();
    
        return view('order')->with('rec', $rec);
    }

    public function getOrderDetails($nobukti) {
        $userId = Auth::id();
        $rec = DB::table('tbjual')
        ->leftJoin('tbmutasi', 'tbmutasi.nobukti', '=', 'tbjual.nobukti')
        ->leftJoin('tbstok', 'tbstok.id', '=', 'tbmutasi.id_stok')
        ->select(
            'tbjual.nobukti',
            'tbstok.nama',
            'tbstok.harga_jual',
            'tbmutasi.quantity',
            'tbjual.total as total'
        )
        ->where('tbmutasi.nobukti', $nobukti)
        ->groupBy('tbjual.nobukti', 'tbjual.total', 'tbstok.nama', 'tbmutasi.quantity','tbstok.harga_jual')
        ->get();
        return view('detailorder', compact('rec'));  
    }

}
