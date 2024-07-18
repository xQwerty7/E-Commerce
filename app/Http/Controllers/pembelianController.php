<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pembelianController extends Controller
{
    public function index()
    {
        $value = DB::table('tbbeli')
        ->select('nobukti', 'tanggal_beli', 'pemasok', 'keterangan','idstok', 'quantity', 'harga', DB::raw('SUM(sub_total) as total'))
        ->groupBy('nobukti', 'tanggal_beli', 'pemasok', 'keterangan','idstok', 'quantity', 'harga')
        ->get();
        session(['active_session' => 'pembelian']);
        return view('pembelian.index', compact('value'));
    }

    public function create(Request $request)
    {
        $nobukti = $request->session()->get('nobukti');
        
        if (!$nobukti) {
            $nobukti = 'B' . now()->format('YmdHis') . rand(1000, 9999);
            $request->session()->put('nobukti', $nobukti);
        }
    
        $tanggal_beli = $request->session()->get('tanggal_beli', '');
        $pemasok = $request->session()->get('pemasok', '');
    
        $value = DB::table('tbbeli')
            ->where('nobukti', $nobukti)
            ->get();
    
        return view('pembelian.create', compact('value', 'nobukti', 'tanggal_beli', 'pemasok'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nobukti' => 'required',
            'tanggal_beli' => 'required|date',
            'pemasok' => 'required',
            'keterangan' => 'nullable|string',
            'idstok' => 'required',
            'quantity' => 'required|integer',
            'harga' => 'required|numeric',
        ]);
    
        $nobukti = $request->input('nobukti');
        $subTotal = $request->quantity * $request->harga;
    
        DB::table('tbbeli')->insert([
            'nobukti' => $nobukti,
            'tanggal_beli' => $request->tanggal_beli,
            'pemasok' => $request->pemasok,
            'keterangan' => $request->keterangan,
            'idstok' => $request->idstok,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'sub_total' => $subTotal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        DB::table('tbmutasi')->insert([
            'nobukti' => $nobukti,
            'id_stok' => $request->idstok,
            'quantity' => $request->quantity,
            'mk' => 'M',
            'harga' => $request->harga,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        $request->session()->put('tanggal_beli', $request->tanggal_beli);
        $request->session()->put('pemasok', $request->pemasok);
    
        return redirect()->route('pembelian.create')->with(['success' => 'Pembelian berhasil ditambahkan.', 'nobukti' => $nobukti]);
    }
    
    

    public function destroy($id)
    {
        DB::table('tbbeli')->where('id', $id)->delete();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus.');
    }

    public function resetPurchaseNumber(Request $request)
    {
        $request->session()->forget('nobukti');
        $request->session()->forget('tanggal_beli');
        $request->session()->forget('pemasok');
        return redirect()->route('pembelian.create');
    }

    
}
