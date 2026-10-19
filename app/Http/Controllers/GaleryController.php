<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    public function index(Request $request)
    {
        $galeries = Galery::with('album')
            ->when($request->filled('album'), fn ($q) => $q->where('album_id', $request->album))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('galeries.index', [
            'galeries' => $galeries,
            'albums' => Album::orderBy('nama_album')->get(),
        ]);
    }

    public function create()
    {
        return view('galeries.create', [
            'albums' => Album::orderBy('nama_album')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'album_id' => ['nullable', 'exists:albums,id'],
            'judul' => ['nullable', 'string', 'max:255'],
            'file_path' => ['required', 'image', 'max:2048'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $data['file_path'] = $request->file('file_path')->store('galeri', 'public');

        Galery::create($data);

        return redirect()->route('galeries.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(Galery $galery)
    {
        return view('galeries.edit', [
            'galery' => $galery,
            'albums' => Album::orderBy('nama_album')->get(),
        ]);
    }

    public function update(Request $request, Galery $galery)
    {
        $data = $request->validate([
            'album_id' => ['nullable', 'exists:albums,id'],
            'judul' => ['nullable', 'string', 'max:255'],
            'file_path' => ['nullable', 'image', 'max:2048'],
            'keterangan' => ['nullable', 'string'],
        ]);

        unset($data['file_path']);
        if ($request->hasFile('file_path')) {
            Storage::disk('public')->delete($galery->file_path);
            $data['file_path'] = $request->file('file_path')->store('galeri', 'public');
        }

        $galery->update($data);

        return redirect()->route('galeries.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Galery $galery)
    {
        Storage::disk('public')->delete($galery->file_path);
        $galery->delete();

        return redirect()->route('galeries.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}