@csrf
<div class="mb-3">
    <label class="form-label">Album</label>
    <select name="album_id" class="form-select @error('album_id') is-invalid @enderror">
        <option value="">-- Tanpa album --</option>
        @foreach($albums as $a)
            <option value="{{ $a->id }}" @selected(old('album_id', $galery->album_id ?? request('album')) == $a->id)>{{ $a->nama_album }}</option>
        @endforeach
    </select>
    @error('album_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Judul Foto</label>
    <input name="judul" value="{{ old('judul', $galery->judul ?? '') }}"
           class="form-control @error('judul') is-invalid @enderror">
    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">File Foto (maks 2MB){{ isset($galery) ? ' - kosongkan jika tidak diganti' : '' }}</label>
    <input type="file" name="file_path" class="form-control @error('file_path') is-invalid @enderror">
    @error('file_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if(!empty($galery->file_path))
        <img src="{{ asset('storage/'.$galery->file_path) }}" height="120" class="mt-2 rounded">
    @endif
</div>
<div class="mb-3">
    <label class="form-label">Keterangan</label>
    <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $galery->keterangan ?? '') }}</textarea>
    @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('galeries.index') }}" class="btn btn-secondary">Batal</a>