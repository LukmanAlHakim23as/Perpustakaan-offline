<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detailbuku;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.pages.datapeminjaman',[
            'judul' => 'Data Peminjaman',
            'dpeminjaman' => Peminjaman::where('history', null)->get(),
            'dbuku' => Buku::all(),
            'dmember' => User::where('role','member')->get(),
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
        $validatedData = $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
        ]);

        $validatedData['admin_id'] = Auth()->user()->id;

        $bukudetail_id = detailbuku::where('buku_id', $request['buku_id'])->where('status', 'Tersedia')->first()->id;

        $validatedData['detailbuku_id'] = $bukudetail_id;


        Peminjaman::create($validatedData);

        detailbuku::where('buku_id', $request['buku_id'])->where('status', 'Tersedia')->first()->update(['status' => 'Tidak Tersedia']);

        return redirect()->back()->with('success', 'Buku berhasil di Pinjam');

    }


    /**
     * Display the specified resource.
     */
    public function show(peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {

        $validatedData = $request->validate([
            'buku_id' => 'required',
            'peminjaman_id' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        $bukudetail = detailbuku::where('buku_id', $request['buku_id'])->where('status', 'Tidak Tersedia')->first();

        $validatedData['detailbuku_id'] = $bukudetail;

        $bukudetail->where('buku_id', $request['buku_id'])->where('status', 'Tidak Tersedia')->first()->update(['status' => 'Tersedia']);
        $peminjaman->update([
            'history' => 1,
            'tgl_kembali' => now()
        ]);
        

        return redirect()->back()->with('success', 'Buku berhasil di Kembalikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request,peminjaman $peminjaman)
    {
        // $peminjaman = peminjaman::where('id', $request->get('peminjaman_id'))->first();
        // $peminjaman->delete();
        // return redirect()->back()->with('success', 'Peminjaman berhasil di hapus');

    }

    public function history()
    {
        $user = (auth()->user()->role == "member") ? 'member' : '';

        if($user) {
            $data = Peminjaman::where('user_id', auth()->user()->id)
                                ->orderBy('id', 'desc')
                                ->get();
        }
        else {
            $data = Peminjaman::all();
        }
        
        return view('layouts.pages.datalaporan',[
            'data' => $data
        ]);
    }

    public function generatePdf(){
         // Ambil semua data peminjaman
         $peminjaman = Peminjaman::all();

         $data = [
             'peminjaman' => $peminjaman,
         ];
         $pdf = PDF::loadView('layouts.pages.pdf',$data);
 
         return $pdf->download('data_laporan_peminjaman.pdf');
    }


    
}
