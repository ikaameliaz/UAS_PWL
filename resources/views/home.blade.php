@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-primary rounded-3 p-4 text-white">
                <h1 class="h2 mb-2 fw-bold">📰 Berita Terbaru</h1>
                <p class="mb-0 opacity-75">Dapatkan informasi terkini dan terpercaya</p>
            </div>
        </div>
    </div>

    <!-- News Grid -->
    <div class="row">
        @foreach ($beritas as $index => $berita)
            <div class="col-lg-6 col-xl-4 mb-4">
                <div class="card h-100 shadow-sm border-0 news-card">
                    <!-- News Image -->
                    <div class="card-img-container">
                        @if(isset($berita->gambar) && $berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                 class="card-img-top news-image" 
                                 alt="{{ $berita->judul }}"
                                 onerror="this.src='https://via.placeholder.com/400x200/007bff/ffffff?text=📰+Berita'">
                        @else
                            <div class="placeholder-img d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <i class="fas fa-newspaper text-white mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-white mb-0 small">Berita Terbaru</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- News Badge Overlay -->
                        <div class="position-absolute" style="top: 15px; left: 15px;">
                            <span class="badge bg-primary rounded-pill px-3 py-2 shadow-sm text-white">
                                <i class="fas fa-newspaper me-1"></i>
                                Berita {{ $index + 1 }}
                            </span>
                        </div>
                        
                        <!-- Time Badge Overlay -->
                        <div class="position-absolute" style="top: 15px; right: 15px;">
                            <span class="badge bg-dark bg-opacity-75 text-white rounded-pill px-2 py-1">
                                <i class="far fa-clock me-1"></i>
                                {{ $berita->created_at ? $berita->created_at->diffForHumans() : 'Baru' }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <!-- Title -->
                        <h5 class="card-title mb-3 text-dark fw-bold line-clamp-2">
                            {{ $berita->judul }}
                        </h5>

                        <!-- Content Preview -->
                        <p class="card-text text-muted mb-4 flex-grow-1 line-clamp-3">
                            {{ Str::limit($berita->isi, 120) }}
                        </p>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            <a href="{{ route('berita.show', $berita->id) }}" 
                               class="btn btn-outline-primary btn-sm rounded-pill px-4 hover-lift">
                                <i class="fas fa-arrow-right me-2"></i>
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-light border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>
                                {{ rand(50, 500) }} views
                            </small>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-secondary border-0 rounded-pill me-1">
                                    <i class="far fa-heart"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary border-0 rounded-pill">
                                    <i class="far fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($beritas->isEmpty())
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-newspaper text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-muted mb-2">Belum Ada Berita</h4>
                    <p class="text-muted">Berita terbaru akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Load More Button (if pagination needed) -->
    @if(method_exists($beritas, 'hasPages') && $beritas->hasPages())
        <div class="row mt-4">
            <div class="col-12 text-center">
                {{ $beritas->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
.news-card {
    transition: all 0.3s ease;
    border-radius: 15px !important;
    overflow: hidden;
    border: 1px solid #f8f9fa;
}

.news-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
    border-color: #dee2e6;
}

.card-img-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.news-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-card:hover .news-image {
    transform: scale(1.03);
}

.placeholder-img {
    width: 100%;
    height: 200px;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    transition: all 0.3s ease;
}

.news-card:hover .placeholder-img {
    background: linear-gradient(135deg, #0056b3 0%, #007bff 100%);
}

.hover-lift:hover {
    transform: translateY(-1px);
    transition: transform 0.2s ease;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.5;
}

.btn-outline-primary {
    border-color: #007bff;
    color: #007bff;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,123,255,0.3);
}

.card-footer {
    border-radius: 0 0 15px 15px !important;
    background-color: #f8f9fa !important;
}

.bg-opacity-75 {
    background-color: rgba(0, 0, 0, 0.75) !important;
}

.btn-outline-secondary {
    color: #6c757d;
    border-color: transparent;
    transition: all 0.2s ease;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    color: white;
    transform: scale(1.1);
}

.card-body {
    background-color: white;
}

.card-title {
    color: #212529 !important;
    font-size: 1.1rem;
}

.card-text {
    color: #6c757d !important;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .news-card:hover {
        transform: translateY(-1px);
    }
    
    .news-card:hover .news-image {
        transform: scale(1.01);
    }
    
    .card-img-container {
        height: 180px;
    }
    
    .news-image, .placeholder-img {
        height: 180px;
    }
    
    .btn-group .btn {
        margin-bottom: 0;
    }
}

/* Clean spacing adjustments */
.card {
    background-color: white;
}

.badge {
    font-weight: 500;
    font-size: 0.75rem;
}

.text-muted {
    color: #6c757d !important;
}

/* Ensure consistent spacing */
.mb-4 {
    margin-bottom: 1.5rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.py-3 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}
</style>
@endsection