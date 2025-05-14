<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rezervacija;
use App\Models\Gost;
use App\Models\Sto;
use Illuminate\Support\Facades\Auth;

class RezervacijaController extends Controller
{
    public function index()
    {
        $rezervacije = Rezervacija::with(['gost', 'sto'])->get();
        return view('rezervacija.index', [
            'rezervacije' => $rezervacije
        ]);
    }

    public function create()
    {
        $gosti = Gost::all();
        $stolovi = Sto::all();

        return view('rezervacija.create', [
            'gosti' => $gosti,
            'stolovi' => $stolovi
        ]);
    }

    public function store(Request $request)
    {
        if (empty($request->gost_id) || !Gost::find($request->gost_id)) {
            return redirect()->back()->with('error', 'Izaberite validnog gosta.')->withInput();
        }

        if (empty($request->sto_id) || !Sto::find($request->sto_id)) {
            return redirect()->back()->with('error', 'Izaberite validan sto.')->withInput();
        }

        if (empty($request->vreme)) {
            return redirect()->back()->with('error', 'Vreme rezervacije je obavezno.')->withInput();
        }

        $rezervacija = new Rezervacija();
        $rezervacija->gost_id = $request->gost_id;
        $rezervacija->sto_id = $request->sto_id;
        $rezervacija->vreme = $request->vreme;
        $rezervacija->potvrdjeno = $request->potvrdjeno ?? 0;
        $rezervacija->save();
        $role = Auth::user()?->role;
        $prefix = $role === 'editor' ? 'editor' : 'admin';
        return redirect()->route("$prefix.rezervacijas.index")->with('success', 'Rezervacija je uspešno dodata!');
    }

    public function edit($id)
    {
        $rezervacija = Rezervacija::findOrFail($id);
        $gosti = Gost::all();
        $stolovi = Sto::all();

        return view('rezervacija.edit', [
            'rezervacija' => $rezervacija,
            'gosti' => $gosti,
            'stolovi' => $stolovi
        ]);
    }

    public function update(Request $request, $id)
    {
        $rezervacija = Rezervacija::findOrFail($id);

        if (empty($request->gost_id) || !Gost::find($request->gost_id)) {
            return redirect()->back()->with('error', 'Izaberite validnog gosta.')->withInput();
        }

        if (empty($request->sto_id) || !Sto::find($request->sto_id)) {
            return redirect()->back()->with('error', 'Izaberite validan sto.')->withInput();
        }

        if (empty($request->vreme)) {
            return redirect()->back()->with('error', 'Vreme rezervacije je obavezno.')->withInput();
        }

        $rezervacija->gost_id = $request->gost_id;
        $rezervacija->sto_id = $request->sto_id;
        $rezervacija->vreme = $request->vreme;
        $rezervacija->potvrdjeno = $request->potvrdjeno ?? 0;
        $rezervacija->save();
        $role = Auth::user()?->role;
        $prefix = $role === 'editor' ? 'editor' : 'admin';
        return redirect()->route("$prefix.rezervacijas.index")->with('success', 'Rezervacija je uspešno izmenjena!');
    }

    public function destroy($id)
    {
        $rezervacija = Rezervacija::findOrFail($id);
        $rezervacija->delete();

        return redirect()->route('admin.rezervacijas.index')->with('success', 'Rezervacija je uspešno obrisana!');
    }

    public function confirm($id)
{
    $rezervacija = Rezervacija::findOrFail($id);
    $rezervacija->potvrdjeno = true;
    $rezervacija->save();
    $role = Auth::user()?->role;
    $prefix = $role === 'editor' ? 'editor' : 'admin';
    return redirect()->route("$prefix.rezervacijas.index")->with('success', 'Rezervacija je potvrđena!');
}

}

