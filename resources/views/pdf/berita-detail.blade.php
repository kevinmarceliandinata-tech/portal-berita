@extends('pdf.layout')
@section('title', $berita->judul)
@section('subjudul', 'Berita')

@section('content')
<h1 style="font-size:20px; line-height:1.3;">{{ $berita->judul }}</h1>
<div class="info">
    Kategori: <strong>{{ $berita->kategori->nama }}</strong> &nbsp;|&nbsp;
    Penulis: <strong>{{ $berita->user->name }}</strong> &nbsp;|&nbsp;
    {{ $berita->tanggal->translatedFormat('l, d F Y') }}
</div>

@if($gambar)
    <img src="{{ $gambar }}" style="width:100%; max-height:300px; margin: 6px 0 10px 0;">
@endif

<div style="font-size:12px;">{!! nl2br(e($berita->isi)) !!}</div>

<p class="info" style="margin-top:20px; border-top:1px solid #ccc; padding-top:6px;">
    Sumber: {{ route('berita.show', $berita) }}
</p>
@endsection