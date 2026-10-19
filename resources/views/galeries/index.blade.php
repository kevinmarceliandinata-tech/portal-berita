@extends('layouts.app')
@section('title', 'Foto Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h3 class="mb-0">Foto Galeri</h3>
    <div class="d-flex gap-2">
        <form method="GET" action="{{ route('galeries.index') }}" class="d-flex gap-2">
            <select name="album" class="form-select" onchange="this.form.submit()">
                <option value="">Semua album</option>
                @foreach($albums as $a)
                    <option value="{{ $a->id }}" @selected(request('album') == $a->id)>{{ $a->nama_album }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('galeries.create') }}" class="btn btn-primary text-nowrap">+ Tambah Foto</a>
    </div>
</div>

<div class="row g-3">
@forelse($galeries as $g)
    <div class="col-6 col-md-3">
        <div class="card h-100 shadow-sm">
            <img src="{{ asset('storage/'.$g->file_path) }}" class="card-img-top" style="height:150px;object-fit:cover">
            <div class="card-body p-2">
                <div class="fw-bold small">{{ $g->judul ?? '(tanpa judul)' }}</div>
                <div class="small text-muted">{{ $g->album->nama_album ?? 'Tanpa album' }}</div>
            </div>
            <div class="card-footer bg-white p-2">
                <a href="{{ route('galeries.edit', $g) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('galeries.destroy', $g) }}" class="d-inline"
                      onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="col-12"><div class="alert alert-info">Belum ada foto.</div></div>
@endforelse
</div>
<div class="mt-4">{{ $galeries->links() }}</div>
@endsection