@extends('layouts.main')

@section('main-content')
<div class="assessment-container container-fluid">
    <div class="assessment-card">
        <div class="card-header">
            <h3>PENILAIAN TINGKAT KEMATANGAN</h3>
            <button type="button" class="btn-back" onclick="window.location.href='{{ url('/aplikasi') }}'">
                <i class="ti ti-arrow-left"></i> Kembali
            </button>
        </div>

        <!-- Notifications -->
        <div class="notifications-container">
            @if ($errors->any())
                <div class="alert-box error">
                    <div class="alert-content">
                        <i class="ti ti-alert-circle"></i>
                        <div class="alert-text">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            @endif

            @if (Session::get('success'))
                <div class="alert-box success">
                    <div class="alert-content">
                        <i class="ti ti-check-circle"></i>
                        <div class="alert-text">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            @endif
        </div>

        @if ($data !== null && count($data) > 0)
            <!-- Assessment Table -->
            <div class="assessment-table-container">
                <table class="assessment-table">
                    <thead>
                        <tr>
                            <th class="column-number">No</th>
                            <th class="column-indicator">Indikator</th>
                            <th class="column-weight">Bobot</th>
                            <th class="column-value">Nilai</th>
                            <th class="column-description">Keterangan</th>
                            <th class="column-evidence">Bukti Pendukung</th>
                            <th class="column-actions">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_indikator }}</td>
                                <td class="text-center">{{ $item->bobot_indikator }}</td>
                                <td class="text-center">
                                    <span class="value-badge level-{{ $item->nilai ?? '0' }}">
                                        {{ $item->nilai ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $item->keterangan }}</td>
                                <td class="text-center">
                                    @if ($item->bukti)
                                        @if (in_array(pathinfo($item->bukti, PATHINFO_EXTENSION), ['jpeg', 'jpg', 'png']))
                                            <a href="{{ asset('public/bukti_pendukung/' . $item->bukti) }}" target="_blank" class="evidence-thumbnail">
                                                <img src="{{ asset('public/bukti_pendukung/' . $item->bukti) }}" alt="Bukti Pendukung">
                                            </a>
                                        @elseif(pathinfo($item->bukti, PATHINFO_EXTENSION) === 'pdf')
                                            <a href="{{ asset('public/bukti_pendukung/' . $item->bukti) }}" target="_blank" class="file-link">
                                                <i class="ti ti-file-text"></i> Lihat PDF
                                            </a>
                                        @endif
                                    @else
                                        <span class="no-evidence">Belum ada</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditPenilaian{{ $item->id }}">
                                            <i class="ti ti-edit"></i> Edit
                                        </button>
                                        @if ($item->nilai)
                                            <form action="{{ url("/penilaian/$item->penilaian_id") }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn-delete">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade custom-modal" id="modalEditPenilaian{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Form Edit Penilaian</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ $item->penilaian_id ? url("/penilaian/$item->penilaian_id") : route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @if ($item->penilaian_id)
                                                @method('PUT')
                                            @endif

                                            <div class="modal-body">
                                                @if($item->penilaian_id)
                                                    <input type="hidden" id="data_indikator" name="data_indikator" value="{{ json_encode($allIndikatorOpt) }}">
                                                @endif
                                                @if(!$item->penilaian_id)
                                                    <input type="hidden" id="data_indikator" name="data_indikator" value="{{ $allIndikatorOpt }}">
                                                @endif
                                                <input type="hidden" value="{{ $id_aplikasi }}" name="aplikasi_id" id="aplikasi_id">
                                                <input type="hidden" name="nama_indikator" id="nama_indikator" value="{{ $item->id }}">
                                                <input type="hidden" name="bobot_indikator" id="bobot_indikator" value="{{ $item->bobot_indikator }}">
                                                <input type="hidden" name="keterangan_value" id="keterangan_value" value="{{ $item->keterangan }}">

                                                <div class="form-group">
                                                    <label for="nama_indikator">Nama Indikator</label>
                                                    <select class="form-select" name="nama_indikator" id="nama_indikator" disabled>
                                                        @foreach($allIndikatorOpt as $i)
                                                            <option value="{{ $i->id }}" @if($item->id == $i->id) selected @endif>
                                                                {{ $i->nama_indikator }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="bobot">Bobot</label>
                                                    <input type="text" class="form-control" name="bobot" id="bobot" value="{{ $item->bobot_indikator }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nilai">Nilai</label>
                                                    <select class="form-select" name="nilai" id="nilai">
                                                        <option value="">Pilih Nilai</option>
                                                        <option value="1" @if($item->nilai == 1) selected @endif>1 - Informasi</option>
                                                        <option value="2" @if($item->nilai == 2) selected @endif>2 - Interaksi</option>
                                                        <option value="3" @if($item->nilai == 3) selected @endif>3 - Transaksi</option>
                                                        <option value="4" @if($item->nilai == 4) selected @endif>4 - Kolaborasi</option>
                                                        <option value="5" @if($item->nilai == 5) selected @endif>5 - Optimalisasi</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ $item->keterangan }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="bukti">Bukti Pendukung</label>
                                                    <div class="file-upload-container">
                                                        <input type="file" class="form-control" name="bukti" id="bukti">
                                                        @if ($item->bukti)
                                                            <div class="current-file">
                                                                <span>File saat ini: </span>
                                                                <a href="{{ asset('public/bukti_pendukung/' . $item->bukti) }}" target="_blank">
                                                                    {{ $item->bukti }}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn-save">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="assessment-footer">
                <a href="{{ "/hitung-kematangan/$id_aplikasi" }}" class="btn-calculate">
                    <i class="ti ti-calculator"></i> Hitung Kematangan
                </a>
            </div>
        @else
            <div class="empty-state">
                <i class="ti ti-clipboard-x"></i>
                <h5>Data Penilaian Masih Kosong</h5>
                <p>Belum ada data penilaian yang tersedia untuk aplikasi ini.</p>
            </div>
        @endif
    </div>
</div>

<style>
    /* Main Container Styles */
    .assessment-container {
        padding: 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .assessment-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #eaedf2;
    }

    /* Header Styles */
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        background: linear-gradient(90deg, #2c5eb4, #3b77db);
        color: white;
        position: relative;
    }

    .card-header h3 {
        font-weight: 600;
        margin: 0;
        letter-spacing: 0.5px;
        font-size: 1.25rem;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    /* Notification Styles */
    .notifications-container {
        padding: 0 2rem;
    }

    .alert-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-radius: 8px;
        margin: 1rem 0;
    }

    .alert-box.error {
        background-color: #fee2e2;
        border-left: 4px solid #ef4444;
    }

    .alert-box.success {
        background-color: #dcfce7;
        border-left: 4px solid #22c55e;
    }

    .alert-content {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .alert-text p {
        margin: 0;
        padding: 0;
    }

    .alert-box.error i {
        color: #ef4444;
    }

    .alert-box.success i {
        color: #22c55e;
    }

    .alert-close {
        background: none;
        border: none;
        cursor: pointer;
        color: #6b7280;
    }

    /* Table Styles */
    .assessment-table-container {
        padding: 1.5rem 2rem;
        overflow-x: auto;
    }

    .assessment-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
    }

    .assessment-table thead tr {
        background-color: #f1f5f9;
    }

    .assessment-table th {
        padding: 1rem;
        font-weight: 600;
        text-align: left;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .assessment-table td {
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
        color: #475569;
    }

    .assessment-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .column-number {
        width: 60px;
    }

    .column-weight, .column-value {
        width: 80px;
    }

    .column-description {
        width: 120px;
    }

    .column-evidence {
        width: 150px;
    }

    .column-actions {
        width: 180px;
    }

    .text-center {
        text-align: center;
    }

    /* Value Badge Styles */
    .value-badge {
        display: inline-block;
        width: 28px;
        height: 28px;
        line-height: 28px;
        text-align: center;
        border-radius: 50%;
        font-weight: 600;
        color: white;
    }

    .level-0 {
        background-color: #94a3b8;
    }

    .level-1 {
        background-color: #f87171;
    }

    .level-2 {
        background-color: #fb923c;
    }

    .level-3 {
        background-color: #facc15;
    }

    .level-4 {
        background-color: #4ade80;
    }

    .level-5 {
        background-color: #2dd4bf;
    }

    /* Evidence Styles */
    .evidence-thumbnail {
        display: inline-block;
        width: 60px;
        height: 60px;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .evidence-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        background-color: #f1f5f9;
        color: #2563eb;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .file-link:hover {
        background-color: #e2e8f0;
    }

    .no-evidence {
        color: #94a3b8;
        font-style: italic;
        font-size: 0.9rem;
    }

    /* Action Button Styles */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit, .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-edit {
        background-color: #fef3c7;
        color: #d97706;
    }

    .btn-edit:hover {
        background-color: #fde68a;
    }

    .btn-delete {
        background-color: #fee2e2;
        color: #ef4444;
    }

    .btn-delete:hover {
        background-color: #fecaca;
    }

    /* Footer Styles */
    .assessment-footer {
        display: flex;
        justify-content: flex-end;
        padding: 1.5rem 2rem;
        border-top: 1px solid #eaedf2;
    }

    .btn-calculate {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(90deg, #10b981, #059669);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-calculate:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    /* Empty State Styles */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
        color: #64748b;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #94a3b8;
    }

    .empty-state h5 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        text-align: center;
        max-width: 400px;
    }

    /* Modal Styles */
    .custom-modal .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .custom-modal .modal-header {
        background: linear-gradient(90deg, #2c5eb4, #3b77db);
        color: white;
        padding: 1.25rem 1.5rem;
        border-bottom: none;
    }

    .custom-modal .modal-title {
        font-weight: 600;
    }

    .custom-modal .btn-close {
        color: white;
        opacity: 0.8;
    }

    .custom-modal .modal-body {
        padding: 1.5rem;
    }

    .custom-modal .form-group {
        margin-bottom: 1.25rem;
    }

    .custom-modal label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #334155;
    }

    .custom-modal .form-control,
    .custom-modal .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }

    .custom-modal .form-control:focus,
    .custom-modal .form-select:focus {
        outline: none;
        border-color: #3b77db;
        box-shadow: 0 0 0 3px rgba(59, 119, 219, 0.2);
    }

    .custom-modal .form-control:disabled,
    .custom-modal .form-select:disabled {
        background-color: #f1f5f9;
        cursor: not-allowed;
    }

    .file-upload-container {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .current-file {
        font-size: 0.9rem;
        color: #64748b;
    }

    .current-file a {
        color: #2563eb;
        text-decoration: none;
    }

    .custom-modal .modal-footer {
        border-top: 1px solid #eaedf2;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .btn-cancel, .btn-save {
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-cancel {
        background-color: #f1f5f9;
        color: #64748b;
    }

    .btn-cancel:hover {
        background-color: #e2e8f0;
    }

    .btn-save {
        background: linear-gradient(90deg, #2c5eb4, #3b77db);
        color: white;
    }

    .btn-save:hover {
        box-shadow: 0 4px 12px rgba(59, 119, 219, 0.3);
    }
</style>
@endsection

@section('scripts')
<script>
    function onChangeValue(opt) {
        let nilai = opt.value;
        let modal = $(opt).closest('.modal');
        let keterangan = modal.find('#keterangan');
        let keteranganVal = modal.find('#keterangan_value');

        switch (nilai) {
            case '1':
                keterangan.val('Informasi');
                keteranganVal.val('Informasi');
                break;
            case '2':
                keterangan.val('Interaksi');
                keteranganVal.val('Interaksi');
                break;
            case '3':
                keterangan.val('Transaksi');
                keteranganVal.val('Transaksi');
                break;
            case '4':
                keterangan.val('Kolaborasi');
                keteranganVal.val('Kolaborasi');
                break;
            case '5':
                keterangan.val('Optimalisasi');
                keteranganVal.val('Optimalisasi');
                break;
            default:
                keterangan.val('');
                keteranganVal.val('');
                break;
        }
    }

    $(document).ready(function () {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Handle value changes
        $('select[name="nilai"]').on('change', function () {
            onChangeValue(this);
        });

        // Automatically close alerts after 5 seconds
        setTimeout(function() {
            $('.alert-box').fadeOut('slow');
        }, 5000);
    });
</script>
@endsection
