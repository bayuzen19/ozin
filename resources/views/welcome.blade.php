@extends('layouts.main')

@section('main-content')
{{-- <div class="dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard Evaluasi SPBE</h1>
        <p class="dashboard-subtitle">Sistem Pemerintahan Berbasis Elektronik</p>
    </div>

    <!-- Stats Cards Section -->
    <div class="stats-container">
        <!-- Indikator Card -->
        <div class="stat-card indikator">
            <div class="stat-icon-container">
                <i class="ti ti-clipboard-check"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-title">Indikator</h3>
                <div class="stat-value">{{ $totalA }}</div>
                <p class="stat-desc">Total Indikator Terdaftar</p>
                <a href="/indikator" class="stat-link">
                    <span>Lihat Detail</span>
                    <i class="ti ti-arrow-narrow-right"></i>
                </a>
            </div>
        </div>

        <!-- SPBE Card -->
        <div class="stat-card spbe">
            <div class="stat-icon-container">
                <i class="ti ti-device-desktop-analytics"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-title">SPBE</h3>
                <div class="stat-value">{{ $totalB }}</div>
                <p class="stat-desc">Total Sistem Terdaftar</p>
                <a href="/aplikasi" class="stat-link">
                    <span>Lihat Detail</span>
                    <i class="ti ti-arrow-narrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Performance Card -->
        <div class="stat-card performance">
            <div class="stat-icon-container">
                <i class="ti ti-chart-pie"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-title">Kinerja</h3>
                <div class="stat-value">{{ number_format($dataSets['dataPoints'] ? array_sum($dataSets['dataPoints']) / count(array_filter($dataSets['dataPoints'])) : 0, 1) }}</div>
                <p class="stat-desc">Rata-rata Tingkat Kematangan</p>
                <a href="#chart-section" class="stat-link">
                    <span>Lihat Grafik</span>
                    <i class="ti ti-arrow-narrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <section id="chart-section" class="chart-section">
        <div class="chart-container">
            <div class="chart-header">
                <h2>Evaluasi Tingkat Kematangan SPBE</h2>
                <div class="chart-filters">
                    <select class="chart-filter">
                        <option value="all">Semua Periode</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="dataSets" id="dataSets" value="{{ json_encode($dataSets) }}">

            <div class="chart-wrapper">
                <div id="{{ $dataSets['chartId'] }}"></div>
            </div>

            <div class="chart-legend">
                <div class="legend-item">
                    <span class="color-dot level-1"></span>
                    <span>Level 1: Informasional</span>
                </div>
                <div class="legend-item">
                    <span class="color-dot level-2"></span>
                    <span>Level 2: Terstruktur</span>
                </div>
                <div class="legend-item">
                    <span class="color-dot level-3"></span>
                    <span>Level 3: Terintegrasi</span>
                </div>
                <div class="legend-item">
                    <span class="color-dot level-4"></span>
                    <span>Level 4: Terkelola</span>
                </div>
                <div class="legend-item">
                    <span class="color-dot level-5"></span>
                    <span>Level 5: Optimum</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Summary Section -->
    <section class="summary-section">
        <div class="summary-header">
            <h2>Ringkasan Status SPBE</h2>
        </div>

        <div class="summary-cards">
            <div class="status-card level-excellent">
                <div class="status-icon">
                    <i class="ti ti-award"></i>
                </div>
                <div class="status-content">
                    <h3>Optimum</h3>
                    <div class="status-count">{{ count(array_filter($dataSets['dataPoints'], function($x) { return $x >= 4.5; })) }}</div>
                </div>
            </div>

            <div class="status-card level-good">
                <div class="status-icon">
                    <i class="ti ti-thumb-up"></i>
                </div>
                <div class="status-content">
                    <h3>Baik</h3>
                    <div class="status-count">{{ count(array_filter($dataSets['dataPoints'], function($x) { return $x >= 3.5 && $x < 4.5; })) }}</div>
                </div>
            </div>

            <div class="status-card level-average">
                <div class="status-icon">
                    <i class="ti ti-arrows-horizontal"></i>
                </div>
                <div class="status-content">
                    <h3>Cukup</h3>
                    <div class="status-count">{{ count(array_filter($dataSets['dataPoints'], function($x) { return $x >= 2.5 && $x < 3.5; })) }}</div>
                </div>
            </div>

            <div class="status-card level-low">
                <div class="status-icon">
                    <i class="ti ti-alert-triangle"></i>
                </div>
                <div class="status-content">
                    <h3>Perlu Perhatian</h3>
                    <div class="status-count">{{ count(array_filter($dataSets['dataPoints'], function($x) { return $x < 2.5; })) }}</div>
                </div>
            </div>
        </div>
    </section>
</div> --}}
<div class="min-h-screen bg-gray-50 container-fluid">
    <!-- Header -->
    <header class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Evaluasi SPBE</h1>
        <p class="text-gray-500">Sistem Pemerintahan Berbasis Elektronik</p>
    </header>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        <!-- Indikator -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:shadow-xl transition">
            <div class="bg-blue-100 p-4 rounded-full mb-4">
                <i class="ti ti-clipboard-check text-blue-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-700">Indikator</h3>
            <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalA }}</div>
            <p class="text-gray-500 text-sm">Total Indikator Terdaftar</p>
            <a href="/indikator" class="mt-3 inline-flex items-center text-blue-600 hover:underline">
                Lihat Detail <i class="ti ti-arrow-narrow-right ml-1"></i>
            </a>
        </div>

        <!-- SPBE -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:shadow-xl transition">
            <div class="bg-green-100 p-4 rounded-full mb-4">
                <i class="ti ti-device-desktop-analytics text-green-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-700">SPBE</h3>
            <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalB }}</div>
            <p class="text-gray-500 text-sm">Total Sistem Terdaftar</p>
            <a href="/aplikasi" class="mt-3 inline-flex items-center text-green-600 hover:underline">
                Lihat Detail <i class="ti ti-arrow-narrow-right ml-1"></i>
            </a>
        </div>

        <!-- Performance -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center hover:shadow-xl transition">
            <div class="bg-purple-100 p-4 rounded-full mb-4">
                <i class="ti ti-chart-pie text-purple-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-700">Kinerja</h3>
            <div class="text-3xl font-bold text-gray-800 mt-2">
                {{ number_format($dataSets['dataPoints'] ? array_sum($dataSets['dataPoints']) / count(array_filter($dataSets['dataPoints'])) : 0, 1) }}
            </div>
            <p class="text-gray-500 text-sm">Rata-rata Tingkat Kematangan</p>
            <a href="#chart-section" class="mt-3 inline-flex items-center text-purple-600 hover:underline">
                Lihat Grafik <i class="ti ti-arrow-narrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Chart Section -->
    <section id="chart-section" class="bg-white shadow-lg rounded-2xl p-6 mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Evaluasi Tingkat Kematangan SPBE</h2>
            <select class="border rounded-lg px-3 py-2 text-gray-600">
                <option value="all">Semua Periode</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
        </div>
        <input type="hidden" name="dataSets" id="dataSets" value="{{ json_encode($dataSets) }}">
        <div class="w-full h-80" id="{{ $dataSets['chartId'] }}"></div>
        <!-- Legend -->
        <div class="flex flex-wrap gap-4 mt-6 text-sm text-gray-600">
            <div class="flex items-center gap-2"><span class="w-3 h-3 bg-red-400 rounded-full"></span> Level 1: Informasional</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 bg-orange-400 rounded-full"></span> Level 2: Terstruktur</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 bg-yellow-400 rounded-full"></span> Level 3: Terintegrasi</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 bg-green-400 rounded-full"></span> Level 4: Terkelola</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 bg-blue-500 rounded-full"></span> Level 5: Optimum</div>
        </div>
    </section>

    <!-- Summary -->
    <section class="mb-12">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Status SPBE</h2>
        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
                <i class="ti ti-award text-yellow-500 text-3xl mb-3"></i>
                <h3 class="font-semibold text-gray-700">Optimum</h3>
                <div class="text-2xl font-bold text-gray-800">
                    {{ count(array_filter($dataSets['dataPoints'], fn($x) => $x >= 4.5)) }}
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
                <i class="ti ti-thumb-up text-green-500 text-3xl mb-3"></i>
                <h3 class="font-semibold text-gray-700">Baik</h3>
                <div class="text-2xl font-bold text-gray-800">
                    {{ count(array_filter($dataSets['dataPoints'], fn($x) => $x >= 3.5 && $x < 4.5)) }}
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
                <i class="ti ti-arrows-horizontal text-blue-500 text-3xl mb-3"></i>
                <h3 class="font-semibold text-gray-700">Cukup</h3>
                <div class="text-2xl font-bold text-gray-800">
                    {{ count(array_filter($dataSets['dataPoints'], fn($x) => $x >= 2.5 && $x < 3.5)) }}
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
                <i class="ti ti-alert-triangle text-red-500 text-3xl mb-3"></i>
                <h3 class="font-semibold text-gray-700">Perlu Perhatian</h3>
                <div class="text-2xl font-bold text-gray-800">
                    {{ count(array_filter($dataSets['dataPoints'], fn($x) => $x < 2.5)) }}
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    /* Dashboard Layout */
    .dashboard-container {
        padding: 2rem;
        background-color: #f8fafc;
        min-height: 100vh;
        /* margin-top: 1000px; */
    }

    /* Header Section */
    .dashboard-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e4e9f2;
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
        margin-top: 50px;
    }

    .dashboard-subtitle {
        color: #718096;
        font-size: 1rem;
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        display: flex;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
    }

    .stat-card.indikator::before {
        background: linear-gradient(to bottom, #8854d0, #a55eea);
    }

    .stat-card.spbe::before {
        background: linear-gradient(to bottom, #f9a825, #ffc107);
    }

    .stat-card.performance::before {
        background: linear-gradient(to bottom, #00b894, #55efc4);
    }

    .stat-icon-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        border-radius: 16px;
        margin-right: 1.5rem;
        font-size: 26px;
    }

    .stat-card.indikator .stat-icon-container {
        background-color: rgba(165, 94, 234, 0.1);
        color: #8854d0;
    }

    .stat-card.spbe .stat-icon-container {
        background-color: rgba(255, 193, 7, 0.1);
        color: #f9a825;
    }

    .stat-card.performance .stat-icon-container {
        background-color: rgba(0, 184, 148, 0.1);
        color: #00b894;
    }

    .stat-content {
        flex: 1;
    }

    .stat-title {
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #718096;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #2d3748;
    }

    .stat-desc {
        font-size: 0.875rem;
        color: #718096;
        margin-bottom: 1rem;
    }

    .stat-link {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        margin-top: 0.5rem;
    }

    .stat-card.indikator .stat-link {
        color: #8854d0;
    }

    .stat-card.spbe .stat-link {
        color: #f9a825;
    }

    .stat-card.performance .stat-link {
        color: #00b894;
    }

    .stat-link i {
        margin-left: 0.5rem;
        transition: transform 0.2s ease;
    }

    .stat-link:hover i {
        transform: translateX(3px);
    }

    /* Chart Section */
    .chart-section {
        margin-bottom: 2.5rem;
    }

    .chart-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .chart-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .chart-filters {
        display: flex;
        gap: 1rem;
    }

    .chart-filter {
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background-color: white;
        color: #4a5568;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .chart-filter:hover {
        border-color: #cbd5e0;
    }

    .chart-wrapper {
        height: 400px;
        margin-bottom: 1.5rem;
    }

    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
        margin-top: 1rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #4a5568;
    }

    .color-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }

    .color-dot.level-1 {
        background-color: #ff6b6b;
    }

    .color-dot.level-2 {
        background-color: #feca57;
    }

    .color-dot.level-3 {
        background-color: #54a0ff;
    }

    .color-dot.level-4 {
        background-color: #5f27cd;
    }

    .color-dot.level-5 {
        background-color: #00b894;
    }

    /* Summary Section */
    .summary-section {
        margin-bottom: 2.5rem;
    }

    .summary-header {
        margin-bottom: 1.5rem;
    }

    .summary-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .status-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .status-card:hover {
        transform: translateY(-4px);
    }

    .status-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        margin-right: 1rem;
        font-size: 20px;
    }

    .status-card.level-excellent .status-icon {
        background-color: rgba(0, 184, 148, 0.1);
        color: #00b894;
    }

    .status-card.level-good .status-icon {
        background-color: rgba(95, 39, 205, 0.1);
        color: #5f27cd;
    }

    .status-card.level-average .status-icon {
        background-color: rgba(84, 160, 255, 0.1);
        color: #54a0ff;
    }

    .status-card.level-low .status-icon {
        background-color: rgba(255, 107, 107, 0.1);
        color: #ff6b6b;
    }

    .status-content h3 {
        font-size: 0.875rem;
        font-weight: 600;
        color: #4a5568;
        margin: 0 0 0.25rem;
    }

    .status-count {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }

        .summary-cards {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .chart-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let dataSets = JSON.parse(document.getElementById('dataSets').value);

            // Define custom colors
            const colors = ['#ff6b6b', '#feca57', '#54a0ff', '#5f27cd', '#00b894'];

            // Create gradient for bars
            function getGradient(ctx, chartArea, index) {
                const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                gradient.addColorStop(0, colors[index % colors.length]);
                gradient.addColorStop(1, shadeColor(colors[index % colors.length], 20));
                return gradient;
            }

            // Function to shade a color
            function shadeColor(color, percent) {
                let R = parseInt(color.substring(1, 3), 16);
                let G = parseInt(color.substring(3, 5), 16);
                let B = parseInt(color.substring(5, 7), 16);

                R = parseInt(R * (100 + percent) / 100);
                G = parseInt(G * (100 + percent) / 100);
                B = parseInt(B * (100 + percent) / 100);

                R = (R < 255) ? R : 255;
                G = (G < 255) ? G : 255;
                B = (B < 255) ? B : 255;

                const RR = ((R.toString(16).length === 1) ? "0" + R.toString(16) : R.toString(16));
                const GG = ((G.toString(16).length === 1) ? "0" + G.toString(16) : G.toString(16));
                const BB = ((B.toString(16).length === 1) ? "0" + B.toString(16) : B.toString(16));

                return "#" + RR + GG + BB;
            }

            let options = {
                chart: {
                    type: 'bar',
                    height: 400,
                    fontFamily: 'Segoe UI, Roboto, sans-serif',
                    toolbar: {
                        show: true,
                        tools: {
                            download: true,
                            selection: false,
                            zoom: false,
                            zoomin: false,
                            zoomout: false,
                            pan: false,
                            reset: false
                        }
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        columnWidth: '60%',
                        distributed: true,
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(1);
                    },
                    style: {
                        fontSize: '12px',
                        colors: ['#1e293b']
                    },
                    offsetY: -20
                },
                colors: colors,
                series: [{
                    name: 'Tingkat Kematangan',
                    data: dataSets.dataPoints
                }],
                xaxis: {
                    categories: dataSets.dataNames,
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 500
                        },
                        rotate: -45,
                        rotateAlways: false
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    min: 0,
                    max: 5,
                    tickAmount: 5,
                    labels: {
                        formatter: function(val) {
                            return val.toFixed(1);
                        }
                    },
                    title: {
                        text: 'Tingkat Kematangan',
                        style: {
                            fontSize: '14px',
                            fontWeight: 500
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f1f1',
                    row: {
                        colors: ['#f8f9fa', 'transparent'],
                        opacity: 0.5
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val.toFixed(2) + ' - ' + getMaturityLevel(val);
                        }
                    }
                }
            };

            let chart = new ApexCharts(document.querySelector("#" + dataSets.chartId), options);
            chart.render();

            // Function to determine maturity level text
            function getMaturityLevel(value) {
                if (value >= 4.5) return 'Optimum';
                if (value >= 3.5) return 'Terkelola';
                if (value >= 2.5) return 'Terintegrasi';
                if (value >= 1.5) return 'Terstruktur';
                return 'Informasional';
            }

            // Add some interactivity to the cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection
