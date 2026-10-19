@extends('layouts.app')
@section('title', 'Pengguna')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Manajemen Pengguna</h3>
    <div class="d-flex gap-2">
        <a href="{{ route('laporan.users') }}" target="_blank" class="btn btn-outline-danger">Cetak PDF</a>
        <a href="{{ route('laporan.users', ['aksi' => 'unduh']) }}" class="btn btn-danger">Unduh PDF</a>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah Pengguna</a>
    </div>
</div>
<table class="table table-bordered bg-white align-middle">
    <thead><tr><th>Nama</th><th>Email</th><th>Level</th><th>Jumlah Berita</th><th width="150">Aksi</th></tr></thead>
    <tbody>
    @foreach($users as $u)
        <tr>
            <td>{{ $u->name }} @if($u->id === auth()->id())<span class="badge bg-light text-dark border">Anda</span>@endif</td>
            <td>{{ $u->email }}</td>
            <td><span class="badge {{ $u->role === 'admin' ? 'bg-danger' : 'bg-info text-dark' }}">{{ strtoupper($u->role) }}</span></td>
            <td>{{ $u->beritas_count }}</td>
            <td>
                <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-warning">Edit</a>
                @if($u->id !== auth()->id())
                    <form method="POST" action="{{ route('users.destroy', $u) }}" class="d-inline"
                          onsubmit="return confirm('Hapus pengguna ini? Seluruh berita miliknya ikut terhapus.')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection