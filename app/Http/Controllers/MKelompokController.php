<?php

namespace App\Http\Controllers;

use App\Models\MKelompok;
use Illuminate\Http\Request;

class MKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelompoks = MKelompok::all();

        return inertia('kelompok/index', compact('kelompoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('kelompok/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'unique:m_kelompok,nama'],
        ]);

        MKelompok::create($data);
        return redirect()->route('kelompok.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MKelompok $mKelompok)
    {
        $kelompok = MKelompok::find($mKelompok->id);

        return response()->json($mKelompok);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MKelompok $mKelompok)
    {
        return inertia('kelompok/form', compact('mKelompok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MKelompok $mKelompok)
    {
        $data = $request->validate([
            'nama' => ['required', "m_kelompok,nama, {$mKelompok->id}"],
        ]);

        $mKelompok->update($data);
        return redirect()->route('kelompok.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MKelompok $mKelompok)
    {

        if ($mKelompok->personel()->exists()) {

            return back()->withErrors([
                'message' => 'Kelompok ini masih digunakan oleh data Personel, data tidak bisa di hapus sebelum data personel pada kelompok ini kosong'
            ]);
        }

        $mKelompok->delete();
        dd($mKelompok);
        return redirect()->route('kelompok.index');
    }
}
