@extends('layouts.frontend')
@section('title', $pengumuman->judul)

@section('content')
<article class="bg-white p-4 rounded shadow-sm">
    <h2>{{ $pengumuman->judul }}</h2>
    <p class="text-muted small">
        {{ $pengumuman->created_at->translatedFormat('l, d F Y') }}
        @if($pengumuman->user) &middot; oleh {{ $pengumuman->user->name }} @endif
    </p>
    <div style="line-height:1.9">{!! nl2br(e($pengumuman->isi)) !!}</div>

    @if($pengumuman->lampiran)
        <a href="{{ asset('storage/'.$pengumuman->lampiran) }}" target="_blank" class="btn btn-outline-primary mt-3">
            Unduh / Lihat Lampiran
        </a>
    @endif
</article>
<a href="{{ route('pengumuman.index') }}" class="btn btn-outline-dark mt-3">&larr; Semua pengumuman</a>
@endsection