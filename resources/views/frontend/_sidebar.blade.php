<div class="card shadow-sm mb-4">
    <div class="card-header fw-bold">Kategori</div>
    <ul class="list-group list-group-flush">
        @foreach($kategoris as $k)
            <li class="list-group-item d-flex justify-content-between">
                <a href="{{ route('kategori.show', $k) }}" class="text-decoration-none">{{ $k->nama }}</a>
                <span class="badge bg-secondary rounded-pill">{{ $k->beritas_count }}</span>
            </li>
        @endforeach
    </ul>
</div>

<div class="card shadow-sm">
    <div class="card-header fw-bold">Berita Terbaru</div>
    <ul class="list-group list-group-flush">
        @foreach($terbaru as $t)
            <li class="list-group-item">
                <a href="{{ route('berita.show', $t) }}" class="text-decoration-none text-dark">{{ $t->judul }}</a>
                <div class="small text-muted">{{ $t->tanggal->translatedFormat('d M Y') }}</div>
            </li>
        @endforeach
    </ul>
</div>

@if(isset($agendaMendatang) && $agendaMendatang->count())
<div class="card shadow-sm mt-4">
    <div class="card-header fw-bold">Agenda Mendatang</div>
    <ul class="list-group list-group-flush">
        @foreach($agendaMendatang as $a)
            <li class="list-group-item">
                <div>{{ $a->judul_agenda }}</div>
                <div class="small text-muted">{{ $a->tanggal_mulai->translatedFormat('d M Y, H:i') }}</div>
            </li>
        @endforeach
    </ul>
    <div class="card-footer bg-white"><a href="{{ route('agenda.index') }}" class="small">Lihat semua agenda &rarr;</a></div>
</div>
@endif

@if(isset($pengumumanTerbaru) && $pengumumanTerbaru->count())
<div class="card shadow-sm mt-4">
    <div class="card-header fw-bold">Pengumuman</div>
    <ul class="list-group list-group-flush">
        @foreach($pengumumanTerbaru as $p)
            <li class="list-group-item">
                <a href="{{ route('pengumuman.show', $p) }}" class="text-decoration-none text-dark">{{ $p->judul }}</a>
                <div class="small text-muted">{{ $p->created_at->translatedFormat('d M Y') }}</div>
            </li>
        @endforeach
    </ul>
    <div class="card-footer bg-white"><a href="{{ route('pengumuman.index') }}" class="small">Lihat semua pengumuman &rarr;</a></div>
</div>
@endif