{{-- @extends('layouts.main')

@section('main-content')
<div class="assessment-container">
    <div class="assessment-card">
        <div class="card-header">
            <h2 class="card-title">Aspek & Indikator Penilaian</h2>
            <p class="card-subtitle">Sistem Evaluasi Tingkat Kematangan SPBE</p>
        </div>

        <div class="table-container">
            <table class="assessment-table">
                <thead>
                    <tr>
                        <th class="aspect-column">Aspek</th>
                        <th class="weight-column">Bobot Aspek</th>
                        <th class="indicator-column">Indikator</th>
                        <th class="weight-column">Bobot Indikator</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aspeks as $aspek)
                        <tr class="aspect-row">
                            <td rowspan="{{ $aspek->indikator->count() + 1 }}" class="aspect-cell">
                                <div class="aspect-name">{{ $aspek->nama_aspek }}</div>
                            </td>
                            <td rowspan="{{ $aspek->indikator->count() + 1 }}" class="aspect-weight">
                                <div class="weight-badge">{{ $aspek->bobot_aspek }}</div>
                            </td>
                        </tr>
                        @foreach ($aspek->indikator as $indikator)
                            <tr class="indicator-row">
                                <td class="indicator-cell">{{ $indikator->nama_indikator }}</td>
                                <td class="indicator-weight">
                                    <div class="weight-badge indicator">{{ $indikator->bobot_indikator }}</div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .assessment-container {
        padding: 1.5rem;
        max-width: 1367px;
        margin: 0 auto;
    }

    .assessment-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #e0e7ff;
        margin: 60px 0;
    }

    .card-header {
        background: linear-gradient(135deg, #2c5eb4 0%, #1a3a8f 100%);
        padding: 1.75rem 2rem;
        position: relative;
    }

    .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b77db, #69a1fa);
    }

    .card-title {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        text-align: center;
        letter-spacing: 0.5px;
    }

    .card-subtitle {
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
        margin-top: 0.5rem;
        font-size: 0.95rem;
    }

    .table-container {
        padding: 1.5rem;
        overflow-x: auto;
    }

    .assessment-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.95rem;
    }

    .assessment-table thead tr {
        background-color: #f1f5fd;
    }

    .assessment-table th {
        padding: 1rem;
        text-align: center;
        font-weight: 600;
        color: #1a3a8f;
        border-bottom: 2px solid #d0def7;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .assessment-table td {
        padding: 1rem;
        border-bottom: 1px solid #e6edf9;
        vertical-align: middle;
    }

    .aspect-column {
        width: 25%;
    }

    .weight-column {
        width: 15%;
    }

    .indicator-column {
        width: 45%;
    }

    .aspect-row {
        background-color: rgba(240, 244, 252, 0.5);
    }

    .aspect-cell {
        border-right: 1px solid #e6edf9;
        font-weight: 600;
    }

    .aspect-name {
        padding: 0.5rem;
        color: #1a3a8f;
    }

    .weight-badge {
        display: inline-block;
        background-color: #2c5eb4;
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 500;
        min-width: 60px;
        text-align: center;
    }

    .weight-badge.indicator {
        background-color: #3b77db;
    }

    .indicator-row:hover {
        background-color: #f8faff;
    }

    .indicator-cell {
        padding-left: 1.5rem;
        color: #4a5568;
    }

    .aspect-weight, .indicator-weight {
        text-align: center;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .assessment-table {
            font-size: 0.85rem;
        }

        .assessment-table th,
        .assessment-table td {
            padding: 0.8rem;
        }
    }

    @media (max-width: 768px) {
        .card-header {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.25rem;
        }

        .table-container {
            padding: 1rem;
        }
    }
</style>
@endsection --}}



@extends('layouts.main')

@section('main-content')
<div class=" container-fluid bg-gradient-to-br from-blue-50 to-indigo-100 ">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Aspek & Indikator Penilaian</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Sistem Evaluasi Tingkat Kematangan SPBE - Framework komprehensif untuk menilai perkembangan digital
            </p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"> {{ $aspeks->count() }}
                            {{-- 0 --}}
                        </div>
                        <div class="text-sm text-gray-600">Total Aspek</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800">0 </div>
                        <div class="text-sm text-gray-600">Total Indikator</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800">100%</div>
                        <div class="text-sm text-gray-600">Total Bobot</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">Detail Aspek dan Indikator</h2>
                    <div class="flex items-center space-x-3">
                        <button class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z"></path>
                            </svg>
                            <span>Cetak</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    </svg>
                                    Aspek
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Bobot Aspek
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Indikator
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Bobot Indikator
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($aspeks as $index => $aspek)
                        <tr class="bg-blue-50/50 hover:bg-blue-100/50 transition-colors duration-200">
                            <td class="px-6 py-4 align-top" rowspan="{{ $aspek->indikator->count() + 1 }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                        {{ $index + 1 }}
                                    </div>
                                    <span class="font-semibold text-gray-800 text-lg">{{ $aspek->nama_aspek }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-top" rowspan="{{ $aspek->indikator->count() + 1 }}">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $aspek->bobot_aspek }}
                                </span>
                            </td>
                        </tr>
                        @foreach ($aspek->indikator as $indikatorIndex => $indikator)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 pl-12">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-medium text-blue-800">{{ $indikatorIndex + 1 }}</span>
                                    </div>
                                    <span class="text-gray-700">{{ $indikator->nama_indikator }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $indikator->bobot_indikator }}
                                </span>
                            </td>
                        </tr>
                        @endforeach

                        <!-- Separator -->
                        @if(!$loop->last)
                        <tr>
                            <td colspan="4" class="h-4 bg-gradient-to-r from-blue-50 to-indigo-50"></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
                    <p class="text-sm text-gray-600">
                        Menampilkan {{ $aspeks->count() }} aspek dengan total  {{-- {{ $totalIndikators }} --}} indikator
                    </p>
                    <div class="text-sm text-gray-500">
                        Terakhir diperbarui: {{ now()->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .assessment-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .assessment-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header {
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: rotate(45deg);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: rotate(45deg) translateX(-100%); }
        100% { transform: rotate(45deg) translateX(100%); }
    }

    .card-title {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-align: center;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-subtitle {
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        margin-top: 0.75rem;
        font-size: 1.1rem;
        font-weight: 400;
    }

    .table-container {
        padding: 2rem;
        overflow-x: auto;
    }

    .assessment-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.95rem;
    }

    .assessment-table thead tr {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        backdrop-filter: blur(10px);
    }

    .assessment-table th {
        padding: 1.25rem;
        text-align: left;
        font-weight: 600;
        color: #1e293b;
        border-bottom: 2px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 10;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }

    .assessment-table td {
        padding: 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        transition: all 0.2s ease;
    }

    .aspect-column {
        width: 30%;
        min-width: 250px;
    }

    .weight-column {
        width: 15%;
        min-width: 120px;
    }

    .indicator-column {
        width: 40%;
        min-width: 300px;
    }

    .aspect-row {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.03) 100%);
    }

    .aspect-cell {
        border-right: 1px solid #e2e8f0;
        font-weight: 600;
        background: rgba(248, 250, 252, 0.8);
    }

    .aspect-name {
        padding: 0.75rem;
        color: #1e293b;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .weight-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        min-width: 80px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        transition: all 0.3s ease;
    }

    .weight-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3);
    }

    .weight-badge.indicator {
        background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
    }

    .indicator-row:hover {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
        transform: translateX(4px);
    }

    .indicator-cell {
        padding-left: 2rem;
        color: #374151;
        font-size: 0.95rem;
    }

    .aspect-weight, .indicator-weight {
        text-align: center;
    }

    /* Enhanced hover effects */
    .assessment-table tr:hover td {
        background: rgba(249, 250, 251, 0.8);
    }

    /* Custom scrollbar */
    .table-container::-webkit-scrollbar {
        height: 8px;
    }

    .table-container::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .assessment-container {
            padding: 1rem;
        }

        .card-header {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.75rem;
        }

        .table-container {
            padding: 1.5rem;
        }

        .assessment-table th,
        .assessment-table td {
            padding: 1rem;
        }
    }

    @media (max-width: 768px) {
        .card-header {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .card-subtitle {
            font-size: 1rem;
        }

        .table-container {
            padding: 1rem;
        }

        .assessment-table {
            font-size: 0.85rem;
        }

        .assessment-table th,
        .assessment-table td {
            padding: 0.75rem;
        }

        .aspect-name {
            font-size: 1rem;
            padding: 0.5rem;
        }

        .weight-badge {
            min-width: 60px;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 640px) {
        .assessment-container {
            padding: 0.5rem;
        }

        .card-header {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
        }

        .table-container {
            padding: 0.75rem;
        }

        .assessment-table th,
        .assessment-table td {
            padding: 0.5rem;
        }
    }

    /* Animation for table rows */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .assessment-table tbody tr {
        animation: fadeInUp 0.5s ease-out;
        animation-fill-mode: both;
    }

    .assessment-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .assessment-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .assessment-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .assessment-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .assessment-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
</style>

<script>
    // Add subtle interactivity
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('.assessment-table tbody tr');

        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px)';
                this.style.transition = 'transform 0.2s ease';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });

        // Add print functionality
        const printButton = document.createElement('button');
        printButton.className = 'bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-all duration-200 ml-4';
        printButton.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z"></path>
            </svg>
            Cetak Laporan
        `;
        printButton.addEventListener('click', function() {
            window.print();
        });

        document.querySelector('.card-header').appendChild(printButton);
    });
</script>
@endsection
