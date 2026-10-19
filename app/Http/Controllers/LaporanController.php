<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Pengumuman;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    /**
     * PDF satu berita (publik) - tombol "Unduh PDF" di halaman detail berita.
     */
    public function beritaDetail(Request $request, Berita $berita)
    {
        $berita->load(['kategori', 'user']);

        $pdf = Pdf::loadView('pdf.berita-detail', [
            'berita' => $berita,
            'gambar' => $this->gambarBase64($berita->gambar),
        ])->setPaper('a4', 'portrait');

        return $this->keluarkan($request, $pdf, 'berita-' . Str::slug($berita->judul) . '.pdf');
    }

    /**
     * Laporan daftar berita (admin: semua, user: milik sendiri).
     * Filter opsional: kategori_id, dari, sampai.
     */
    public function berita(Request $request)
    {
        $filter = $request->validate([
            'kategori_id' => ['nullable', 'exists:kategoris,id'],
            'dari' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:dari'],
        ]);

        $query = auth()->user()->isAdmin()
            ? Berita::query()
            : Berita::where('user_id', auth()->id());

        $beritas = $query->with(['kategori', 'user'])
            ->when($filter['kategori_id'] ?? null, fn ($q, $v) => $q->where('kategori_id', $v))
            ->when($filter['dari'] ?? null, fn ($q, $v) => $q->whereDate('tanggal', '>=', $v))
            ->when($filter['sampai'] ?? null, fn ($q, $v) => $q->whereDate('tanggal', '<=', $v))
            ->orderBy('tanggal')->orderBy('id')
            ->get();

        $pdf = Pdf::loadView('pdf.berita', [
            'beritas' => $beritas,
            'kategori' => isset($filter['kategori_id']) ? Kategori::find($filter['kategori_id']) : null,
            'dari' => $filter['dari'] ?? null,
            'sampai' => $filter['sampai'] ?? null,
            'pencetak' => auth()->user(),
        ])->setPaper('a4', 'portrait');

        return $this->keluarkan($request, $pdf, 'laporan-berita-' . now()->format('Ymd') . '.pdf');
    }

    public function agenda(Request $request)
    {
        $pdf = Pdf::loadView('pdf.agenda', [
            'agendas' => Agenda::orderBy('tanggal_mulai')->get(),
            'pencetak' => auth()->user(),
        ])->setPaper('a4', 'portrait');

        return $this->keluarkan($request, $pdf, 'laporan-agenda-' . now()->format('Ymd') . '.pdf');
    }

    public function pengumuman(Request $request)
    {
        $pdf = Pdf::loadView('pdf.pengumuman', [
            'pengumumans' => Pengumuman::with('user')->latest()->get(),
            'pencetak' => auth()->user(),
        ])->setPaper('a4', 'portrait');

        return $this->keluarkan($request, $pdf, 'laporan-pengumuman-' . now()->format('Ymd') . '.pdf');
    }

    public function users(Request $request)
    {
        $pdf = Pdf::loadView('pdf.users', [
            'users' => User::withCount('beritas')->orderBy('role')->orderBy('name')->get(),
            'pencetak' => auth()->user(),
        ])->setPaper('a4', 'portrait');

        return $this->keluarkan($request, $pdf, 'laporan-pengguna-' . now()->format('Ymd') . '.pdf');
    }

    // ?aksi=unduh -> langsung diunduh; selain itu dibuka di tab browser
    private function keluarkan(Request $request, $pdf, string $nama)
    {
        return $request->query('aksi') === 'unduh'
            ? $pdf->download($nama)
            : $pdf->stream($nama);
    }

    // Gambar disisipkan sebagai base64 agar aman di Windows (tanpa masalah path)
    private function gambarBase64(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $file = storage_path('app/public/' . $path);
        if (! is_file($file)) {
            return null;
        }

        $mime = mime_content_type($file) ?: 'image/jpeg';

        return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file));
    }
}