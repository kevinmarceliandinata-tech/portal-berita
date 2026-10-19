@php $daftarKategori = \App\Models\Kategori::orderBy('nama')->get(); @endphp

<form method="GET" action="{{ route('laporan.berita') }}" target="_blank" class="card card-body shadow-sm mb-3">
    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small mb-1">Kategori</label>
            <select name="kategori_id" class="form-select form-select-sm">
                <option value="">Semua kategori</option>
                @foreach($daftarKategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small mb-1">Dari tanggal</label>
            <input type="date" name="dari" class="form-control form-control-sm">
        </div>
        <div class="col-md-3">
            <label class="form-label small mb-1">Sampai tanggal</label>
            <input type="date" name="sampai" class="form-control form-control-sm">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" name="aksi" value="lihat" class="btn btn-sm btn-outline-danger">Lihat PDF</button>
            <button type="submit" name="aksi" value="unduh" class="btn btn-sm btn-danger">Unduh PDF</button>
        </div>
    </div>
</form>