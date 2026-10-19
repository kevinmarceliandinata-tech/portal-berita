<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
@php $isAdmin = auth()->user()->isAdmin(); @endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ $isAdmin ? 'Admin Panel' : 'Panel Penulis' }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuAdmin">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}"
                       href="{{ route('berita.index') }}">{{ $isAdmin ? 'Berita' : 'Berita Saya' }}</a>
                </li>

                @if($isAdmin)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('kategori.*','agendas.*','pengumumans.*','albums.*','galeries.*') ? 'active' : '' }}"
                           href="#" data-bs-toggle="dropdown">Konten</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori</a></li>
                            <li><a class="dropdown-item" href="{{ route('agendas.index') }}">Agenda</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengumumans.index') }}">Pengumuman</a></li>
                            <li><a class="dropdown-item" href="{{ route('albums.index') }}">Album</a></li>
                            <li><a class="dropdown-item" href="{{ route('galeries.index') }}">Foto Galeri</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                           href="{{ route('users.index') }}">Pengguna</a>
                    </li>
                @endif
            </ul>

            <a href="{{ route('home') }}" class="btn btn-warning btn-sm me-3">&larr; Kembali ke Beranda</a>
            <span class="navbar-text me-2 small">{{ auth()->user()->name }}</span>
            <span class="badge {{ $isAdmin ? 'bg-danger' : 'bg-info text-dark' }} me-3">{{ strtoupper(auth()->user()->role) }}</span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-light">Logout</button>
            </form>
        </div>
    </div>
</nav>

<main class="container pb-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->has('hapus'))
        <div class="alert alert-danger">{{ $errors->first('hapus') }}</div>
    @endif
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>