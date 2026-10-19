<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::with('user')->latest()->paginate(10);
        return view('pengumumans.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('pengumumans.create');
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['user_id'] = auth()->id();

        unset($data['lampiran']);
        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('pengumuman', 'public');
        }

        Pengumuman::create($data);

        return redirect()->route('pengumumans.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumumans.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $this->validasi($request);

        unset($data['lampiran']);
        if ($request->hasFile('lampiran')) {
            if ($pengumuman->lampiran) {
                Storage::disk('public')->delete($pengumuman->lampiran);
            }
            $data['lampiran'] = $request->file('lampiran')->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        return redirect()->route('pengumumans.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->lampiran) {
            Storage::disk('public')->delete($pengumuman->lampiran);
        }
        $pengumuman->delete();

        return redirect()->route('pengumumans.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'lampiran' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);
    }
}