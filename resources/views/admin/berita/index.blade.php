@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Semua Berita</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beritas as $b)
                <tr>
                    <td>{{ $b->judul }}</td>
                    <td>{{ optional($b->kategori)->nama ?? '-' }}</td>
                    <td>{{ ucfirst($b->status) }}</td>
                    <td>{{ $b->user->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('berita.show', $b->id) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('berita.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('berita.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
