@extends('layouts.frontend')
@section('title', $album->nama_album)

@section('content')
<h3>{{ $album->nama_album }}</h3>
<p class="text-muted">{{ $album->deskripsi }}</p>

<div class="row g-3">
    @forelse($galeries as $g)
        <div class="col-6 col-md-3">
            <a href="{{ asset('storage/'.$g->file_path) }}" target="_blank" class="text-decoration-none">
                <div class="card shadow-sm h-100 card-berita">
                    <img src="{{ asset('storage/'.$g->file_path) }}" class="card-img-top" style="height:160px;object-fit:cover" alt="{{ $g->judul }}">
                    @if($g->judul || $g->keterangan)
                        <div class="card-body p-2">
                            <div class="small fw-semibold text-dark">{{ $g->judul }}</div>
                            <div class="small text-muted">{{ Str::limit($g->keterangan, 50) }}</div>
                        </div>
                    @endif
                </div>
            </a>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">Album ini belum berisi foto.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $galeries->links() }}</div>
<a href="{{ route('galeri.index') }}" class="btn btn-outline-dark mt-3">&larr; Semua album</a>
@endsection