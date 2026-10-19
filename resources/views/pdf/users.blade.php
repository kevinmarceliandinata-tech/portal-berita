@extends('pdf.layout')
@section('title', 'Laporan Pengguna')
@section('subjudul', 'Laporan Data Pengguna')

@section('content')
<h1>Laporan Data Pengguna</h1>
<div class="info">
    Total: <strong>{{ $users->count() }} pengguna</strong> &nbsp;|&nbsp;
    Admin: <strong>{{ $users->where('role', 'admin')->count() }}</strong> &nbsp;|&nbsp;
    User: <strong>{{ $users->where('role', 'user')->count() }}</strong>
</div>

<table class="data">
    <thead>
        <tr>
            <th width="28" class="tengah">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th width="50">Level</th>
            <th width="50" class="tengah">Berita</th>
            <th width="70">Terdaftar</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $u)
        <tr>
            <td class="tengah">{{ $loop->iteration }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td><span class="badge {{ $u->role === 'admin' ? 'badge-danger' : '' }}">{{ strtoupper($u->role) }}</span></td>
            <td class="tengah">{{ $u->beritas_count }}</td>
            <td>{{ $u->created_at->format('d-m-Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ttd">
    {{ now()->translatedFormat('d F Y') }}<br>
    Dicetak oleh,
    <div class="garis">{{ $pencetak->name }}</div>
</div>
@endsection