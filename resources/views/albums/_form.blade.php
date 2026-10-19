@csrf
<div class="mb-3">
    <label class="form-label">Nama Album</label>
    <input name="nama_album" value="{{ old('nama_album', $album->nama_album ?? '') }}"
           class="form-control @error('nama_album') is-invalid @enderror">
    @error('nama_album')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $album->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Cover (maks 2MB)</label>
    <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror">
    @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if(!empty($album->cover))
        <img src="{{ asset('storage/'.$album->cover) }}" height="100" class="mt-2 rounded">
    @endif
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('albums.index') }}" class="btn btn-secondary">Batal</a>