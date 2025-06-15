@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-gray-800 mb-2">
            <i class="fas fa-globe me-3 text-primary"></i>Berita Publik
        </h1>
        <p class="lead text-muted">Kumpulan berita terbaru dan terpercaya</p>
    </div>

    <div class="row">
        @foreach ($beritas as $berita)
            <div class="col-lg-6 mb-4">
                <div class="card h-100 shadow border-0">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3">{{ $berita->judul }}</h5>
                        <p class="card-text text-muted mb-4">{{ Str::limit($berita->isi, 120) }}</p>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle me-2 text-primary"></i>
                                <small class="text-muted">{{ $berita->user->name }}</small>
                            </div>
                            <span class="badge bg-primary">
                                <i class="fas fa-tag me-1"></i>{{ $berita->kategori->nama }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $berita->created_at->diffForHumans() ?? 'Baru saja' }}
                            </small>
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($beritas->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-newspaper fs-1 text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada berita tersedia</h4>
            <p class="text-muted">Berita akan tampil di sini setelah dipublikasikan.</p>
        </div>
    @endif
</div>
@endsection