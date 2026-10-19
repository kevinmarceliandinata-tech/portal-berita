<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-berita { transition: transform .15s, box-shadow .15s; }
        .card-berita:hover { transform: translateY(-4px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important; }
        .hero { background: linear-gradient(135deg, #212529, #495057); }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Kategori</a>
                    <ul class="dropdown-menu">
                        @foreach($menuKategori as $k)
                            <li><a class="dropdown-item" href="{{ route('kategori.show', $k) }}">{{ $k->nama }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('agenda.*') ? 'active' : '' }}" href="{{ route('agenda.index') }}">Agenda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}" href="{{ route('pengumuman.index') }}">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}" href="{{ route('galeri.index') }}">Galeri</a>
                </li>
            </ul>

            <form class="d-flex me-lg-3 my-2 my-lg-0" action="{{ route('home') }}">
                <input class="form-control form-control-sm me-2" name="q" value="{{ request('q') }}" placeholder="Cari berita...">
                <button class="btn btn-sm btn-outline-light">Cari</button>
            </form>

            @auth
                <span class="navbar-text me-2 small">Hai, {{ auth()->user()->name }}</span>
                <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-info text-dark' }} me-3">{{ strtoupper(auth()->user()->role) }}</span>
                <a class="btn btn-warning btn-sm me-2" href="{{ route('dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @else
                <a class="btn btn-outline-light btn-sm me-2" href="{{ route('login') }}">Login</a>
                <a class="btn btn-warning btn-sm" href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<main class="container my-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</main>

<footer class="bg-dark text-white-50 text-center py-3 mt-auto">
    &copy; {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>