@extends('layouts.frontend')

@section('title', $berita->judul)

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <article class="bg-white p-4 rounded shadow-sm">
            <a href="{{ route('kategori.show', $berita->kategori) }}"
               class="badge bg-primary text-decoration-none">{{ $berita->kategori->nama }}</a>
            <h1 class="h2 mt-2">{{ $berita->judul }}</h1>
            <p class="text-muted small">
                Oleh {{ $berita->user->name }} &middot; {{ $berita->tanggal->translatedFormat('l, d F Y') }}
            </p>

            @if($berita->gambar)
                <img src="{{ asset('storage/'.$berita->gambar) }}" class="img-fluid rounded mb-3 w-100"
                     alt="{{ $berita->judul }}">
            @endif

            <div style="line-height:1.9">{!! nl2br(e($berita->isi)) !!}</div>
        </article>

        @if($terkait->count())
            <h5 class="mt-4">Berita Terkait</h5>
            <div class="row g-3">
                @foreach($terkait as $b)
                    <div class="col-md-4">
                        @include('frontend._card', ['b' => $b])
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('home') }}" class="btn btn-outline-dark mt-4">&larr; Kembali ke beranda</a>
    </div>

    <div class="col-lg-4">
        @include('frontend._sidebar')
    </div>
</div>
@endsection