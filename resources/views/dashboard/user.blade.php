@extends('layouts.app')
@section('title', 'Dashboard Penulis')

@section('content')
<h3 class="mb-1">Halo, {{ auth()->user()->name }}</h3>
<p class="text-muted">Anda masuk sebagai <strong>User</strong>. Anda dapat menulis dan mengelola berita milik sendiri.</p>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary h-100"><div class="card-body">
            <div class="small">Berita Saya</div>
            <div class="display-6 fw-bold">{{ $totalBerita }}</div>
        </div></div>
    </div>
    <div class="col-md-8 d-flex align-items-center gap-2">
        <a href="{{ route('berita.create') }}" class="btn btn-primary">+ Tulis Berita Baru</a>
        <a href="{{ route('berita.index') }}" class="btn btn-outline-dark">Kelola Berita Saya</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header fw-bold">Berita Terakhir Saya</div>
    <table class="table mb-0 align-middle">
        <thead><tr><th>Judul</th><th>Kategori</th><th>Tanggal</th></tr></thead>
        <tbody>
        @forelse($beritaTerbaru as $b)
            <tr>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->kategori->nama }}</td>
                <td>{{ $b->tanggal->format('d-m-Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center text-muted">Anda belum menulis berita.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection