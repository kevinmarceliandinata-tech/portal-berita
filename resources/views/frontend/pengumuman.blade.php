@extends('layouts.frontend')
@section('title', 'Pengumuman')

@section('content')
<h3 class="mb-3">Pengumuman</h3>
<div class="list-group shadow-sm">
    @forelse($pengumumans as $p)
        <a href="{{ route('pengumuman.show', $p) }}" class="list-group-item list-group-item-action">
            <div class="d-flex justify-content-between">
                <h6 class="mb-1">{{ $p->judul }}</h6>
                <small class="text-muted">{{ $p->created_at->translatedFormat('d F Y') }}</small>
            </div>
            <p class="mb-0 small text-muted">{{ Str::limit(strip_tags($p->isi), 140) }}</p>
        </a>
    @empty
        <div class="list-group-item text-muted">Belum ada pengumuman.</div>
    @endforelse
</div>
<div class="mt-3">{{ $pengumumans->links() }}</div>
@endsection