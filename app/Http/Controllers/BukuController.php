<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detailbuku;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.pages.databuku', [
            'judul' => 'Data Buku',
            'data' => Buku::all(),
            'dkategori' => kategori::all()
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
        // Validasi input yang diterima
        $validatedata = $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer',
        ]);

        // Jika ada file gambar yang diunggah
        if ($request->file('image')) {
            $validatedata['image'] = $request->file('image')->store('cover-buku', 'public');
        }

        // Membuat buku baru menggunakan data yang telah divalidasi
        $buku = Buku::create($validatedata);

        // Membuat detail buku sesuai dengan jumlah stok yang diberikan
        $stok = $request->input('stok');
        $validatedDetail = [
            'buku_id' => $buku->id,
            'status' => 'Tersedia',
        ];

        for ($i = 0; $i < $stok; $i++) {
            DetailBuku::create($validatedDetail);
        }

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(buku $buku, $id)
    {
        $buku = buku::findOrFail($id);
        return view('layouts.pages.datailbuku', [
            'buku' => $buku
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, buku $buku)
    {
        $buku = Buku::findOrFail($request->buku_id);

        $validatedata = $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
        ]);



        // Perbarui atribut buku
        $buku->update($validatedata);

        // Perbarui detail buku
        $bukustok = detailbuku::where('buku_id', $buku->id)->count();
        $stok = $request->input('stok');

        // Jika stok baru lebih besar dari stok sebelumnya, tambahkan detail buku baru
        if ($stok > $bukustok) {
            $tambahdetail = $stok - $bukustok;
            for ($i = 0; $i < $tambahdetail; $i++) {
                detailbuku::create([
                    'buku_id' => $buku->id,
                    'status' => 'Tersedia',
                ]);
            }
        }
        // Jika stok baru lebih kecil dari stok sebelumnya, hapus detail buku yang berlebihan
        elseif ($stok < $bukustok) {
            $hapusdetail = $bukustok - $stok;
            detailbuku::where('buku_id', $buku->id)->take($hapusdetail)->delete();
        }

        return redirect()->back()->with('success', 'Buku berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request, buku $buku)
    {
        $buku = Buku::findOrFail($request->buku_id);

        $buku->delete();

        $detail = DetailBuku::where('buku_id', $buku->id)->get();
        foreach ($detail as $buku) {
            $buku->delete();
        }
        return redirect()->back()->with('success', 'berhasil di hapus');
    }
}
