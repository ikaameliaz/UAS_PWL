@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">{{ $berita->judul }}</h1>

    @if ($berita->gambar)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 500px;" alt="Gambar Berita">
        </div>
    @endif

    <p><strong>Kategori:</strong> {{ $berita->kategori->nama ?? '-' }}</p>
    <p><strong>Penulis:</strong> {{ $berita->user->name ?? '-' }}</p>
    <p><strong>Status:</strong> <span class="badge bg-{{ $berita->status === 'published' ? 'success' : 'secondary' }}">{{ ucfirst($berita->status) }}</span></p>

    <hr>
    <div style="white-space: pre-wrap;">{!! nl2br(e($berita->isi)) !!}</div>

    <a href="{{ route('berita.index') }}" class="btn btn-secondary mt-4">← Kembali ke Daftar Berita</a>
</div>
@endsection
