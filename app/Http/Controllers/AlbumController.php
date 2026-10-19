<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('galeries')->latest()->paginate(9);
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);

        unset($data['cover']);
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('album', 'public');
        }

        Album::create($data);

        return redirect()->route('albums.index')
            ->with('success', 'Album berhasil ditambahkan.');
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $data = $this->validasi($request);

        unset($data['cover']);
        if ($request->hasFile('cover')) {
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $data['cover'] = $request->file('cover')->store('album', 'public');
        }

        $album->update($data);

        return redirect()->route('albums.index')
            ->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        // Foto di dalam album tetap ada (album_id menjadi NULL lewat nullOnDelete)
        if ($album->cover) {
            Storage::disk('public')->delete($album->cover);
        }
        $album->delete();

        return redirect()->route('albums.index')
            ->with('success', 'Album berhasil dihapus. Foto di dalamnya tetap ada tanpa album.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama_album' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'cover' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}