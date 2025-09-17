@extends('layouts.main')

@section('main-content')
{{-- <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient-primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="card-title text-white mb-0 fw-bold">Aspek dan Indikator</h2>
                        <div class="header-actions">
                            <button class="btn btn-light btn-sm px-3" id="printBtn">
                                <i class="ti ti-printer me-1"></i> Cetak
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 ps-4" style="width: 30%">Aspek</th>
                                    <th class="border-0 text-center" style="width: 15%">Bobot Aspek</th>
                                    <th class="border-0 ps-4" style="width: 40%">Indikator</th>
                                    <th class="border-0 text-center" style="width: 15%">Bobot Indikator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aspeks as $aspek)
                                    <tr class="aspek-row">
                                        <td class="ps-4 align-middle fw-semibold bg-light-subtle" rowspan="{{ $aspek->indikator->count() }}">
                                            <div class="d-flex align-items-center">
                                                <div class="aspek-icon me-3">
                                                    <span class="badge rounded-circle bg-primary p-2">
                                                        <i class="ti ti-folder"></i>
                                                    </span>
                                                </div>
                                                <span>{{ $aspek->nama_aspek }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle fw-semibold bg-light-subtle" rowspan="{{ $aspek->indikator->count() }}">
                                            <span class="badge bg-primary rounded-pill px-3 py-2">{{ $aspek->bobot_aspek }}</span>
                                        </td>

                                        @if($aspek->indikator->count() > 0)
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="indicator-icon me-2">
                                                        <i class="ti ti-arrow-right text-primary"></i>
                                                    </div>
                                                    <span>{{ $aspek->indikator[0]->nama_indikator }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $aspek->indikator[0]->bobot_indikator }}</span>
                                            </td>
                                        @else
                                            <td colspan="2" class="text-center text-muted">Tidak ada indikator</td>
                                        @endif
                                    </tr>

                                    @for($i = 1; $i < $aspek->indikator->count(); $i++)
                                        <tr>
                                            <td class="ps-4 border-start border-light-subtle">
                                                <div class="d-flex align-items-center">
                                                    <div class="indicator-icon me-2">
                                                        <i class="ti ti-arrow-right text-primary"></i>
                                                    </div>
                                                    <span>{{ $aspek->indikator[$i]->nama_indikator }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $aspek->indikator[$i]->bobot_indikator }}</span>
                                            </td>
                                        </tr>
                                    @endfor

                                    <!-- Separator row -->
                                    <tr class="separator-row">
                                        <td colspan="4" class="p-0">
                                            <div class="separator"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="summary">
                            <p class="mb-0 text-muted">Total Aspek: <span class="fw-semibold">{{ $aspeks->count() }}</span></p>
                        </div>
                        <div class="pagination-info text-muted small">
                            <span>Menampilkan {{ $aspeks->count() }} aspek</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="card-header bg-primary bg-gradient py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h5 text-white mb-0 fw-bold">
                            <i class="ti ti-layers-intersect me-2"></i> Aspek dan Indikator
                        </h2>
                        <button class="btn btn-light btn-sm px-3 shadow-sm" id="printBtn">
                            <i class="ti ti-printer me-1"></i> Cetak
                        </button>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless mb-0">
                            <thead class="bg-light text-secondary small text-uppercase">
                                <tr>
                                    <th class="ps-4" style="width: 30%">Aspek</th>
                                    <th class="text-center" style="width: 15%">Bobot Aspek</th>
                                    <th style="width: 40%">Indikator</th>
                                    <th class="text-center" style="width: 15%">Bobot Indikator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aspeks as $aspek)
                                    <tr class="bg-light-subtle">
                                        <td class="ps-4 align-middle fw-semibold" rowspan="{{ $aspek->indikator->count() }}">
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-gradient-primary p-3 rounded-circle me-3 shadow-sm">
                                                    <i class="ti ti-folder text-white"></i>
                                                </span>
                                                {{ $aspek->nama_aspek }}
                                            </div>
                                        </td>
                                        <td class="text-center align-middle fw-semibold" rowspan="{{ $aspek->indikator->count() }}">
                                            <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm">
                                                {{ $aspek->bobot_aspek }}
                                            </span>
                                        </td>

                                        @if($aspek->indikator->count() > 0)
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-chevron-right text-primary me-2"></i>
                                                    {{ $aspek->indikator[0]->nama_indikator }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                                    {{ $aspek->indikator[0]->bobot_indikator }}
                                                </span>
                                            </td>
                                        @else
                                            <td colspan="2" class="text-center text-muted fst-italic">Tidak ada indikator</td>
                                        @endif
                                    </tr>

                                    @for($i = 1; $i < $aspek->indikator->count(); $i++)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-chevron-right text-primary me-2"></i>
                                                    {{ $aspek->indikator[$i]->nama_indikator }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                                    {{ $aspek->indikator[$i]->bobot_indikator }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endfor

                                    <!-- Separator -->
                                    <tr class="bg-transparent">
                                        <td colspan="4" class="py-2"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center">
                    <span class="text-muted small">
                        Total Aspek: <span class="fw-semibold">{{ $aspeks->count() }}</span>
                    </span>
                    <span class="text-muted small">
                        Menampilkan {{ $aspeks->count() }} aspek
                    </span>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspek dan Indikator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .table-row-hover:hover {
            background: linear-gradient(90deg, rgba(79, 70, 229, 0.05) 0%, rgba(124, 58, 237, 0.03) 100%);
        }

        .badge-primary {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }

        .badge-secondary {
            background: linear-gradient(135deg, #6B7280 0%, #9CA3AF 100%);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .print-only {
            display: none;
        }

        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .glass-card {
                background: white !important;
                box-shadow: none !important;
            }
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            table {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Header Card -->
        <div class="glass-card mb-8 fade-in">
            <div class="gradient-bg text-white p-6 rounded-t-2xl">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-4">
                            <i class="fas fa-layer-group text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">Aspek dan Indikator</h1>
                            <p class="text-blue-100 text-sm mt-1">Manajemen Bobot dan Kriteria Penilaian</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="window.print()" class="no-print bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-print"></i>
                            Cetak Laporan
                        </button>
                        <button onclick="exportToExcel()" class="no-print bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-file-excel"></i>
                            Export Excel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 bg-gray-50">
                <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                    <div class="text-3xl font-bold text-indigo-600">5</div>
                    <div class="text-gray-600 text-sm">Total Aspek</div>
                </div>
                <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                    <div class="text-3xl font-bold text-purple-600">18</div>
                    <div class="text-gray-600 text-sm">Total Indikator</div>
                </div>
                <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                    <div class="text-3xl font-bold text-blue-600">100%</div>
                    <div class="text-gray-600 text-sm">Total Bobot</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="glass-card overflow-hidden fade-in" style="animation-delay: 0.2s;">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="gradient-bg text-white">
                            <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-folder mr-2"></i>
                                    Aspek
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center font-semibold text-sm uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-weight-hanging mr-2"></i>
                                    Bobot Aspek
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-list-alt mr-2"></i>
                                    Indikator
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center font-semibold text-sm uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <i class="fas fa-calculator mr-2"></i>
                                    Bobot Indikator
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Aspek 1 -->
                        <tr class="table-row-hover">
                            <td class="px-6 py-4 align-top bg-indigo-50" rowspan="3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white mr-3">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <span class="font-semibold text-indigo-800">Kinerja Keuangan</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-top bg-indigo-50" rowspan="3">
                                <span class="badge-primary text-white px-3 py-2 rounded-full text-sm font-semibold">35%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-arrow-right text-indigo-500 mr-2"></i>
                                    <span>Rasio Profitabilitas</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge-secondary text-white px-3 py-1 rounded-full text-xs font-medium">15%</span>
                            </td>
                        </tr>
                        <tr class="table-row-hover">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-arrow-right text-indigo-500 mr-2"></i>
                                    <span>Laporan Arus Kas</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge-secondary text-white px-3 py-1 rounded-full text-xs font-medium">10%</span>
                            </td>
                        </tr>
                        <tr class="table-row-hover">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-arrow-right text-indigo-500 mr-2"></i>
                                    <span>Pengelolaan Utang</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge-secondary text-white px-3 py-1 rounded-full text-xs font-medium">10%</span>
                            </td>
                        </tr>

                        <!-- Separator -->
                        <tr>
                            <td colspan="4" class="h-4 bg-gradient-to-r from-indigo-100 to-purple-100"></td>
                        </tr>

                        <!-- Aspek 2 -->
                        <tr class="table-row-hover">
                            <td class="px-6 py-4 align-top bg-purple-50" rowspan="3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white mr-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <span class="font-semibold text-purple-800">Sumber Daya Manusia</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-top bg-purple-50" rowspan="3">
                                <span class="badge-primary text-white px-3 py-2 rounded-full text-sm font-semibold">25%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-arrow-right text-purple-500 mr-2"></i>
                                    <span>Produktivitas Karyawan</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge-secondary text-white px-3 py-1 rounded-full text-xs font-medium">10%</span>
                            </td>
                        </tr>
                        <tr class="table-row-hover">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-arrow-right text-purple-500 mr-2"></i>
                                    <span>Retention Rate</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge-secondary text-white px-3 py-1 rounded-full text-xs font-medium">8%</span>
                            </td>
                        </tr>
                        <tr class="table-row-hover">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i class="fas fa-arrow-right text-purple-500 mr-2"></i>
                                    <span>Program Pelatihan</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge-secondary text-white px-3 py-1 rounded-full text-xs font-medium">7%</span>
                            </td>
                        </tr>

                        <!-- Separator -->
                        <tr>
                            <td colspan="4" class="h-4 bg-gradient-to-r from-purple-100 to-blue-100"></td>
                        </tr>

                        <!-- More aspeks would continue here... -->
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Total: 5 Aspek • 18 Indikator
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2 text-green-500"></i>
                        Terakhir diperbarui: 20 Des 2024
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Header (hidden until print) -->
        <div class="print-only text-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Laporan Aspek dan Indikator</h1>
            <p class="text-gray-600">Dibuat pada: 20 Desember 2024</p>
        </div>
    </div>

    <script>
        function exportToExcel() {
            // Simulasi export Excel
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            toast.innerHTML = '<div class="flex items-center gap-2"><i class="fas fa-check-circle"></i> Data berhasil diexport ke Excel</div>';
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Add subtle animations
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('fade-in');
            });
        });
    </script>
</body>
</html>



{{-- <style>
    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        padding: 1.25rem 1.5rem;
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, #2c5eb4, #4a7bcb);
    }

    .table th {
        font-weight: 600;
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-top: none;
    }

    .table td {
        padding-top: 1rem;
        padding-bottom: 1rem;
        vertical-align: middle;
    }

    .aspek-row td {
        border-top: none;
    }

    .separator {
        height: 1px;
        background: #e9ecef;
        margin: 0.25rem 0;
    }

    .separator-row td {
        padding: 0.5rem 0;
    }

    .badge.rounded-pill {
        font-weight: 500;
        font-size: 0.85rem;
    }

    .aspek-icon, .indicator-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-footer {
        border-top: 1px solid #e9ecef;
    }

    @media (max-width: 768px) {
        .table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }
</style> --}}

<script>
    // Print functionality
    document.getElementById('printBtn').addEventListener('click', function() {
        window.print();
    });
</script>
@endsection
