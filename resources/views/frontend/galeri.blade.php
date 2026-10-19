@extends('layouts.frontend')
@section('title', 'Galeri')

@section('content')
<h3 class="mb-3">Galeri Foto</h3>
<div class="row g-4">
    @forelse($albums as $a)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm card-berita">
                @if($a->cover)
                    <img src="{{ asset('storage/'.$a->cover) }}" class="card-img-top" style="height:190px;object-fit:cover" alt="{{ $a->nama_album }}">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:190px">Tanpa cover</div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('galeri.show', $a) }}" class="text-decoration-none text-dark stretched-link">{{ $a->nama_album }}</a>
                    </h5>
                    <p class="card-text text-muted small">{{ Str::limit($a->deskripsi, 90) }}</p>
                </div>
                <div class="card-footer bg-white small text-muted">{{ $a->galeries_count }} foto</div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">Belum ada album.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $albums->links() }}</div>
@endsection