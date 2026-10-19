<div class="card h-100 shadow-sm card-berita">
    @if($b->gambar)
        <img src="{{ asset('storage/'.$b->gambar) }}" class="card-img-top"
             style="height:190px;object-fit:cover" alt="{{ $b->judul }}">
    @else
        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
             style="height:190px">Tanpa gambar</div>
    @endif
    <div class="card-body">
        <span class="badge bg-primary">{{ $b->kategori->nama }}</span>
        <h5 class="card-title mt-2">
            <a href="{{ route('berita.show', $b) }}" class="text-decoration-none text-dark stretched-link">{{ $b->judul }}</a>
        </h5>
        <p class="card-text text-muted small">{{ Str::limit(strip_tags($b->isi), 110) }}</p>
    </div>
    <div class="card-footer bg-white small text-muted">
        {{ $b->tanggal->translatedFormat('d F Y') }} &middot; {{ $b->user->name }}
    </div>
</div>