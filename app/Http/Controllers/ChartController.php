<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Indikator;
use App\Models\Penilaian;
use App\Models\Aspek;

class ChartController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataPoints = [];
        $dataIndikator = [];

        $sumOfNilaiAspek = [];
        $bobotAspek = [];
        $nilaiAspek = [];
        $aspekName = [];
        $dataAspek = [];

        // $penilaian = Penilaian::where('aplikasi_id', $id)->get();
        // $aplikasi = Aplikasi::find($id);
        $penilaian = Penilaian::where('aplikasi_id', $id)
            ->join('indikator', 'penilaian.indikator_id', '=', 'indikator.id')
            ->select('penilaian.*', 'indikator.nama_indikator', 'indikator.aspek_id')
            ->orderBy('indikator.id')
            ->get();

        $aplikasi = Aplikasi::where('id', $id)->first();
        $aspeks = Aspek::all();

        foreach ($aspeks as $aspek) {
            $sumOfNilaiAspek[$aspek->id] = 0;
            $bobotAspek[$aspek->id] = $aspek->bobot_aspek;
        }

        // Process to calculate values
        foreach ($penilaian as $value) {
            $indikator = Indikator::find($value->indikator_id);
            $bobotIndikator = $indikator->bobot_indikator;
            $aspekId = $indikator->aspek_id;

            array_push($dataPoints, $value->nilai);
            array_push($dataIndikator, substr($indikator->nama_indikator, 0, 12));

            if (isset($sumOfNilaiAspek[$aspekId])) {
                $sumOfNilaiAspek[$aspekId] += $value->nilai * $bobotIndikator;
            }
        }

        foreach ($aspeks as $aspek) {
            $aspekId = $aspek->id;
            $nilaiAspek[$aspekId] = (1 / $bobotAspek[$aspekId]) * $sumOfNilaiAspek[$aspekId];

            if ($aspek) {
                $parts = explode(' - ', $aspek->nama_aspek);
                array_push($aspekName, $parts[1]);
            }
            array_push($dataAspek, floor($nilaiAspek[$aspekId] * 100) / 100);
        }

        $dataSets = [
            'chartId' => 'chart' . $id,
            'dataPoints' => $dataPoints,
            'dataIndikator' => $dataIndikator,
        ];

        $dataSets2 = [
            'radarId' => 'radar' . $id,
            'dataAspek' => $dataAspek,
            'aspekName' => $aspekName,
        ];

        return view('chart', ['id' => $id, 'dataSets' => $dataSets, 'dataSets2' => $dataSets2, 'aplikasi' => $aplikasi]);
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
