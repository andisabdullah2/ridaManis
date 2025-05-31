<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;
use App\Pemilihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class HasilPemilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
         // Ambil total suara per kandidat untuk tahun ini
         $hasil = Pemilihan::select('kandidat_id', DB::raw('count(*) as total_suara'))
                            ->whereYear('tanggal', Carbon::now()->year)
                            ->groupBy('kandidat_id')
                            ->with('kandidat') // Relasi ke tabel kandidat
                            ->get();

        return view('pemilihan.hasil', compact('hasil'));

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
