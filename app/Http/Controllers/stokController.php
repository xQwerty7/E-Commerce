<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class stokController extends Controller
{
    public function admin(){
        return view('welcome2');
    }
    public function index(){
        $files = File::files(public_path('fotobarang'));
        session(['active_session' => 'stok'], compact('files'));
        
        return view('stok.list');
    }

    public function create(){
        return view('stok.form');
    }

    public function store(Request $r){
        $r->validate([
            'fotobarang.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $images = [];
        
        if($r->hasFile('fotobarang')){
            foreach ($r->file('fotobarang') as $file) {
                $imageName = date('Y-m-d') . '_' . $file->getClientOriginalName();
                $file->move(public_path('fotobarang'), $imageName);
                $images[] = $imageName;
            }
        }
    
        // Convert array of images to JSON string
        $imagesJson = json_encode($images);
        
        $x = array(
            'kode_stok' => $r->kode,
            'nama' => $r->nama,
            'saldo_awal' => $r->saldoawal,
            'harga_beli' => $r->hargabeli,
            'harga_jual' => $r->hargajual,
            'harga_modal' => $r->hargamodal,
            'foto_barang' => $imagesJson, // Store images as JSON string
            'deskripsi_barang' => $r->deskripsibarang,
            'id_satuan' => $r->satuan,
            'id_kategori' => $r->kategori,
        );
    
        $rec = DB::table('tbstok')
            ->where('kode_stok', $r->kode)
            ->first();
    
        if ($rec == null) {
            DB::table('tbstok')->insertGetId($x);
        }
    
        return redirect()->route('stok.index');
    }
    


    public function show($id){
        return view('stok.formedit')
        ->with('judul','Form Edit mahasiswa')
        ->with('id',$id);
        }
        public function update(Request $r)
        {
            $r->validate([
                'fotobarang.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            // Fetch the existing record
            $existingRecord = DB::table('tbstok')->where('id', $r->id)->first();
        
            $x = array(
                'kode_stok' => $r->kode,
                'nama' => $r->nama,
                'saldo_awal' => $r->saldoawal,
                'harga_beli' => $r->hargabeli,
                'harga_jual' => $r->hargajual,
                'harga_modal' => $r->hargamodal,
                'deskripsi_barang' => $r->deskripsibarang,
                'id_satuan' => $r->satuan,
                'id_kategori' => $r->kategori,
            );
        
            $existingImages = json_decode($existingRecord->foto_barang, true) ?? [];
            $newImages = [];
        
            // Check if new files are provided
            if($r->hasFile('fotobarang')){
                foreach ($r->file('fotobarang') as $file) {
                    $imageName = date('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
                    $file->move(public_path('fotobarang'), $imageName);
                    $images[] = $imageName;
                }
            }
        
            // Merge existing images with new images
            $allImages = array_merge($existingImages, $newImages);
            $x['foto_barang'] = json_encode($allImages);
        
            DB::table('tbstok')
                ->where('id', $r->id)
                ->update($x);
        
            return redirect()->route('stok.index');
        }
        public function destroy($id)
        {
            // Mendapatkan nama file dari database
            $fileNamesJson = DB::table('tbstok')->where('id', $id)->value('foto_barang');
            
            // Mendekode JSON menjadi array
            $fileNames = json_decode($fileNamesJson, true);
        
            // Memeriksa apakah file ada dan menghapusnya
            if (is_array($fileNames)) {
                foreach ($fileNames as $fileName) {
                    if (File::exists(public_path('fotobarang/' . $fileName))) {
                        File::delete(public_path('fotobarang/' . $fileName));
                    }
                }
            }
        
            $pesan = '';
            // Mendapatkan record dari database
            $rec = DB::table('tbstok')->where('id', $id)->first();
            
            // Memeriksa apakah record ada dan menghapusnya
            if ($rec != null) {
                DB::table('tbstok')->where('id', $id)->delete();
                $pesan = 'Stok berhasil dihapus';
            } else {
                $pesan = 'Stok tidak ditemukan';
            }
        
            // Redirect ke rute stok.index dengan pesan
            return redirect()->route('stok.index')->with('pesan', $pesan);
        }     
}
