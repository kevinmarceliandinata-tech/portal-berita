@extends('pdf.layout')
@section('title', 'Laporan Agenda')
@section('subjudul', 'Laporan Agenda Kegiatan')

@section('content')
<h1>Laporan Agenda Kegiatan</h1>
<div class="info">Total: <strong>{{ $agendas->count() }} agenda</strong></div>

<table class="data">
    <thead>
        <tr>
            <th width="28" class="tengah">No</th>
            <th>Judul Agenda</th>
            <th width="95">Mulai</th>
            <th width="95">Selesai</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    @forelse($agendas as $a)
        <tr>
            <td class="tengah">{{ $loop->iteration }}</td>
            <td>{{ $a->judul_agenda }}</td>
            <td>{{ $a->tanggal_mulai?->translatedFormat('d M Y H:i') }}</td>
            <td>{{ $a->tanggal_selesai?->translatedFormat('d M Y H:i') ?? '-' }}</td>
            <td>{{ $a->isi_agenda }}</td>
        </tr>
    @empty
        <tr><td colspan="5" class="tengah">Tidak ada data agenda.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="ttd">
    {{ now()->translatedFormat('d F Y') }}<br>
    Dicetak oleh,
    <div class="garis">{{ $pencetak->name }}</div>
</div>
@endsection