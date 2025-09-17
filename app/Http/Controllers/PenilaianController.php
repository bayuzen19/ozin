<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use App\Models\Aplikasi;
use App\Models\Indikator;
use App\Models\penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'nama_indikator' => 'required',
            'nilai' => 'required',
            // 'keterangan' => 'required',
            'bukti' => 'sometimes|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ], [
            'nama_indikator.required' => 'Nama indikator wajib diisi',
            'nilai.required' => 'Nilai wajib diisi',
            'nilai.numeric' => 'Nilai wajib diisi dalam angka',
            // 'keterangan.required' => 'Keterangan wajib diisi',
            'bukti.mimes' => 'Bukti harus berupa file dengan tipe: jpeg, png, jpg, pdf',
            'bukti.max' => 'Bukti tidak boleh lebih dari 2MB'
        ]);

        $data = [
            'indikator_id' => $request->input('nama_indikator'),
            'bobot' => $request->input('bobot_indikator'),
            'nilai' => $request->input('nilai'),
            'keterangan' => $request->input('keterangan_value'),
            'aplikasi_id' => $request->input('aplikasi_id'),
        ];

        if ($request->hasFile('bukti')) {
            try {
                $file = $request->file('bukti');
                if ($file->isValid()) {
                    $filename = $file->getClientOriginalName();
                    $path = 'public/bukti_pendukung';
                    $file->move($path, $filename);

                    $data['bukti'] = $filename;
                    Log::info('File uploaded successfully: ' . $filename);
                } else {
                    return redirect()->back()->with('error', 'The uploaded file is not valid.');
                }
            } catch (\Exception $e) {
                Log::error('Failed to upload image: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }

        Penilaian::create($data);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function show(Request $request, string $id)
    {
        if (session()->missing('username')) {
            return view('auth.login');
        } else {
            // gabungkan tabel penilaian and aplikasi --> dengan indikator and sort by indikator_id
            $data = Indikator::leftJoin('penilaian', function ($join) use ($id) {
                $join->on('indikator.id', '=', 'penilaian.indikator_id')
                    ->where('penilaian.aplikasi_id', '=', $id);
            })
                ->select('indikator.id', 'indikator.nama_indikator', 'penilaian.id as penilaian_id', 'indikator.bobot_indikator', 'penilaian.nilai', 'penilaian.keterangan', 'penilaian.bukti')
                ->orderBy('indikator.id', 'asc')
                ->distinct()
                ->get();

            $indikator = Indikator::whereNotIn('id', function ($query) use ($id) {
                $query->select('indikator_id')
                    ->from('penilaian')
                    ->where('aplikasi_id', $id);
            })->orderBy('id', 'asc')->get();

            $allIndikatorOpt = Indikator::orderBy('id', 'asc')->get();
            $id_aplikasi = $id;

            return view('penilaian', compact('data', 'indikator', 'id_aplikasi', 'allIndikatorOpt'));
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_indikator' => 'required',
            'nilai' => 'required|numeric',
            // 'keterangan' => 'required',
            // 'bukti' => 'sometimes|image|mimes:jpeg,png,jpg,pdf|max:2048'
            'bukti' => 'sometimes|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ], [
            'nama_indikator.required' => 'Nama indikator wajib diisi',
            'nilai.required' => 'Nilai wajib diisi',
            'nilai.numeric' => 'Nilai wajib diisi dalam angka',
            // 'keterangan.required' => 'Keterangan wajib diisi',
            // 'bukti.image' => 'Bukti harus berupa gambar',
            'bukti.mimes' => 'Bukti harus berupa file dengan tipe: jpeg, png, jpg, pdf',
            'bukti.max' => 'Bukti tidak boleh lebih dari 2MB'
        ]);

        $penilaian = Penilaian::findOrFail($id);

        $penilaian->indikator_id = $request->input('nama_indikator');
        $penilaian->bobot = $request->input('nama_indikator');
        $penilaian->nilai = $request->input('nilai');
        $penilaian->keterangan = $request->input('keterangan_value');
        $penilaian->aplikasi_id = $request->input('aplikasi_id');

        if ($request->hasFile('bukti')) {
            // Store new file
            $file = $request->file('bukti');
            $path = 'public/bukti_pendukung';
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $penilaian->bukti = $filename;
        }

        $penilaian->save();
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function hitungKematangan(string $id)
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
        }

        $defaultDomain1 = 45.50;
        $defaultDomain2 = 16.50;

        // hitung Indeks Domain
        $indeksDomain1 = ($nilaiAspek[1] * $bobotAspek[1] + $nilaiAspek[2] * $bobotAspek[2]) / $defaultDomain1;
        $indeksDomain2 = ($nilaiAspek[3] * $bobotAspek[3] + $nilaiAspek[4] * $bobotAspek[4]) / $defaultDomain2;

        //hitung kematangan
        $indeksDomain = ($indeksDomain2 * $defaultDomain2 + $indeksDomain1 * $defaultDomain1) / 62;

        $indeksDomain = floor($indeksDomain * 100) / 100;

        // menentukan predikat
        if ($indeksDomain > 4.2) {
            $predikat = 'Memuaskan';
        } elseif ($indeksDomain > 3.5) {
            $predikat = 'Sangat Baik';
        } elseif ($indeksDomain > 2.6) {
            $predikat = 'Baik';
        } elseif ($indeksDomain > 1.8) {
            $predikat = 'Cukup';
        } else {
            $predikat = 'Kurang';
        }
        // Bulatkan nilai indeks domain ke dalam dua desimal
        $indeksDomain = floor($indeksDomain * 100) / 100;

        // update tabel aplikasi dengan menampilkan nilai kematangan dan predikat
        $aplikasi = Aplikasi::findOrFail($id);
        $aplikasi->kematangan = $indeksDomain;
        $aplikasi->predikat = $predikat;
        $aplikasi->save();

        // Redirect back to the aplikasi page after updating
        return redirect()->to('/aplikasi');
    }

    public function destroy(string $id)
    {
        Penilaian::find($id)->delete();
        return redirect()
            ->back()
            ->with('success', 'Data berhasil dihapus');
    }
}
