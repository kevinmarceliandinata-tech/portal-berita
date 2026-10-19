@extends('layouts.frontend')

@section('title', isset($aktif) ? 'Kategori '.$aktif->nama : 'Beranda')

@section('content')
@if(!isset($aktif) && !request('q'))
    <div class="hero text-white rounded p-5 mb-4 text-center">
        <h1 class="fw-bold">{{ config('app.name') }}</h1>
        <p class="mb-0">Informasi terkini, akurat, dan terpercaya.</p>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        @if(isset($aktif))
            <h4 class="mb-3">Kategori: {{ $aktif->nama }}</h4>
        @elseif(request('q'))
            <h4 class="mb-3">Hasil pencarian: "{{ request('q') }}"</h4>
        @else
            <h4 class="mb-3">Berita Terbaru</h4>
        @endif

        <div class="row g-4">
            @forelse($beritas as $b)
                <div class="col-md-6">
                    @include('frontend._card', ['b' => $b])
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada berita yang ditemukan.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">{{ $beritas->links() }}</div>
    </div>

    <div class="col-lg-4">
        @include('frontend._sidebar')
    </div>
</div>
@endsection