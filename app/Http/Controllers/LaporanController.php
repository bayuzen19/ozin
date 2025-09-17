<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Aplikasi;
use App\Models\Aspek;
use App\Models\Indikator;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
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
            return view('laporan', [
                'aplikasi' => $data,
            ]);
        }
    }

    public function show(string $id)
    {
        $aplikasi = Aplikasi::with('penilaian')->findOrFail($id);
        $nilaiKematangan = $aplikasi->hitungKematangan();

        return view('aplikasi.show', compact('aplikasi', 'nilaiKematangan'));
    }

    public function viewPDF(string $id)
    {
        $penilaian = Penilaian::where('aplikasi_id', $id)
            ->join('indikator', 'penilaian.indikator_id', '=', 'indikator.id')
            ->select('penilaian.*', 'indikator.nama_indikator', 'indikator.aspek_id')
            ->orderBy('indikator.id')
            ->get();

        $aplikasi = Aplikasi::where('id', $id)->first();
        $aspeks = Aspek::all(); // Retrieve all aspects

        $sumOfNilaiAspek = [];
        $bobotAspek = [];
        $nilaiAspek = [];

        foreach ($aspeks as $aspek) {
            $sumOfNilaiAspek[$aspek->id] = 0;
            $bobotAspek[$aspek->id] = $aspek->bobot_aspek;
        }

        // Process to calculate values
        foreach ($penilaian as $value) {
            $indikator = Indikator::find($value->indikator_id);
            $bobotIndikator = $indikator->bobot_indikator;
            $aspekId = $indikator->aspek_id;

            if (isset($sumOfNilaiAspek[$aspekId])) {
                $sumOfNilaiAspek[$aspekId] += $value->nilai * $bobotIndikator;
            }
        }

        foreach ($aspeks as $aspek) {
            $aspekId = $aspek->id;
            $nilaiAspek[$aspekId] = (1 / $bobotAspek[$aspekId]) * $sumOfNilaiAspek[$aspekId];
            $aspek->nilaiAspek = floor($nilaiAspek[$aspekId] * 100) / 100;
        }

        $defaultDomain1 = 45.50;
        $defaultDomain2 = 16.50;
        $domain1 = ($nilaiAspek[1] * $bobotAspek[1] + $nilaiAspek[2] * $bobotAspek[2]) / $defaultDomain1;
        $domain2 = ($nilaiAspek[3] * $bobotAspek[3] + $nilaiAspek[4] * $bobotAspek[4]) / $defaultDomain2;

        $indeksDomain1 = floor($domain1 * 100) / 100;
        $indeksDomain2 = floor($domain2 * 100) / 100;

        $pdf = PDF::loadView('laporanPDF', [
            'penilaian' => $penilaian,
            'aplikasi' => $aplikasi,
            'aspeks' => $aspeks,
            'indeksDomain1' => $indeksDomain1,
            'indeksDomain2' => $indeksDomain2,
        ]);

        return $pdf->stream('Laporan Hasil Evaluasi.pdf');
    }
}
