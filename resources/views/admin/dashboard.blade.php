@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
            <small class="text-muted">Selamat datang di panel administrasi</small>
        </div>
        <div class="text-muted">
            <i class="fas fa-calendar-alt me-1"></i>
            {{ now()->format('d M Y, H:i') }}
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title h6 mb-0 text-white-50">Total Berita</div>
                            <div class="h2 mb-2 font-weight-bold">{{ \App\Models\Berita::count() }}</div>
                            <div class="small">
                                <span class="badge bg-light text-primary me-1">
                                    Published: {{ \App\Models\Berita::where('status', 'published')->count() }}
                                </span>
                                <span class="badge bg-light text-primary">
                                    Draft: {{ \App\Models\Berita::where('status', 'draft')->count() }}
                                </span>
                            </div>
                        </div>
                        <div class="text-white-50">
                            <i class="fas fa-newspaper fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary border-0">
                    <a href="{{ route('berita.index') }}" class="text-white text-decoration-none small">
                        Kelola Berita <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title h6 mb-0 text-white-50">Total Kategori</div>
                            <div class="h2 mb-2 font-weight-bold">{{ \App\Models\Kategori::count() }}</div>
                            <div class="small text-white-75">Kategori tersedia</div>
                        </div>
                        <div class="text-white-50">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-success border-0">
                    <a href="#" class="text-white text-decoration-none small">
                        Kelola Kategori <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-white bg-info shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title h6 mb-0 text-white-50">Total User</div>
                            <div class="h2 mb-2 font-weight-bold">{{ \App\Models\User::count() }}</div>
                            <div class="small text-white-75">Pengguna terdaftar</div>
                        </div>
                        <div class="text-white-50">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-info border-0">
                    <a href="{{ route('users.index') }}" class="text-white text-decoration-none small">
                        Kelola User <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent News Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-newspaper text-primary me-2"></i>
                    Berita Terbaru
                </h5>
                <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Semua
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Judul</th>
                            <th>Status</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Waktu</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\App\Models\Berita::latest()->take(5)->get() as $berita)
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-semibold">{{ Str::limit($berita->judul, 50) }}</div>
                                    @if($berita->excerpt)
                                        <small class="text-muted">{{ Str::limit($berita->excerpt, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $berita->status === 'published' ? 'success' : 'secondary' }} px-2 py-1">
                                        <i class="fas fa-{{ $berita->status === 'published' ? 'check' : 'clock' }} me-1"></i>
                                        {{ ucfirst($berita->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $berita->kategori->nama ?? 'Tidak ada' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <span>{{ $berita->user->name ?? 'Tidak diketahui' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $berita->created_at->diffForHumans() }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-outline-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <div>Belum ada berita.</div>
                                        <small>Mulai dengan membuat berita pertama Anda</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 0.75rem;
}

.card {
    border: none;
    border-radius: 8px;
}

.card-header {
    border-bottom: 1px solid #e3e6f0;
}

.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.875rem;
    color: #5a5c69;
}

.btn-group-sm > .btn {
    padding: 0.25rem 0.5rem;
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75) !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}
</style>
@endsection