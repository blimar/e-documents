<?php

namespace App\Http\Controllers;

use App\Models\MJabatan;
use Illuminate\Http\Request;

class MJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = MJabatan::all();

        return inertia('jabatan/index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('jabatan/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'unique:m_jabatan,nama'],
        ]);

        MJabatan::create($data);
        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MJabatan $jabatan)
    {
        $jabatan = MJabatan::find($jabatan->id);

        return response()->json($jabatan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MJabatan $jabatan)
    {
        return inertia('jabatan/form', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MJabatan $jabatan)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', "unique:m_jabatan,nama, {$jabatan->id}"]
        ]);

        $jabatan->update($data);
        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MJabatan $jabatan)
    {
        if ($jabatan->personel()->exists()) {
            return back()->withErrors([
                [
                    'message' => 'Jabatan ini masih digunakan oleh data Personel, data tidak bisa dihapus sebelum data personel yang menggunakan jabatan ini dihapus'
                ]
            ]);
        }
        $jabatan->delete();
        return back();
    }
}
