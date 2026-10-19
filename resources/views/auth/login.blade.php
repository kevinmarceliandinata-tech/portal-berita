@extends('layouts.frontend')
@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3 text-center">Login</h4>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label class="form-label">Masuk sebagai</label>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="level" id="level-admin" value="admin"
                                   @checked(old('level') === 'admin')>
                            <label class="btn btn-outline-danger w-100" for="level-admin">Admin</label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="level" id="level-user" value="user"
                                   @checked(old('level', 'user') === 'user')>
                            <label class="btn btn-outline-info w-100" for="level-user">User</label>
                        </div>
                    </div>
                    @error('level')<div class="text-danger small mb-2">{{ $message }}</div>@enderror

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Ingat saya</label>
                    </div>
                    <button class="btn btn-dark w-100">Masuk</button>
                </form>

                <p class="text-center small mt-3 mb-0">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sebagai User</a>
                </p>
            </div>
        </div>

        {{-- Akun demo untuk presentasi; hapus blok ini di produksi --}}
        <div class="card mt-3 border-0 bg-white shadow-sm">
            <div class="card-body small">
                <div class="fw-bold mb-1">Akun demo</div>
                <div><span class="badge bg-danger">Admin</span> admin@berita.test / password</div>
                <div class="mt-1"><span class="badge bg-info text-dark">User</span> user@berita.test / password</div>
            </div>
        </div>
    </div>
</div>
@endsection