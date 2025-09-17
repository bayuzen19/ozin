@extends('layouts.main')

@section('main-content')
{{-- <div class="spbe-dashboard container-fluid">
    <div class="dashboard-header">
        <div class="title-container">
            <h1 class="dashboard-title">Sistem Pemerintahan Berbasis Elektronik</h1>
            <div class="title-decoration"></div>
        </div>

        @if (implode(' ', Session::get('role')) == 'admin')
            <button onclick="<?php //session()->forget('nama_aplikasi'); session()->forget('deskripsi'); ?>"
                type="button" class="btn-add-data" data-bs-toggle="modal" data-bs-target="#modalTambahAplikasi">
                <i class="ti ti-plus"></i> Tambah Data
            </button>
        @endif
    </div>

    <!-- Alert Messages -->
    <div class="alert-container">
        @if ($errors->any())
            <div class="alert-card alert-danger">
                <div class="alert-content">
                    <i class="ti ti-alert-circle alert-icon"></i>
                    <div class="alert-text">
                        @foreach ($errors->all() as $item)
                            <p>{{ $item }}</p>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        @if (Session::get('success'))
            <div class="alert-card alert-success">
                <div class="alert-content">
                    <i class="ti ti-check-circle alert-icon"></i>
                    <div class="alert-text">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Main Content Card -->
    <div class="content-card">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>SPBE</th>
                        <th>Deskripsi</th>
                        <th>Tingkat Kematangan</th>
                        <th>Predikat</th>
                        <th>Tanggal Penilaian</th>
                        <th width="70px">Laporan</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aplikasi as $apk)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $apk->nama_aplikasi }}</td>
                            <td>{{ $apk->deskripsi }}</td>
                            <td class="text-center">
                                @if($apk->kematangan)
                                    <div class="maturity-badge">{{ $apk->kematangan }}</div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if($apk->predikat)
                                    <div class="predicate-badge">{{ $apk->predikat }}</div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $apk->updated_at ? \Carbon\Carbon::parse($apk->updated_at)->translatedFormat('d F Y') : '-' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ url("/laporan/view/pdf/$apk->id") }}" class="action-btn report-btn" target="_blank">
                                    <i class="ti ti-file"></i>
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if ((implode(' ', Session::get('role')) == 'admin'))
                                        <a href="{{ url("/penilaian/$apk->id") }}" class="action-btn assess-btn" title="Penilaian">
                                            <i class="ti ti-check"></i>
                                        </a>
                                    @endif

                                    @if ($apk->kematangan)
                                        <a href="{{ url("/chart/$apk->id") }}" class="action-btn chart-btn" title="Lihat Chart">
                                            <i class="ti ti-chart-bar"></i>
                                        </a>
                                    @endif

                                    @if (implode(' ', Session::get('role')) == 'admin')
                                        <button type="button" class="action-btn edit-btn" title="Edit" data-bs-toggle="modal"
                                            data-bs-target="#modalEditAplikasi{{ $apk->id }}">
                                            <i class="ti ti-edit"></i>
                                        </button>

                                        <form action="{{ url("/aplikasi/$apk->id") }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="action-btn delete-btn" title="Hapus"
                                                onclick="confirmDelete(this.parentElement)">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-data">
                                <div class="empty-state">
                                    <i class="ti ti-database-off empty-icon"></i>
                                    <p>Belum ada data penilaian.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
<div class="spbe-dashboard container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-s mb-1 dashboard-title">Manajemen SPBE</h2>
            <p class="text-muted">Kelola data Sistem Pemerintahan Berbasis Elektronik</p>
        </div>
        @if (implode(' ', Session::get('role')) == 'admin')
            <button class="btn btn-gradient btn-sm px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAplikasi">
                <i class="ti ti-plus me-1"></i> Tambah Data
            </button>
        @endif
        {{-- @if (implode(' ', Session::get('role')) == 'admin')
            <button onclick="<?php session()->forget('nama_aplikasi'); session()->forget('deskripsi'); ?>"
                type="button" class="btn-add-data" data-bs-toggle="modal" data-bs-target="#modalTambahAplikasi">
                <i class="ti ti-plus"></i> Tambah Data
            </button>
        @endif --}}
    </div>

    <!-- Alert -->
    <div class="mb-3">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <i class="ti ti-alert-circle me-2"></i>
                @foreach ($errors->all() as $item)
                    <span>{{ $item }}</span><br>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <i class="ti ti-check-circle me-2"></i>
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Data Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th>SPBE</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Kematangan</th>
                            <th class="text-center">Predikat</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Laporan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aplikasi as $apk)
                            <tr>
                                <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $apk->nama_aplikasi }}</td>
                                <td class="text-muted">{{ Str::limit($apk->deskripsi, 50) }}</td>
                                <td class="text-center">
                                    @if($apk->kematangan)
                                        <span class="badge bg-info px-3 py-2 rounded-pill shadow-sm">{{ $apk->kematangan }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($apk->predikat)
                                        <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">{{ $apk->predikat }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted">
                                    {{ $apk->updated_at ? \Carbon\Carbon::parse($apk->updated_at)->translatedFormat('d M Y') : '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ url("/laporan/view/pdf/$apk->id") }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle">
                                        <i class="ti ti-file"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if ((implode(' ', Session::get('role')) == 'admin'))
                                            <a href="{{ url("/penilaian/$apk->id") }}" class="btn btn-outline-success btn-sm rounded-circle" title="Penilaian">
                                                <i class="ti ti-check"></i>
                                            </a>
                                        @endif

                                        @if ($apk->kematangan)
                                            <a href="{{ url("/chart/$apk->id") }}" class="btn btn-outline-info btn-sm rounded-circle" title="Chart">
                                                <i class="ti ti-chart-bar"></i>
                                            </a>
                                        @endif

                                        @if (implode(' ', Session::get('role')) == 'admin')
                                            <button type="button" class="btn btn-outline-warning btn-sm rounded-circle" data-bs-toggle="modal"
                                                data-bs-target="#modalEditAplikasi{{ $apk->id }}">
                                                <i class="ti ti-edit"></i>
                                            </button>

                                            <form action="{{ url("/aplikasi/$apk->id") }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger btn-sm rounded-circle"
                                                    onclick="confirmDelete(this.parentElement)">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="ti ti-database-off fs-1 text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data SPBE</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
{{-- <div class="modal fade" id="modalTambahAplikasi" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <i class="ti ti-plus-circle"></i> Form Tambah SPBE
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('/aplikasi') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_aplikasi" class="form-label">SPBE</label>
                        <input type="text" class="form-control" name='nama_aplikasi' id="nama_aplikasi"
                            value="{{ Session::get('nama_aplikasi') }}" placeholder="Masukkan nama SPBE">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4"
                            placeholder="Masukkan deskripsi SPBE">{{ Session::get('deskripsi') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">
                        <i class="ti ti-x"></i> Batal
                    </button>
                    <button type="submit" class="btn-save">
                        <i class="ti ti-device-floppy"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="modalTambahAplikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-lg shadow-lg">
            <div class="modal-header bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="ti ti-plus-circle me-2"></i> Form Tambah SPBE
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ url('/aplikasi') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_aplikasi" class="form-label">SPBE</label>
                        <input type="text" class="form-control" name='nama_aplikasi' id="nama_aplikasi" value="{{ Session::get('nama_aplikasi') }}" placeholder="Masukkan nama SPBE" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" placeholder="Masukkan deskripsi SPBE" required>{{ Session::get('deskripsi') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <style>
    .modal-content {
        border-radius: 1rem;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
    }

    .form-control {
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #4F46E5;
        border-color: #4F46E5;
    }

    .btn-primary:hover {
        background-color: #4338CA;
        border-color: #4338CA;
    }

    .btn-secondary {
        background-color: #E5E7EB;
        border-color: #E5E7EB;
        color: #1F2937;
    }

    .btn-secondary:hover {
        background-color: #D1D5DB;
        border-color: #D1D5DB;
    }
</style> --}}
<!-- Modal Edit -->
@foreach ($aplikasi as $apk)
    <div class="modal fade" id="modalEditAplikasi{{ $apk->id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <i class="ti ti-edit-circle"></i> Form Edit SPBE
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ url("/aplikasi/$apk->id") }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_aplikasi" class="form-label">SPBE</label>
                            <input type="text" class="form-control" name='nama_aplikasi' id="nama_aplikasi"
                                value="{{ $apk->nama_aplikasi }}" placeholder="Masukkan nama SPBE">
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name='deskripsi' id="deskripsi" rows="4"
                                placeholder="Masukkan deskripsi SPBE">{{ $apk->deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">
                            <i class="ti ti-x"></i> Batal
                        </button>
                        <button type="submit" class="btn-save">
                            <i class="ti ti-device-floppy"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<style>


/* <style> */
    .modal-content {
        border-radius: 1rem;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #dddfe0
    }

    .form-label {
        font-weight: 500;
    }

    .form-control {
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #4F46E5;
        border-color: #4F46E5;
    }

    .btn-primary:hover {
        background-color: #4338CA;
        border-color: #4338CA;
    }

    .btn-secondary {
        background-color: #E5E7EB;
        border-color: #E5E7EB;
        color: #1F2937;
    }

    .btn-secondary:hover {
        background-color: #D1D5DB;
        border-color: #D1D5DB;
    }
    .spbe-dashboard {
        max-width: 1366px;
        margin: 0 auto;
        padding: 24px;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .title-container {
        position: relative;
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        position: relative;
        display: inline-block;
    }

    .title-decoration {
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #2c5eb4, #4a7dce);
        border-radius: 2px;
        margin-top: 8px;
    }

    .btn-add-data {
        background: linear-gradient(45deg, #2c5eb4, #5683d0);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 10px rgba(44, 94, 180, 0.2);
        transition: all 0.2s ease;
    }

    .btn-add-data:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(44, 94, 180, 0.3);
    }

    .alert-container {
        margin-bottom: 20px;
    }

    .alert-card {
        border-radius: 10px;
        padding: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 16px;
    }

    .alert-danger {
        background-color: #fff5f5;
        border-left: 4px solid #ff5252;
    }

    .alert-success {
        background-color: #f0fff4;
        border-left: 4px solid #48bb78;
    }

    .alert-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .alert-icon {
        font-size: 1.5rem;
    }

    .alert-danger .alert-icon {
        color: #ff5252;
    }

    .alert-success .alert-icon {
        color: #48bb78;
    }

    .alert-text p {
        margin: 0;
        font-size: 14px;
    }

    .alert-close {
        background: none;
        border: none;
        color: #718096;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
        border-radius: 50%;
        transition: all 0.2s;
    }

    .alert-close:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .content-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table th {
        background: #f8fafc;
        color: #4a5568;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        padding: 16px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
        position: sticky;
        top: 0;
    }

    .data-table tbody tr {
        transition: all 0.2s;
    }

    .data-table tbody tr:hover {
        background-color: #f7faff;
    }

    .data-table td {
        padding: 16px;
        border-bottom: 1px solid #edf2f7;
        color: #4a5568;
        font-size: 14px;
    }

    .maturity-badge, .predicate-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .maturity-badge {
        background-color: #ebf8ff;
        color: #3182ce;
    }

    .predicate-badge {
        background-color: #faf5ff;
        color: #805ad5;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .assess-btn {
        background-color: #718096;
    }

    .assess-btn:hover {
        background-color: #4a5568;
        box-shadow: 0 4px 8px rgba(74, 85, 104, 0.2);
    }

    .chart-btn {
        background-color: #48bb78;
    }

    .chart-btn:hover {
        background-color: #38a169;
        box-shadow: 0 4px 8px rgba(56, 161, 105, 0.2);
    }

    .edit-btn {
        background-color: #3182ce;
    }

    .edit-btn:hover {
        background-color: #2b6cb0;
        box-shadow: 0 4px 8px rgba(43, 108, 176, 0.2);
    }

    .delete-btn {
        background-color: #e53e3e;
    }

    .delete-btn:hover {
        background-color: #c53030;
        box-shadow: 0 4px 8px rgba(197, 48, 48, 0.2);
    }

    .report-btn {
        background-color: #805ad5;
    }

    .report-btn:hover {
        background-color: #6b46c1;
        box-shadow: 0 4px 8px rgba(107, 70, 193, 0.2);
    }

    .empty-data {
        text-align: center;
        padding: 40px 0;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #a0aec0;
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    /* Modal styling */
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(45deg, #2c5eb4, #5683d0);
        color: white;
        border-bottom: none;
        padding: 20px 24px;
    }

    .modal-title {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-body {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #4a5568;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background-color: #f8fafc;
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    .modal-footer {
        border-top: 1px solid #edf2f7;
        padding: 16px 24px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-cancel {
        background-color: #f7fafc;
        color: #4a5568;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 16px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background-color: #edf2f7;
    }

    .btn-save {
        background: linear-gradient(45deg, #2c5eb4, #5683d0);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-save:hover {
        background: linear-gradient(45deg, #2854a0, #4a73b9);
        transform: translateY(-1px);
    }

    /* Make sure text in table cell is properly aligned */
    .text-center {
        text-align: center;
        color: #1F2937
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .btn-add-data {
            width: 100%;
            justify-content: center;
        }

        .action-buttons {
            flex-wrap: wrap;
        }
    }
</style>

<script>
    function confirmDelete(form) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            form.submit();
        }
    }
</script>
@endsection
