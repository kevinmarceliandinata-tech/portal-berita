@extends('layouts.frontend')
@section('title', 'Agenda')

@section('content')
<h3 class="mb-3">Agenda Mendatang</h3>
<div class="row g-3 mb-5">
    @forelse($mendatang as $a)
        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-start border-4 border-primary">
                <div class="card-body">
                    <h5 class="card-title">{{ $a->judul_agenda }}</h5>
                    <p class="text-primary small mb-2">
                        {{ $a->tanggal_mulai->translatedFormat('l, d F Y H:i') }}
                        @if($a->tanggal_selesai) &ndash; {{ $a->tanggal_selesai->translatedFormat('d M Y H:i') }} @endif
                    </p>
                    <p class="card-text text-muted">{{ $a->isi_agenda }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">Belum ada agenda mendatang.</div></div>
    @endforelse
</div>

<h4 class="mb-3">Agenda Terlaksana</h4>
<div class="list-group shadow-sm">
    @forelse($lalu as $a)
        <div class="list-group-item">
            <div class="fw-semibold">{{ $a->judul_agenda }}</div>
            <div class="small text-muted">{{ $a->tanggal_mulai->translatedFormat('d F Y') }}</div>
        </div>
    @empty
        <div class="list-group-item text-muted">Belum ada riwayat agenda.</div>
    @endforelse
</div>
<div class="mt-3">{{ $lalu->links() }}</div>
@endsection