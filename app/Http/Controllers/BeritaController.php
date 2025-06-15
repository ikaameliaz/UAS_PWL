<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('kategori', 'user')->latest()->get();
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('berita.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambar,
            'kategori_id' => $request->kategori_id,
            'user_id' => Auth::id(),
            'status' => 'draft'
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan sebagai draft.');
    }

    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        $kategoris = Kategori::all();
        return view('berita.edit', compact('berita', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate.');
    }


    public function approval()
    {
        $beritas = Berita::where('status', 'draft')->with('kategori', 'user')->latest()->get();

        if (!view()->exists('berita.approval')) {
            abort(500, 'View berita.approval tidak ditemukan.');
        }

        return view('berita.approval', compact('beritas'));
    }


    public function publish($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->update(['status' => 'published']);

        return redirect()->back()->with('success', 'Berita berhasil dipublish.');
    
    }
    public function publik()
    {
        $beritas = Berita::where('status', 'published')->latest()->with('kategori', 'user')->get();
        return view('berita.publik', compact('beritas'));
    }

     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckRole::class . ':editor')->only(['approval', 'publish']);
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
