<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class penjualanController extends Controller
{
    public function index() {

        $rec = DB::table('tbjual')
            ->leftJoin('tbmutasi', 'tbmutasi.nobukti', '=', 'tbjual.nobukti')
            ->leftJoin('tbpelanggan', 'tbpelanggan.kode_pelanggan', '=', 'tbjual.idpelanggan')
            ->select(
                'tbjual.nobukti',
                'tbpelanggan.nama_pelanggan as namaPelanggan',
                'tbmutasi.status as status',
                'tbmutasi.created_at as created_at',
                'tbjual.total as total',
                'tbjual.buktibayar as buktibayar'
            )
            ->orderBy('created_at', 'desc')
            ->groupBy('tbjual.nobukti', 'tbpelanggan.nama_pelanggan', 'tbmutasi.status', 'tbmutasi.created_at', 'tbjual.total', 'tbjual.buktibayar')
            ->paginate(8);
        session(['active_session' => 'penjualan']);        
        return view('penjualan')->with('rec', $rec);
    }
    
    public function updateStatus($nobukti)
    {
        $status = DB::table('tbmutasi')
            ->where('nobukti', $nobukti)
            ->value('status');

        $newStatus = $status == 1 ? 0 : 1;

        DB::table('tbmutasi')
            ->where('nobukti', $nobukti)
            ->update(['status' => $newStatus]);

        return back()->with('status', 'Status updated successfully!');
    }

    public function rejectOrder($nobukti)
{
    // Hapus dari tbjual
    DB::table('tbjual')
        ->where('nobukti', $nobukti)
        ->delete();

    // Hapus dari tbmutasi
    DB::table('tbmutasi')
        ->where('nobukti', $nobukti)
        ->delete();

    return back()->with('status', 'Order rejected successfully!');
}

    public function showDetail($nobukti)
    {
        $items = DB::table('tbjual')
            ->leftJoin('tbmutasi', 'tbjual.nobukti', '=', 'tbmutasi.nobukti')
            ->leftJoin('tbstok', 'tbstok.id', '=', 'tbmutasi.id_stok')
            ->where('tbjual.nobukti', $nobukti)
            ->select('tbstok.nama', 'tbmutasi.quantity', 'tbmutasi.harga')
            ->get();
    
        return view('detailpenjualan')->with('items', $items);
    }
    

}
