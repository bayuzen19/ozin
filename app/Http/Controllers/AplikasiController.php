<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (session()->missing('username')) {
            return view('auth.login');
        } else {
            $data = Aplikasi::all();
            return view('aplikasi', [
                'aplikasi' => $data,
            ]);
        }
    }

    public function store(Request $request)
    {
        Session::flash('nama_aplikasi', $request->nama_aplikasi);
        Session::flash('deskripsi', $request->deskripsi);

        $request->validate(
            [
                'nama_aplikasi' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'nama_aplikasi.required' => 'Nama aplikasi wajib diisi',
                'deskripsi.required' => 'Deskripsi wajib diisi',
            ]
        );

        $data = [
            'nama_aplikasi' => $request->nama_aplikasi,
            'deskripsi' => $request->deskripsi,
        ];
        Aplikasi::create($data);
        return redirect()
            ->back()
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nama_aplikasi' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'nama_aplikasi.required' => 'Nama aplikasi wajib diisi',
                'deskripsi.required' => 'Deskripsi wajib diisi',
            ]
        );

        $data = [
            'nama_aplikasi' => $request->input('nama_aplikasi'),
            'deskripsi' => $request->input('deskripsi'),
        ];
        Aplikasi::find($id)->update($data);

        return redirect()
            ->back()
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Aplikasi::find($id)->delete();
        return redirect()
            ->back()
            ->with('success', 'Data berhasil dihapus');
    }
}
