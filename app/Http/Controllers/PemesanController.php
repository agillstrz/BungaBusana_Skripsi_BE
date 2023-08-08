<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use Illuminate\Http\Request;

class PemesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $pemesan = Pemesan::create([
            'user_id' => $request->user_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'ongkir' => $request->ongkir,
            'kodepos' => $request->kodepos,
            'total_harga' => $request->total_harga,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        return response()->json([
            'data'=> $pemesan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesan $pemesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesan $pemesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesan $pemesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesan $pemesan)
    {
        //
    }
}