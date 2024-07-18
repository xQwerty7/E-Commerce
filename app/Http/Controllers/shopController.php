<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class shopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $query = DB::table('tbstok')
            ->leftJoin('tbkategori', 'tbstok.id_kategori', '=', 'tbkategori.id')
            ->select('tbstok.*', 'tbkategori.nama as kategori_nama');

        if ($search) {
            $query->where('tbstok.nama', 'like', "%{$search}%");
        }

        if ($kategori) {
            $query->where('tbstok.id_kategori', $kategori);
        }

        $stok = $query->get();
        $kategory = DB::table('tbkategori')->get();

        return view('shop', compact('stok', 'kategory', 'search', 'kategori'));
    }
}
