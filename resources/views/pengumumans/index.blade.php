@extends('layouts.app')
@section('title', 'Pengumuman')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Pengumuman</h3>
    <a href="{{ route('pengumumans.create') }}" class="btn btn-primary">+ Tambah Pengumuman</a>
</div>
<table class="table table-bordered bg-white align-middle">
    <thead><tr><th>Judul</th><th>Status</th><th>Lampiran</th><th>Dibuat oleh</th><th>Tanggal</th><th width="150">Aksi</th></tr></thead>
    <tbody>
    @php $warna = ['published' => 'success', 'draft' => 'warning', 'archived' => 'secondary']; @endphp
    @forelse($pengumumans as $p)
        <tr>
            <td>{{ $p->judul }}</td>
            <td><span class="badge bg-{{ $warna[$p->status] }}">{{ $p->status }}</span></td>
            <td>
                @if($p->lampiran)
                    <a href="{{ asset('storage/'.$p->lampiran) }}" target="_blank">Lihat</a>
                @else - @endif
            </td>
            <td>{{ $p->user->name ?? '-' }}</td>
            <td>{{ $p->created_at->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('pengumumans.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('pengumumans.destroy', $p) }}" class="d-inline"
                      onsubmit="return confirm('Hapus pengumuman ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center text-muted">Belum ada pengumuman.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $pengumumans->links() }}
@endsection