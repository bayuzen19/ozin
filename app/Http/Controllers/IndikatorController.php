<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use App\Models\Indikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Indikator::all();
        // return view('indikator')->with('data', $data);

        if (session()->missing('username')) {
            return view('auth.login');
        } else {
            $aspeks = Aspek::with('indikator')->get();
            return view('indikator', compact('aspeks'));
        }
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
        Session::flash('nama_indikator', $request->nama_indikator);
        Session::flash('bobot', $request->bobot);

        $request->validate(
            [
                'nama_indikator' => 'required',
                'bobot' => 'required|numeric',
            ],
            [
                'nama_indikator.required' => 'Nama indikator wajib diisi',
                'bobot.required' => 'Bobot wajib diisi',
                'bobot.numeric' => 'Bobot wajib diisi dalam angka',
            ]
        );

        $data = [
            'nama_indikator' => $request->input('nama_indikator'),
            'bobot' => $request->input('bobot'),
        ];
        Indikator::create($data);
        return redirect()
            ->back()
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        // dd($request->all());
        $request->validate(
            [
                'nama_indikator' => 'required',
                'bobot' => 'required|numeric',
            ],
            [
                'nama_indikator.required' => 'Nama indikator wajib diisi',
                'bobot.numeric' => 'Bobot wajib diisi dalam angka',
            ]
        );

        $data = [
            'nama_indikator' => $request->input('nama_indikator'),
            'bobot' => $request->input('bobot'),
        ];
        Indikator::find($id)->update($data);

        return redirect()
            ->back()
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Aspek::find($id)->delete();
        return redirect()
            ->back()
            ->with('success', 'Data berhasil dihapus');

        // $aspek = Aspek::findOrFail($id);
        // $aspek->indikators()->delete();
        // $aspek->delete();

        // return redirect()->route('aplikasi')->with('success', 'Aspek deleted successfully');
    }
}
