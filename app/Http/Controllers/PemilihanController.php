<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;
use App\Pemilihan;
use Illuminate\Support\Facades\Auth;

class PemilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $kandidats = Kandidat::all();
        // where userid
        $pemilihan = Pemilihan::where('user_id', Auth::id())->first(); 
        return view('pemilihan.index', compact('kandidats','pemilihan'));

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
        Pemilihan::create($request->only('kandidat_id', 'user_id'));
        return redirect()->route('pemilihan.index')->with('success', 'Berhasil Melakukan Pemilihan.');
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
