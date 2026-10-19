@csrf
<div class="mb-3">
    <label class="form-label">Judul</label>
    <input name="judul" value="{{ old('judul', $pengumuman->judul ?? '') }}"
           class="form-control @error('judul') is-invalid @enderror">
    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        @foreach(['published' => 'Published (tampil di publik)', 'draft' => 'Draft', 'archived' => 'Archived'] as $nilai => $label)
            <option value="{{ $nilai }}" @selected(old('status', $pengumuman->status ?? 'published') === $nilai)>{{ $label }}</option>
        @endforeach
    </select>
    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Isi Pengumuman</label>
    <textarea name="isi" rows="8" class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $pengumuman->isi ?? '') }}</textarea>
    @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Lampiran (PDF/DOC/gambar, maks 5MB)</label>
    <input type="file" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror">
    @error('lampiran')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if(!empty($pengumuman->lampiran))
        <div class="form-text">Lampiran saat ini:
            <a href="{{ asset('storage/'.$pengumuman->lampiran) }}" target="_blank">lihat file</a>
            (unggah file baru untuk menggantinya)
        </div>
    @endif
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('pengumumans.index') }}" class="btn btn-secondary">Batal</a>