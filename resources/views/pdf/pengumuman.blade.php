@extends('pdf.layout')
@section('title', 'Laporan Pengumuman')
@section('subjudul', 'Laporan Pengumuman')

@section('content')
<h1>Laporan Pengumuman</h1>
<div class="info">Total: <strong>{{ $pengumumans->count() }} pengumuman</strong></div>

<table class="data">
    <thead>
        <tr>
            <th width="28" class="tengah">No</th>
            <th>Judul</th>
            <th width="65">Status</th>
            <th width="95">Dibuat oleh</th>
            <th width="70">Tanggal</th>
        </tr>
    </thead>
    <tbody>
    @forelse($pengumumans as $p)
        <tr>
            <td class="tengah">{{ $loop->iteration }}</td>
            <td>{{ $p->judul }}</td>
            <td><span class="badge badge-{{ $p->status }}">{{ $p->status }}</span></td>
            <td>{{ $p->user->name ?? '-' }}</td>
            <td>{{ $p->created_at->format('d-m-Y') }}</td>
        </tr>
    @empty
        <tr><td colspan="5" class="tengah">Tidak ada data pengumuman.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="ttd">
    {{ now()->translatedFormat('d F Y') }}<br>
    Dicetak oleh,
    <div class="garis">{{ $pencetak->name }}</div>
</div>
@endsection