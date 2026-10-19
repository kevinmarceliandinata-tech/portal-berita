<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Album;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $beritas = Berita::with(['kategori', 'user'])
            ->when($request->filled('q'), fn ($q) => $q->where('judul', 'like', '%' . $request->q . '%'))
            ->latest('tanggal')->latest('id')
            ->paginate(6)
            ->withQueryString();

        return view('frontend.home', ['beritas' => $beritas] + $this->sidebar());
    }

    public function show(Berita $berita)
    {
        $berita->load(['kategori', 'user']);

        $terkait = Berita::with(['kategori', 'user'])
            ->where('kategori_id', $berita->kategori_id)
            ->where('id', '!=', $berita->id)
            ->latest('tanggal')->take(3)->get();

        return view('frontend.show', [
            'berita' => $berita,
            'terkait' => $terkait,
        ] + $this->sidebar());
    }

    public function kategori(Kategori $kategori)
    {
        $beritas = $kategori->beritas()->with(['kategori', 'user'])
            ->latest('tanggal')->latest('id')
            ->paginate(6);

        return view('frontend.home', [
            'beritas' => $beritas,
            'aktif' => $kategori,
        ] + $this->sidebar());
    }

    // ===== Agenda =====
    public function agenda()
    {
        $mendatang = Agenda::where(function ($q) {
                $q->where('tanggal_mulai', '>=', now()->startOfDay())
                  ->orWhere('tanggal_selesai', '>=', now());
            })
            ->orderBy('tanggal_mulai')->get();

        $lalu = Agenda::where('tanggal_mulai', '<', now()->startOfDay())
            ->where(fn ($q) => $q->whereNull('tanggal_selesai')->orWhere('tanggal_selesai', '<', now()))
            ->latest('tanggal_mulai')->paginate(6);

        return view('frontend.agenda', compact('mendatang', 'lalu'));
    }

    // ===== Pengumuman =====
    public function pengumuman()
    {
        $pengumumans = Pengumuman::published()->latest()->paginate(8);
        return view('frontend.pengumuman', compact('pengumumans'));
    }

    public function pengumumanShow(Pengumuman $pengumuman)
    {
        abort_unless($pengumuman->status === 'published', 404);
        $pengumuman->load('user');

        return view('frontend.pengumuman-show', compact('pengumuman'));
    }

    // ===== Galeri =====
    public function galeri()
    {
        $albums = Album::withCount('galeries')->latest()->paginate(9);
        return view('frontend.galeri', compact('albums'));
    }

    public function galeriShow(Album $album)
    {
        $galeries = $album->galeries()->latest()->paginate(12);
        return view('frontend.galeri-show', compact('album', 'galeries'));
    }

    private function sidebar(): array
    {
        return [
            'kategoris' => Kategori::withCount('beritas')->orderBy('nama')->get(),
            'terbaru' => Berita::latest('tanggal')->latest('id')->take(5)->get(),
            'agendaMendatang' => Agenda::where('tanggal_mulai', '>=', now()->startOfDay())
                ->orderBy('tanggal_mulai')->take(3)->get(),
            'pengumumanTerbaru' => Pengumuman::published()->latest()->take(3)->get(),
        ];
    }
}