<?php

namespace App\Http\Controllers;

use App\Models\MPangkat;
use Illuminate\Http\Request;

class MPangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pangkats = MPangkat::all();

        return inertia('pangkat/index', compact('pangkats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('pangkat/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'unique:m_pangkat,nama'],
        ]);

        MPangkat::create($data);
        return redirect()->route('pangkat.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MPangkat $pangkat)
    {
        $pangkat = MPangkat::find($pangkat->id);

        return response()->json($pangkat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MPangkat $pangkat)
    {
        return inertia('pangkat/form', compact('pangkat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MPangkat $pangkat)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', "unique:m_pangkat,nama,{$pangkat->id}"],
        ]);

        $pangkat::update($data);
        return redirect()->route('pangkat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MPangkat $pangkat)
    {
        if ($pangkat->personel()->exists()) {
            return back()->withErrors([
                'message' => 'Pangkat ini masih digunakan oleh data Personel, pangkat tidak bisa dihapus sebelum data personel yang menggunakan pangkat ini dihapus'
            ]);
        }

        $pangkat->delete();
        return back();
    }
}
