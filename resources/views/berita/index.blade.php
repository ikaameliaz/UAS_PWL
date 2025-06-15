@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 mb-0 text-primary fw-bold">📰 Daftar Berita</h1>
                    <p class="text-muted mb-0">Kelola semua artikel berita Anda</p>
                </div>
                <a href="{{ route('berita.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-plus me-2"></i>Tambah Berita
                </a>
            </div>

            <!-- Success Alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Main Table Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th class="px-4 py-4 fw-semibold">No</th>
                                    <th class="px-4 py-4 fw-semibold">Judul</th>
                                    <th class="px-4 py-4 fw-semibold">Kategori</th>
                                    <th class="px-4 py-4 fw-semibold">Penulis</th>
                                    <th class="px-4 py-4 fw-semibold">Status</th>
                                    <th class="px-4 py-4 fw-semibold">Gambar</th>
                                    <th class="px-4 py-4 fw-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($beritas as $index => $berita)
                                    <tr class="border-bottom">
                                        <!-- Nomor -->
                                        <td class="px-4 py-3 align-middle">
                                            <span class="badge bg-light text-dark rounded-pill">{{ $index + 1 }}</span>
                                        </td>
                                        
                                        <!-- Judul -->
                                        <td class="px-4 py-3 align-middle">
                                            <div class="fw-semibold text-dark">{{ $berita->judul }}</div>
                                        </td>
                                        
                                        <!-- Kategori -->
                                        <td class="px-4 py-3 align-middle">
                                            <span class="badge bg-info text-white rounded-pill">
                                                {{ optional($berita->kategori)->nama ?? 'Tidak Ada' }}
                                            </span>
                                        </td>
                                        
                                        <!-- Penulis -->
                                        <td class="px-4 py-3 align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                     style="width: 32px; height: 32px;">
                                                    <i class="fas fa-user text-white" style="font-size: 12px;"></i>
                                                </div>
                                                <span class="text-dark fw-medium">
                                                    {{ optional($berita->user)->name ?? 'Tidak Ada' }}
                                                </span>
                                            </div>
                                        </td>
                                        
                                        <!-- Status -->
                                        <td class="px-4 py-3 align-middle">
                                            @if($berita->status == 'draft')
                                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-medium">
                                                    <i class="fas fa-edit me-2"></i>Draft
                                                </span>
                                            @elseif($berita->status == 'published')
                                                <span class="badge bg-success text-white px-3 py-2 rounded-pill fw-medium">
                                                    <i class="fas fa-check me-2"></i>Published
                                                </span>
                                            @else
                                                <span class="badge bg-secondary text-white px-3 py-2 rounded-pill fw-medium">
                                                    <i class="fas fa-question me-2"></i>{{ ucfirst($berita->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <!-- Gambar -->
                                        <td class="px-4 py-3 align-middle">
                                            @if ($berita->gambar)
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                                         alt="Gambar Berita" 
                                                         class="rounded shadow-sm" 
                                                         width="80" 
                                                         height="60" 
                                                         style="object-fit: cover;">
                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                        <i class="fas fa-check" style="font-size: 8px;"></i>
                                                    </span>
                                                </div>
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 80px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <!-- Aksi -->
                                        <td class="px-4 py-3 align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('berita.show', $berita->id) }}" 
                                                   class="btn btn-outline-info btn-sm" 
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('berita.edit', $berita->id) }}" 
                                                   class="btn btn-outline-warning btn-sm" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('berita.destroy', $berita->id) }}" 
                                                      method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-5 text-center">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-newspaper text-muted mb-3" style="font-size: 3rem;"></i>
                                                <h5 class="text-muted mb-2">Belum ada berita</h5>
                                                <p class="text-muted mb-3">Mulai dengan menambahkan berita pertama Anda</p>
                                                <a href="{{ route('berita.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Tambah Berita Sekarang
                                                </a>
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
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.02);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.btn-group .btn:last-child {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>
@endsection