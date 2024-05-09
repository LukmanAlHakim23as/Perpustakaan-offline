<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.pages.datakategori',[
            'judul' => 'Data Kategori',
            'data' => kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validatedata = $request->validate([
            'name' => 'required'
        ]);

        kategori::create($validatedata);

        return redirect()->back()->with('success','berhasil di tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori $kategori,$id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->back()->with('success','berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request,kategori $kategori)
    {
        $kategori = kategori::where('id',$request->get('kategori_id'))->first();
        $kategori->delete();
        return redirect()->back()->with('success','berhasil di hapus');

    }
}
