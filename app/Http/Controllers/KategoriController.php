<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('beritas')->orderBy('nama')->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama' => ['required', 'max:100', 'unique:kategoris,nama']]);
        Kategori::create($data);

        return back()->with('success', 'Kategori ditambahkan.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('success', 'Kategori dihapus.');
    }
}