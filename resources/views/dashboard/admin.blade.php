@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<h3 class="mb-1">Dashboard Admin</h3>
<p class="text-muted">Selamat datang, {{ auth()->user()->name }}. Anda dapat mengelola seluruh konten dan pengguna.</p>

<div class="row g-3 mb-4">
    @foreach($stat as [$label, $jumlah, $warna, $rute])
        <div class="col-6 col-md-3">
            {{-- Route::has: tautan baru aktif setelah route-nya dibuat di Tahap 3 --}}
            <a href="{{ Route::has($rute) ? route($rute) : '#' }}" class="text-decoration-none">
                <div class="card text-bg-{{ $warna }} h-100">
                    <div class="card-body">
                        <div class="small">{{ $label }}</div>
                        <div class="display-6 fw-bold">{{ $jumlah }}</div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="card shadow-sm">
    <div class="card-header fw-bold">5 Berita Terbaru</div>
    <table class="table mb-0 align-middle">
        <thead><tr><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Tanggal</th></tr></thead>
        <tbody>
        @forelse($beritaTerbaru as $b)
            <tr>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->kategori->nama }}</td>
                <td>{{ $b->user->name }}</td>
                <td>{{ $b->tanggal->format('d-m-Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted">Belum ada berita.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection