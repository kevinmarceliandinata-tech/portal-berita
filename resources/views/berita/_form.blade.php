@csrf
<div class="mb-3">
    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ old('tanggal', isset($berita) ? $berita->tanggal->format('Y-m-d') : date('Y-m-d')) }}"
           class="form-control @error('tanggal') is-invalid @enderror">
    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label>Judul</label>
    <input name="judul" value="{{ old('judul', $berita->judul ?? '') }}"
           class="form-control @error('judul') is-invalid @enderror">
    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label>Kategori</label>
    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
        <option value="">-- Pilih --</option>
        @foreach($kategoris as $k)
            <option value="{{ $k->id }}" @selected(old('kategori_id', $berita->kategori_id ?? '') == $k->id)>{{ $k->nama }}</option>
        @endforeach
    </select>
    @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label>Isi</label>
    <textarea name="isi" rows="8" class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $berita->isi ?? '') }}</textarea>
    @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label>Gambar (maks 2MB)</label>
    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if(!empty($berita->gambar))
        <img src="{{ asset('storage/'.$berita->gambar) }}" height="100" class="mt-2">
    @endif
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>