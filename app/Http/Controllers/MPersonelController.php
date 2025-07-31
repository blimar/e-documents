<?php

namespace App\Http\Controllers;

use App\Models\MJabatan;
use App\Models\MKelompok;
use App\Models\MPangkat;
use App\Models\MPersonel;
use Illuminate\Http\Request;

class MPersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personels = MPersonel::all();

        return inertia('personel/index', compact('personels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pangkats = MPangkat::all();
        $jabatans = MJabatan::all();
        $kelompoks = MKelompok::all();
        return inertia('personel/form', [
            'pangkats' => $pangkats,
            'jabatans' => $jabatans,
            'kelompoks' => $kelompoks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'm_jabatan_id' => ['required', 'exists:m_jabatan,id'],
            'm_pangkat_id' => ['required', 'exists:m_pangkat,id'],
            'm_kelompok_id' => ['required', 'exists:m_kelompok,id'],
            'nama' => ['required', 'string'],
            'nrp' => ['required', 'numeric', 'unique:m_personel,nrp'],
        ]);

        MPersonel::create($data);
        return redirect()->route('kelompok.personel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MPersonel $personel)
    {
        $personel = MPersonel::find($personel->id);

        return response()->json($personel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MPersonel $personel)
    {
        $pangkats = MPangkat::all();
        $jabatans = MJabatan::all();
        $kelompoks = MKelompok::all();

        return inertia('personel/form', [
            'pangkats' => $pangkats,
            'jabatans' => $jabatans,
            'kelompoks' => $kelompoks
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MPersonel $personel)
    {
        $data = $request->validate([
            'm_jabatan_id' => ['required', 'exists:m_jabatan,id'],
            'm_pangkat_id' => ['required', 'exists:m_pangkat,id'],
            'm_kelompok_id' => ['required', 'exists:m_kelompok,id'],
            'nama' => ['required', 'string'],
            'nrp' => ['required', 'numeric', "unique:m_persone,nrp,{$personel->id}"]
        ]);

        $personel->update($data);
        return redirect()->route('kelompok.personel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MPersonel $personel)
    {
        $personel->delete();

        return back();
    }
}
