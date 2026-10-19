@extends('layouts.app')
@section('title', 'Album')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Album</h3>
    <a href="{{ route('albums.create') }}" class="btn btn-primary">+ Tambah Album</a>
</div>
<div class="row g-3">
@forelse($albums as $a)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            @if($a->cover)
                <img src="{{ asset('storage/'.$a->cover) }}" class="card-img-top" style="height:160px;object-fit:cover">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:160px">Tanpa cover</div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $a->nama_album }}</h5>
                <p class="card-text small text-muted">{{ Str::limit($a->deskripsi, 80) }}</p>
                <span class="badge bg-dark">{{ $a->galeries_count }} foto</span>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('galeries.index', ['album' => $a->id]) }}" class="btn btn-sm btn-outline-dark">Lihat Foto</a>
                <a href="{{ route('albums.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('albums.destroy', $a) }}" class="d-inline"
                      onsubmit="return confirm('Hapus album? Foto di dalamnya tetap ada tanpa album.')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="col-12"><div class="alert alert-info">Belum ada album.</div></div>
@endforelse
</div>
<div class="mt-4">{{ $albums->links() }}</div>
@endsection