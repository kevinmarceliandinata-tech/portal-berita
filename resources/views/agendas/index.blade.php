@extends('layouts.app')
@section('title', 'Agenda')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Agenda</h3>
    <a href="{{ route('agendas.create') }}" class="btn btn-primary">+ Tambah Agenda</a>
</div>
<table class="table table-bordered bg-white align-middle">
    <thead><tr><th>Judul</th><th>Mulai</th><th>Selesai</th><th width="150">Aksi</th></tr></thead>
    <tbody>
    @forelse($agendas as $a)
        <tr>
            <td>{{ $a->judul_agenda }}</td>
            <td>{{ $a->tanggal_mulai?->translatedFormat('d M Y H:i') }}</td>
            <td>{{ $a->tanggal_selesai?->translatedFormat('d M Y H:i') ?? '-' }}</td>
            <td>
                <a href="{{ route('agendas.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('agendas.destroy', $a) }}" class="d-inline"
                      onsubmit="return confirm('Hapus agenda ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center text-muted">Belum ada agenda.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $agendas->links() }}
@endsection