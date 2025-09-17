@extends('layouts.main')

@section('main-content')
<div class="dashboard-container container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h2 class="page-title">Evaluasi SPBE</h2>
            <p class="page-subtitle">Dashboard analisis penilaian dan evaluasi SPBE</p>
        </div>
        <a href="{{ url('/aplikasi') }}" class="btn-back">
            <i class="ti ti-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Main Content Cards -->
    <div class="dashboard-cards">
        <!-- Bar Chart Card -->
        <div class="chart-card">
            <div class="card-header">
                <h3>Perbandingan Nilai Indikator</h3>
                <div class="card-actions">
                    <button class="btn-action" title="Download Chart" id="downloadBarChart">
                        <i class="ti ti-download"></i>
                    </button>
                    <button class="btn-action" title="Expand" id="expandBarChart">
                        <i class="ti ti-maximize"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="dataSets" id="dataSets" value="{{ json_encode($dataSets) }}">
                <div id="{{ $dataSets['chartId'] }}" class="chart-container"></div>
            </div>
            <div class="card-footer">
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #2D62ED;"></span>
                    <span class="legend-text">Hasil Nilai</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #ed7d31;"></span>
                    <span class="legend-text">Maksimal Nilai</span>
                </div>
            </div>
        </div>

        <!-- Radar Chart Card -->
        <div class="chart-card">
            <div class="card-header">
                <h3>Evaluasi Penilaian Aspek</h3>
                <div class="card-actions">
                    <button class="btn-action" title="Download Chart" id="downloadRadarChart">
                        <i class="ti ti-download"></i>
                    </button>
                    <button class="btn-action" title="Expand" id="expandRadarChart">
                        <i class="ti ti-maximize"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="dataSets2" id="dataSets2" value="{{ json_encode($dataSets2) }}">
                <div id="{{ $dataSets2['radarId'] }}" class="chart-container radar-container"></div>
            </div>
        </div>
    </div>

    <!-- Modal for expanded charts -->
    <div class="chart-modal" id="chartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Chart View</h3>
                <button class="close-modal" id="closeModal">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="expandedChartContainer"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-container {
        padding: 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .page-subtitle {
        font-size: 0.95rem;
        color: #7f8c8d;
        margin: 0.25rem 0 0 0;
    }

    .btn-back {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        color: #e74c3c;
        border: 1px solid rgba(231, 76, 60, 0.25);
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background-color: #fee2e2;
        border-color: #e74c3c;
    }

    .btn-back i {
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .chart-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .chart-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card-header h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .card-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-action {
        background: transparent;
        border: none;
        border-radius: 6px;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7f8c8d;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        background-color: #f8f9fa;
        color: #2D62ED;
    }

    .card-body {
        padding: 1.5rem;
    }

    .chart-container {
        min-height: 380px;
        width: 100%;
    }

    .radar-container {
        min-height: 450px;
    }

    .card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        gap: 1.5rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .legend-color {
        display: block;
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }

    .legend-text {
        font-size: 0.85rem;
        color: #7f8c8d;
    }

    /* Modal styles */
    .chart-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: white;
        border-radius: 12px;
        width: 90%;
        max-width: 1200px;
        max-height: 90vh;
        overflow: hidden;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .modal-header h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }

    .close-modal {
        background: transparent;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #7f8c8d;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .close-modal:hover {
        background-color: #f8f9fa;
        color: #e74c3c;
    }

    .modal-body {
        padding: 1.5rem;
        overflow-y: auto;
        max-height: calc(90vh - 60px);
    }

    #expandedChartContainer {
        min-height: 500px;
        width: 100%;
    }

    /* Responsive adjustments */
    @media (min-width: 992px) {
        .dashboard-cards {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .btn-back {
            align-self: flex-start;
        }
    }
</style>
@endsection

@section('scripts')
<!-- Chart Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bar Chart
        renderBarChart();

        // Radar Chart
        renderRadarChart();

        // Modal functionality
        setupModalFunctionality();

        // Download functionality
        setupDownloadFunctionality();
    });

    function renderBarChart() {
        var data = JSON.parse(document.getElementById('dataSets').value);
        var chartElement = document.querySelector(`#${data.chartId}`);

        if (chartElement) {
            var options = {
                series: [{
                    name: "Hasil Nilai",
                    data: data.dataPoints,
                }, {
                    name: "Maksimal Nilai",
                    data: Array(data.dataPoints.length).fill(5),
                }],
                chart: {
                    type: "bar",
                    height: 380,
                    toolbar: {
                        show: true,
                        tools: {
                            download: false,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true
                        }
                    },
                    fontFamily: "'Poppins', sans-serif",
                    background: 'transparent',
                },
                colors: ["#2D62ED", "#ed7d31"],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "60%",
                        borderRadius: 6,
                        dataLabels: {
                            position: 'top',
                        }
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toFixed(1);
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                legend: {
                    show: false,
                },
                grid: {
                    borderColor: "rgba(0,0,0,0.08)",
                    strokeDashArray: 5,
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 10
                    },
                },
                xaxis: {
                    type: "category",
                    categories: data.dataIndikator,
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 500,
                            colors: Array(data.dataIndikator.length).fill('#6c757d')
                        },
                        rotate: -45,
                        rotateAlways: false,
                        hideOverlappingLabels: true,
                        trim: true
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    show: true,
                    min: 0,
                    max: 5,
                    tickAmount: 5,
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: ['#6c757d']
                        },
                        formatter: function(val) {
                            return val.toFixed(1);
                        }
                    }
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                tooltip: {
                    theme: "light",
                    y: {
                        formatter: function (val) {
                            return val.toFixed(2);
                        }
                    }
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: "80%"
                            }
                        },
                        xaxis: {
                            labels: {
                                rotate: -90
                            }
                        }
                    }
                }]
            };

            window.barChart = new ApexCharts(chartElement, options);
            window.barChart.render();
        } else {
            console.error('Element with id', `#${data.chartId}`, 'not found.');
        }
    }

    function renderRadarChart() {
        var data = JSON.parse(document.getElementById('dataSets2').value);
        var chartElement = document.querySelector(`#${data.radarId}`);

        if (chartElement) {
            var options = {
                series: [{
                    name: "Aspek SPBE Indeks",
                    data: data.dataAspek,
                }],
                chart: {
                    type: "radar",
                    height: 450,
                    toolbar: {
                        show: true,
                        tools: {
                            download: false,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true
                        }
                    },
                    fontFamily: "'Poppins', sans-serif",
                    dropShadow: {
                        enabled: true,
                        blur: 4,
                        opacity: 0.2
                    }
                },
                colors: ["#2D62ED"],
                fill: {
                    opacity: 0.4
                },
                markers: {
                    size: 5,
                    hover: {
                        size: 7
                    }
                },
                dataLabels: {
                    enabled: true,
                    background: {
                        enabled: true,
                        borderRadius: 3,
                        borderWidth: 1,
                        borderColor: '#2D62ED',
                        opacity: 0.9,
                    },
                    style: {
                        fontSize: '12px',
                        fontWeight: 500
                    },
                    formatter: function(val) {
                        return val.toFixed(1);
                    }
                },
                plotOptions: {
                    radar: {
                        size: 140,
                        polygons: {
                            strokeColors: 'rgba(0,0,0,0.1)',
                            strokeWidth: 1,
                            connectorColors: 'rgba(0,0,0,0.1)',
                            fill: {
                                colors: ['#f8f9fa', '#fcfcfc']
                            }
                        }
                    }
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'center',
                    fontWeight: 500,
                    fontSize: '13px',
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 100
                    },
                    itemMargin: {
                        horizontal: 15
                    }
                },
                xaxis: {
                    categories: data.aspekName,
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 500,
                            colors: Array(data.aspekName.length).fill('#6c757d')
                        }
                    }
                },
                yaxis: {
                    show: true,
                    min: 0,
                    max: 5,
                    tickAmount: 5,
                    labels: {
                        style: {
                            colors: ['#6c757d'],
                        },
                        formatter: function(val) {
                            return val.toFixed(1);
                        }
                    }
                },
                stroke: {
                    width: 2
                },
                tooltip: {
                    theme: "light",
                    y: {
                        formatter: function (val) {
                            return val.toFixed(2);
                        }
                    }
                }
            };

            window.radarChart = new ApexCharts(chartElement, options);
            window.radarChart.render();
        } else {
            console.error('Element with id', `#${data.radarId}`, 'not found.');
        }
    }

    function setupModalFunctionality() {
        const modal = document.getElementById('chartModal');
        const closeModal = document.getElementById('closeModal');
        const expandBarChart = document.getElementById('expandBarChart');
        const expandRadarChart = document.getElementById('expandRadarChart');
        const modalTitle = document.getElementById('modalTitle');
        const expandedContainer = document.getElementById('expandedChartContainer');

        // Close modal on button click
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            expandedContainer.innerHTML = '';
        });

        // Close modal when clicking outside modal content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                expandedContainer.innerHTML = '';
            }
        });

        // Bar chart expand functionality
        expandBarChart.addEventListener('click', function() {
            modalTitle.textContent = 'Perbandingan Nilai Indikator';
            modal.style.display = 'flex';

            // Clone chart options and render in modal
            var data = JSON.parse(document.getElementById('dataSets').value);
            expandedContainer.innerHTML = '';

            const barChartOptions = {...window.barChart.opts};
            barChartOptions.chart.height = 600;

            const expandedChart = new ApexCharts(expandedContainer, barChartOptions);
            expandedChart.render();
        });

        // Radar chart expand functionality
        expandRadarChart.addEventListener('click', function() {
            modalTitle.textContent = 'Evaluasi Penilaian Aspek';
            modal.style.display = 'flex';

            // Clone chart options and render in modal
            var data = JSON.parse(document.getElementById('dataSets2').value);
            expandedContainer.innerHTML = '';

            const radarChartOptions = {...window.radarChart.opts};
            radarChartOptions.chart.height = 600;

            const expandedChart = new ApexCharts(expandedContainer, radarChartOptions);
            expandedChart.render();
        });
    }

    function setupDownloadFunctionality() {
        document.getElementById('downloadBarChart').addEventListener('click', function() {
            if (window.barChart) {
                window.barChart.dataURI().then(({ imgURI, blob }) => {
                    downloadChart(imgURI, 'perbandingan-nilai-indikator.png');
                });
            }
        });

        document.getElementById('downloadRadarChart').addEventListener('click', function() {
            if (window.radarChart) {
                window.radarChart.dataURI().then(({ imgURI, blob }) => {
                    downloadChart(imgURI, 'evaluasi-penilaian-aspek.png');
                });
            }
        });

        function downloadChart(uri, filename) {
            const link = document.createElement('a');
            link.href = uri;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
</script>
@endsection
