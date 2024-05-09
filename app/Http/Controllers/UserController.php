<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.pages.datauser',[
            'judul' => 'Data User',
            'data' => User::all()
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create($validatedata);
        return redirect()->back()->with('success','berhasil di tambah');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->back()->with('success','berhasil di ubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request,User $user)
    {
        $user = User::where('id',$request->get('user_id'))->first();
        $user->delete();
        return redirect()->back()->with('success','berhasil di hapus');

    }
}
