<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Album;
use App\Models\Berita;
use App\Models\Galery;
use App\Models\Kategori;
use App\Models\Pengumuman;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('dashboard.admin', [
                'stat' => [
                    ['Berita', Berita::count(), 'primary', 'berita.index'],
                    ['Kategori', Kategori::count(), 'info', 'kategori.index'],
                    ['Agenda', Agenda::count(), 'success', 'agendas.index'],
                    ['Pengumuman', Pengumuman::count(), 'warning', 'pengumumans.index'],
                    ['Album', Album::count(), 'secondary', 'albums.index'],
                    ['Foto Galeri', Galery::count(), 'dark', 'galeries.index'],
                    ['Pengguna', User::count(), 'danger', 'users.index'],
                ],
                'beritaTerbaru' => Berita::with(['kategori', 'user'])->latest()->take(5)->get(),
            ]);
        }

        return view('dashboard.user', [
            'totalBerita' => $user->beritas()->count(),
            'beritaTerbaru' => $user->beritas()->with('kategori')->latest()->take(5)->get(),
        ]);
    }
}