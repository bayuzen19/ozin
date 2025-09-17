<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Indikator;
use App\Models\Aplikasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (session()->missing('username')) {
            return view('auth.login');
        } else {
            $totalA = Indikator::count();
            $totalB = Aplikasi::count();

            $aplikasi = Aplikasi::all();
            $dataPoints = [];
            $dataNames = [];

            foreach ($aplikasi as $value) {
                $dataPoints[] = $value->kematangan;
                $dataNames[] = substr($value->nama_aplikasi, 0, 12);
            }

            $dataSets = [
                'chartId' => 'chart1',
                'dataPoints' => $dataPoints,
                'dataNames' => $dataNames,
            ];

            return view('welcome', compact('totalA', 'totalB', 'dataSets', 'aplikasi'));
        }
    }
}
