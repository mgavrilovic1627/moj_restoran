<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        $komentari = Komentar::with(['user', 'sto'])->get();
        return view('admin.komentari.index', compact('komentari'));
    }

    public function edit($id)
    {
        $komentar = Komentar::findOrFail($id);
        return view('admin.komentari.edit', compact('komentar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sadrzaj' => 'required|string|max:1000',
            'ocena' => 'required|integer|min:1|max:5'
        ]);

        $komentar = Komentar::findOrFail($id);
        $komentar->update($request->only(['sadrzaj', 'ocena']));

        return redirect()->route('admin.komentari.index')
            ->with('success', 'Komentar je uspešno ažuriran.');
    }

    public function delete($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return redirect()->route('admin.komentari.index')
            ->with('success', 'Komentar je uspešno obrisan.');
    }
} 