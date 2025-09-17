@extends('layouts.main')

@section('main-content')
<div class="container-fluid">

<div class="container-fluid">
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Manajemen Data Karyawan</h2>
                <p class="text-muted">Kelola data karyawan sistem</p>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary rounded-pill d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                    <i class="ti ti-plus me-2"></i> Tambah Karyawan
                </button>
            </div>
        </div>
    </div>

    <!-- Alerts Section -->
    <div class="alerts-container mb-4">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ti ti-alert-circle fs-5 me-2"></i>
                    </div>
                    <div>
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ti ti-check fs-5 me-2"></i>
                    </div>
                    <div>
                        {{ Session::get('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Main Content Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <div class="card-actions float-end">
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="ti ti-download me-2"></i> Export Data</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-printer me-2"></i> Cetak Data</a></li>
                    </ul>
                </div>
            </div>
            <h5 class="card-title mb-0">Daftar Karyawan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" width="80">No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm bg-primary text-white rounded-circle me-2">
                                        {{ strtoupper(substr($user->fullname, 0, 1)) }}
                                    </div>
                                    <span>{{ $user->fullname }}</span>
                                </div>
                            </td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditUser{{ $user->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <form action="{{ url("/users/$user->id") }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn" onclick="confirmDelete(this)">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <div class="empty-state">
                                    <div class="empty-state-icon mb-3">
                                        <i class="ti ti-users text-muted" style="font-size: 48px;"></i>
                                    </div>
                                    <p class="empty-state-description">Belum ada data karyawan yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="row">
                <div class="col">
                    <small class="text-muted">Menampilkan {{ count($users) }} karyawan</small>
                </div>
                <div class="col-auto">
                    <!-- Pagination would go here if needed -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<form method="post" action="{{ url('/users') }}" class="needs-validation" novalidate>
    @csrf
    <div class="modal fade" id="modalTambahUser" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ti ti-user-plus me-2"></i>Tambah Karyawan Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="user_fullname" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ti ti-user"></i>
                            </span>
                            <input type="text" class="form-control" name="user_fullname" id="user_fullname"
                                value="{{ old('user_fullname') }}" placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="user_username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ti ti-at"></i>
                            </span>
                            <input type="text" class="form-control" name="user_username" id="user_username"
                                value="{{ old('user_username') }}" placeholder="Masukkan username" required>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="user_password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ti ti-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="user_password" id="user_password"
                                placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted">Password minimal 8 karakter dengan kombinasi huruf dan angka.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Edit User -->
@foreach ($users as $user)
<form method="post" action="{{ url("/users/$user->id") }}" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    <div class="modal fade" id="modalEditUser{{ $user->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ti ti-edit me-2"></i>Edit Data Karyawan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="user_fullname" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ti ti-user"></i>
                            </span>
                            <input type="text" class="form-control" name="user_fullname" id="user_fullname"
                                value="{{ $user->fullname }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="user_username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ti ti-at"></i>
                            </span>
                            <input type="text" class="form-control" name="user_username" id="user_username"
                                value="{{ $user->username }}" required>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="user_password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ti ti-lock"></i>
                            </span>
                            <input type="password" class="form-control" name="user_password" id="user_password"
                                value="{{ $user->password }}" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach

<style>
    /* Custom styling */
    .avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        font-weight: 600;
        font-size: 14px;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #333;
    }

    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.05);
    }

    .card-footer {
        border-top: 1px solid rgba(0,0,0,.05);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.025em;
    }

    .table td {
        vertical-align: middle;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    .empty-state {
        padding: 2rem 0;
    }

    .btn-outline-primary, .btn-outline-danger {
        border-width: 1.5px;
    }

    .btn-outline-primary:hover, .btn-outline-danger:hover {
        transform: translateY(-1px);
    }

    .input-group-text {
        border-right: 0;
    }

    .form-control:focus + .btn-outline-secondary {
        border-color: #86b7fe;
    }

    .alert {
        border: none;
        border-radius: 0.5rem;
    }
</style>

<script>
    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('ti-eye');
                    icon.classList.add('ti-eye-off');
                } else {
                    input.type = 'password';
                    icon.classList.remove('ti-eye-off');
                    icon.classList.add('ti-eye');
                }
            });
        });
    });

    // Confirm delete function
    function confirmDelete(button) {
        if (confirm('Anda yakin ingin menghapus data karyawan ini?')) {
            button.form.submit();
        }
    }
</script>
@endsection
