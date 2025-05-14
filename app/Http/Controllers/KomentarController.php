<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Sto;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, $id)
    {
        if (empty($request->sadrzaj)) {
            return redirect()->back()->with('error', 'Komentar je obavezan.');
        }

        if (strlen($request->sadrzaj) > 500) {
            return redirect()->back()->with('error', 'Komentar ne sme biti duži od 500 karaktera.');
        }

        if (!is_numeric($request->ocena) || $request->ocena < 1 || $request->ocena > 5) {
            return redirect()->back()->with('error', 'Ocena mora biti broj između 1 i 5.');
        }

        $sto = Sto::findOrFail($id);

        $komentar = new Komentar([
            'sadrzaj' => $request->sadrzaj,
            'ocena' => $request->ocena,
            'user_id' => auth()->id(),
            'sto_id' => $sto->id
        ]);

        $komentar->save();

        return redirect()->back()->with('success', 'Komentar je uspešno dodat!');
    }

    public function edit($id)
    {
        $komentar = Komentar::findOrFail($id);

      
        if ($komentar->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Nemate dozvolu za izmenu ovog komentara!');
        }

        return view('komentari.edit', [
            'komentar' => $komentar
        ]);
    }

    public function update(Request $request, $id)
    {
        $komentar = Komentar::findOrFail($id);

   
        if ($komentar->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Nemate dozvolu za izmenu ovog komentara!');
        }

   
        if (empty($request->sadrzaj)) {
            return redirect()->back()->with('error', 'Komentar je obavezan.');
        }

        if (strlen($request->sadrzaj) > 500) {
            return redirect()->back()->with('error', 'Komentar ne sme biti duži od 500 karaktera.');
        }

        if (!is_numeric($request->ocena) || $request->ocena < 1 || $request->ocena > 5) {
            return redirect()->back()->with('error', 'Ocena mora biti broj između 1 i 5.');
        }

        $komentar->update([
            'sadrzaj' => $request->sadrzaj,
            'ocena' => $request->ocena
        ]);

        return redirect()->back()->with('success', 'Komentar je uspešno ažuriran!');
    }

    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

       
        if ($komentar->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Nemate dozvolu za brisanje ovog komentara!');
        }

        $komentar->delete();

        return redirect()->back()->with('success', 'Komentar je uspešno obrisan!');
    }
}
