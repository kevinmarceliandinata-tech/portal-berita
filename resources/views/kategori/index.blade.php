@extends('layouts.app')
@section('content')
<h3>Kategori</h3>
<form method="POST" action="{{ route('kategori.store') }}" class="d-flex gap-2 mb-3">
    @csrf
    <input name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama kategori baru">
    <button class="btn btn-primary">Tambah</button>
</form>
@error('nama')<div class="text-danger mb-2">{{ $message }}</div>@enderror
<table class="table table-bordered bg-white">
    <tr><th>Nama</th><th>Jumlah Berita</th><th width="100">Aksi</th></tr>
    @foreach($kategoris as $k)
    <tr>
        <td>{{ $k->nama }}</td>
        <td>{{ $k->beritas_count }}</td>
        <td>
            <form method="POST" action="{{ route('kategori.destroy', $k) }}"
                  onsubmit="return confirm('Hapus kategori? Berita di dalamnya ikut terhapus.')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection