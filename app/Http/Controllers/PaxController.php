<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pax;
use App\Services\GoogleContactService;
use Carbon\Carbon;

class PaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!session('google_token')) {
            return redirect()->route('google.login');
        }

        $query = Pax::query();

        // Filter tanggal berangkat
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_berangkat', $request->tanggal);
        }

        // Pencarian umum
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                ->orWhere('origin', 'like', "%{$search}%")
                ->orWhere('arrival', 'like', "%{$search}%")
                ->orWhere('nomor', 'like', "%{$search}%")
                ->orWhere('respon_pnr', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // $gamilesAktivate = $request->filled('miles');
        if ($request->filled('miles') && $request->miles === 'GA') {
            $query->where('ga_miles', '!=', 'NO DATA');
        }

        // Pagination dan formatting tanggal
        $paxs = $query->orderBy('id', 'desc')
            ->paginate(10)
            ->through(function ($item) {
                $item->tanggal_issued = Carbon::parse($item->tanggal_issued)->format('d-m-Y');
                $item->tanggal_berangkat = Carbon::parse($item->tanggal_berangkat)->format('d-m-Y');
                return $item;
            });

        return view('pax.index', compact('paxs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->only('nama', 'nomor', 'email', 'kode_booking', 'nomor_tiket', 'tanggal_issued', 'flight_number', 'tanggal_berangkat', 'origin', 'arrival', 'pax', 'sub_class', 'ga_miles', 'type_of_trip', 'code_corp', 'poi');
        $data['respon_pnr'] = 'UNABLE';
        pax::create($data);
        // Simpan ke Google Contacts
        $formattedName = $request->tanggal_berangkat . '-' . $request->nama . '-' . $request->kode_booking;
        try {
            $googleService = new GoogleContactService();
            $googleService->addContact([
            'nama' => $formattedName,
            'nomor' => $request->nomor,
            'email' => $request->email
        ]);
        } catch (\Exception $e) {
        }
        return redirect()->route('pax.index')->with('success', 'pax berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pax = pax::findOrFail($id);
        return view('pax.show', compact('pax'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pax = pax::findOrFail($id);
        return view('pax.edit', compact('pax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pax = pax::findOrFail($id);
        $pax->update($request->only('nama', 'nomor', 'email', 'kode_booking', 'nomor_tiket', 'tanggal_issued', 'flight_number', 'tanggal_berangkat', 'origin','arrival','pax','sub_class','ga_miles','type_of_trip','code_corp','poi'));

        return redirect()->route('pax.index')->with('success', 'pax berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pax = pax::findOrFail($id);
        $pax->delete();

        return redirect()->route('pax.index')->with('success', 'pax berhasil dihapus.');
    }

    public function updateResponPnr(Request $request, $id)
    {
        $pax = Pax::findOrFail($id);
        $pax->respon_pnr = $request->respon_pnr;
        $pax->save();

        return back()->with('success', 'Respon PNR berhasil diperbarui.');
    }

}
