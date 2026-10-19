@extends('layouts.app')
@section('content')
@include('berita._filter-pdf')

<div class="d-flex justify-content-between mb-3">
    <h3>{{ auth()->user()->isAdmin() ? 'Daftar Berita' : 'Berita Saya' }}</h3>
    <a href="{{ route('berita.create') }}" class="btn btn-primary">+ Tambah Berita</a>
</div>
<table class="table table-bordered bg-white align-middle">
    <thead>
        <tr><th>Tanggal</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Penulis</th><th width="150">Aksi</th></tr>
    </thead>
    <tbody>
    @forelse($beritas as $b)
        <tr>
            <td>{{ $b->tanggal->format('d-m-Y') }}</td>
            <td>
                @if($b->gambar)
                    <img src="{{ asset('storage/'.$b->gambar) }}" height="50">
                @endif
            </td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->kategori->nama }}</td>
            <td>{{ $b->user->name }}</td>
            <td>
                <a href="{{ route('berita.edit', $b) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('berita.destroy', $b) }}" class="d-inline"
                      onsubmit="return confirm('Hapus berita ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center text-muted">Belum ada berita.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $beritas->links() }}
@endsection