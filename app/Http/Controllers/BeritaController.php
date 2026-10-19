<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        // Admin melihat semua berita; user hanya berita miliknya
        $query = auth()->user()->isAdmin()
            ? Berita::query()
            : Berita::where('user_id', auth()->id());

        $beritas = $query->with(['kategori', 'user'])
            ->latest('tanggal')->latest('id')
            ->paginate(8);

        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create', ['kategoris' => Kategori::orderBy('nama')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['user_id'] = auth()->id();

        unset($data['gambar']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $this->otorisasi($berita);

        return view('berita.edit', [
            'berita' => $berita,
            'kategoris' => Kategori::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Berita $berita)
    {
        $this->otorisasi($berita);
        $data = $this->validasi($request);

        unset($data['gambar']);
        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $this->otorisasi($berita);

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // Admin boleh semua; user hanya berita miliknya
    private function otorisasi(Berita $berita): void
    {
        abort_unless(
            auth()->user()->isAdmin() || $berita->user_id === auth()->id(),
            403,
            'Anda hanya dapat mengubah berita milik sendiri.'
        );
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'tanggal' => ['required', 'date'],
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'max:2048'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
        ]);
    }
}