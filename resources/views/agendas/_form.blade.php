@csrf
<div class="mb-3">
    <label class="form-label">Judul Agenda</label>
    <input name="judul_agenda" value="{{ old('judul_agenda', $agenda->judul_agenda ?? '') }}"
           class="form-control @error('judul_agenda') is-invalid @enderror">
    @error('judul_agenda')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal &amp; Waktu Mulai</label>
        <input type="datetime-local" name="tanggal_mulai"
               value="{{ old('tanggal_mulai', isset($agenda) ? $agenda->tanggal_mulai?->format('Y-m-d\TH:i') : '') }}"
               class="form-control @error('tanggal_mulai') is-invalid @enderror">
        @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal &amp; Waktu Selesai (opsional)</label>
        <input type="datetime-local" name="tanggal_selesai"
               value="{{ old('tanggal_selesai', isset($agenda) ? $agenda->tanggal_selesai?->format('Y-m-d\TH:i') : '') }}"
               class="form-control @error('tanggal_selesai') is-invalid @enderror">
        @error('tanggal_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Isi Agenda</label>
    <textarea name="isi_agenda" rows="6" class="form-control @error('isi_agenda') is-invalid @enderror">{{ old('isi_agenda', $agenda->isi_agenda ?? '') }}</textarea>
    @error('isi_agenda')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('agendas.index') }}" class="btn btn-secondary">Batal</a>