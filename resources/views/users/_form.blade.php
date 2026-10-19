@csrf
<div class="mb-3">
    <label class="form-label">Nama</label>
    <input name="name" value="{{ old('name', $user->name ?? '') }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror">
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Level Akses</label>
    <select name="role" class="form-select @error('role') is-invalid @enderror">
        <option value="user" @selected(old('role', $user->role ?? 'user') === 'user')>User (penulis berita)</option>
        <option value="admin" @selected(old('role', $user->role ?? 'user') === 'admin')>Admin (kelola semua)</option>
    </select>
    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Password {{ isset($user) ? '(kosongkan jika tidak diubah)' : '(min. 8 karakter)' }}</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
</div>
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>