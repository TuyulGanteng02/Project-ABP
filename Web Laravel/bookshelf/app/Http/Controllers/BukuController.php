<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = buku::orderBy('judul','asc')->get();
        $belumSelesaiDibaca = $data->where('status_dibaca', 0);
        $sudahSelesaiDibaca = $data->where('status_dibaca', 1);
        return view('buku/index', compact('belumSelesaiDibaca','sudahSelesaiDibaca'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku/create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('judul',$request->judul);
        Session::flash('penulis',$request->penulis);
        Session::flash('tahun_terbit',$request->tahun_terbit);
        $request->validate([
            'judul'=>'required',
            'penulis'=>'required',
            'tahun_terbit'=>'required',
        ],[
            'judul.required'=>'Judul buku harap diisi',
            'penulis.required'=>'Penulis buku harap diisi',
            'tahun_terbit.required'=>'Tahun terbit harap diisi',
        ]);
        $status_dibaca = $request->has('status_dibaca') ? 1 : 0;
        $data = [
            'judul'=>$request->input('judul'),
            'penulis'=>$request->input('penulis'),
            'tahun_terbit'=>$request->input('tahun_terbit'),
            'status_dibaca'=>$status_dibaca,
        ];
        buku::create($data);
        return redirect('buku')->with('success','Buku berhasil dimasukkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = buku::where('id',$id)->first();
        return view('buku/show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = buku::where('id',$id)->first();
        return view('buku/edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'=>'required',
            'penulis'=>'required',
            'tahun_terbit'=>'required',
        ],[
            'judul.required'=>'Judul buku harap diisi',
            'penulis.required'=>'Penulis buku harap diisi',
            'tahun_terbit.required'=>'Tahun terbit harap diisi',
        ]);
        $status_dibaca = $request->has('status_dibaca') ? 1 : 0;
        $data = [
            'judul'=>$request->input('judul'),
            'penulis'=>$request->input('penulis'),
            'tahun_terbit'=>$request->input('tahun_terbit'),
            'status_dibaca'=>$status_dibaca,
        ];
        buku::where('id',$id)->update($data);
        return redirect('buku')->with('success','Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        buku::where('id',$id)->delete();
        return redirect('/buku')->with('success','Buku berhasil dihapus');
    }
}
