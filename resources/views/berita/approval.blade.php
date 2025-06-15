@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-check-circle me-3 text-success fs-2"></i>
                <h1 class="mb-0 fw-bold">Approval Berita</h1>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse ($beritas as $berita)
            <div class="col-lg-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-light border-0">
                        <h5 class="card-title mb-1 text-dark">{{ $berita->judul }}</h5>
                        <small class="text-white bg-primary px-2 py-1 rounded">
                            <i class="fas fa-user me-1"></i>{{ optional($berita->user)->name ?? '-' }}
                        </small>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted mb-3">{{ Str::limit($berita->isi, 120) }}</p>
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-2">
                                <i class="fas fa-tag me-1"></i>
                                <span class="text-white">{{ optional($berita->kategori)->nama ?? '-' }}</span>
                            </span>
                        </div>
                        <form action="{{ route('berita.publish', $berita->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin publish berita ini?')">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-paper-plane me-2"></i>Publish Berita
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-inbox fs-1 text-muted mb-3"></i>
                    <div class="alert alert-info border-0">
                        <h4>Tidak ada berita draft</h4>
                        <p class="mb-0">Semua berita sudah disetujui atau belum ada draft baru.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection