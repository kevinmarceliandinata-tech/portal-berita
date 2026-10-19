@extends('pdf.layout')
@section('title', 'Laporan Berita')
@section('subjudul', 'Laporan Daftar Berita')

@section('content')
<h1>Laporan Daftar Berita</h1>
<div class="info">
    Kategori: <strong>{{ $kategori->nama ?? 'Semua kategori' }}</strong> &nbsp;|&nbsp;
    Periode:
    <strong>
        @if($dari || $sampai)
            {{ $dari ? \Carbon\Carbon::parse($dari)->translatedFormat('d F Y') : 'awal' }}
            s/d
            {{ $sampai ? \Carbon\Carbon::parse($sampai)->translatedFormat('d F Y') : 'sekarang' }}
        @else
            Semua tanggal
        @endif
    </strong>
    &nbsp;|&nbsp; Total: <strong>{{ $beritas->count() }} berita</strong>
</div>

<table class="data">
    <thead>
        <tr>
            <th width="28" class="tengah">No</th>
            <th width="70">Tanggal</th>
            <th>Judul</th>
            <th width="80">Kategori</th>
            <th width="90">Penulis</th>
        </tr>
    </thead>
    <tbody>
    @forelse($beritas as $b)
        <tr>
            <td class="tengah">{{ $loop->iteration }}</td>
            <td>{{ $b->tanggal->format('d-m-Y') }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->kategori->nama }}</td>
            <td>{{ $b->user->name }}</td>
        </tr>
    @empty
        <tr><td colspan="5" class="tengah">Tidak ada data berita.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="ttd">
    {{ now()->translatedFormat('d F Y') }}<br>
    Dicetak oleh,
    <div class="garis">{{ $pencetak->name }}</div>
</div>
@endsection