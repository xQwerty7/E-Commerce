<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pemasokController extends Controller
{
    public function index(){
        session(['active_session' => 'pemasok']);
        return view('pemasok.list');
    }

    public function create(){
        return view('pemasok.form');
    }

    public function store(Request $r){
        $x=array(
            'nama'=>$r->nama,
            'alamat'=>$r->alamat,
            'nohp'=>$r->nohp,
            'created_at'=> now(),
            'updated_at'=> now()
        );
        $rec=DB::table('tbpemasok')
        ->where('nama',$r->nama)
        ->first();
        if($rec==null){
            DB::table('tbpemasok')->insertGetId($x);
        } else {
            $pesan="nama sudah terdaftar";
        }
        return view('pemasok.list');
    }   

    public function show($id){
        return view('pemasok.formedit')
        ->with('id',$id);
        }
    public function update(Request $r)
        {
            $x=array(
                'nama'=>$r->nama,
                'alamat'=>$r->alamat,
                'nohp'=>$r->nohp,
                'updated_at'=> now()
            );

        DB::table('tbpemasok')
        ->where('id',$r->id)
        ->update($x);

        return view('pemasok.list')
        ->with('judul','Daftar mahasiswa');
    }
    
    public function destroy($id)
        {
        $pesan = '';
        $rec = DB::table('tbpemasok')->where('id', $id)->first();
        if ($rec != null) {
            DB::table('tbpemasok')->where('id', $id)->delete();
            $pesan = 'pemasok berhasil dihapus';
        } else {
            $pesan = 'pemasok tidak ditemukan';
        }

        return view('pemasok.list')->with('pesan', $pesan);
        }
}
