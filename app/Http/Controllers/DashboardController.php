<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detailbuku;
use App\Models\peminjaman;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counts['buku'] = Buku::all()->count();
        $counts['stok'] = detailbuku::all()->count();
        $counts['tersedia'] = detailbuku::where('status', 'Tersedia')->count();
        $counts['pinjam'] = detailbuku::where('status', 'Tidak Tersedia')->count();
        
        $user = Auth::user();

    // Jika pengguna memiliki peran "member", ambil data peminjamannya
        if ($user->role == 'member') {
        $dpeminjaman = Peminjaman::where('user_id', $user->id)->get();
        } else {
        $dpeminjaman = Peminjaman::all();
        }

        return view('layouts.pages.dashboard',[
            'judul' => 'Dashboard',
            'data' => $counts,
            'dpeminjaman' => peminjaman::all(),
            'dipinjam' => $dpeminjaman
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
