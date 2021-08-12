<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function index(){
        $datas = Data::all();
        return view('/index',compact('datas'));
    }
    public function tambah(){
        return view('tambah');
    }
    public function simpan(Request $request){
        // dd($request->all());
        // menyimpan data file yang diupload ke variabel $file
        $gambar = $request->file('gambar');
 
        $nama_foto = time() . "_" . $gambar->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
        $moved = 'images';
        $gambar->move($moved, $nama_foto);
        $datas = Data::create([
                'judul'=>$request['judul'],
                'conten'=>$request['conten'],
                'gambar' => $nama_foto
            ]);
        return redirect('index')->with('status','Data Berhasil Di Tambah');
    }
    public function delete(Request $request,$id){
        $datas = Data::find($id);
        unlink("images/" . $datas->gambar);
        $datas->delete();
        return redirect('index')->with('status','Data Berhasil Di Hapus');

    }
    public function edit($id)
{
    $datas = Data::where('id', $id)->first();
    return view('edit',compact('datas'));
}
    // public function update(Request $request, $id)
    // {
    //     //get data Blog by ID
    // $datas = Data::findOrFail($datas->id);

    // if($request->file('images') == "") {

    //         $datas->update([
    //             'judul'     => $request->judul,
    //             'conten'   => $request->conten
    //         ]);
    //         return redirect('index')->with('status','Data Berhasil Di Ubah');
    //     } else {

    //         //hapus old image
    //         Storage::disk('local')->delete('public/images/'.$datas->gambar);

    //         //upload new image
    //         $image = $request->file('images');
    //         $image->storeAs('public/images', $image->hashName());

    //         $datas->update([
    //             'images'     => $images->hashName(),
    //             'judul'     => $request->judul,
    //             'conten'   => $request->conten
    //         ]);
    //         return redirect('index')->with('status','Data Berhasil Di Ubah');
    //     }

    // }

    public function update(Request $request,$id){
        $datas = Data::find($id);
        $datas->judul = $request->judul;
        $datas->conten = $request->conten;
        if($request->gambar == ''){
            $datas->save();
            return redirect('index')->with('status','Data Berhasil Di Ubah');
        }
        else{
            $datas->gambar = $request->gambar;

            $datas->save();
            return redirect('index')->with('status','Data Berhasil Di Ubah');

        }
        
    }
}
