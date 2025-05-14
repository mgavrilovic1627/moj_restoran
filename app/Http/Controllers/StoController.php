<?php

namespace App\Http\Controllers;

use App\Models\Sto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoController extends Controller
{
    public function index()
    {
        $stolovi = Sto::all();
        $danas = date('Y-m-d');
        $vremenski_slotovi = [];
        for ($sat = 10; $sat <= 22; $sat++) {
            $vremenski_slotovi[] = sprintf('%02d:00:00', $sat);
        }

        return view('stos.index', [
            'stolovi' => $stolovi,
            'vremenski_slotovi' => $vremenski_slotovi,
            'danas' => $danas
        ]);
    }

    function create() {
        return view('sto.create');
    }

    public function store(Request $request)
    {
        if (empty($request->naziv_stola)) {
            return redirect()->back()->with('error', 'Naziv stola je obavezan.');
        }
    
        if (!is_numeric($request->broj_mesta) || $request->broj_mesta < 1) {
            return redirect()->back()->with('error', 'Broj mesta mora biti broj veći od 0.');
        }
    
        if ($request->za_pusace !== '0' && $request->za_pusace !== '1') {
            return redirect()->back()->with('error', 'Molimo izaberite validnu opciju za pušače.');
        }
        $sto = new Sto();
        $sto->naziv_stola = $request->naziv_stola;
        $sto->broj_mesta = $request->broj_mesta;
        $sto->za_pusace = $request->za_pusace;
        $sto->save();
        
    $role = Auth::user()?->role;
    $prefix = $role === 'editor' ? 'editor' : 'admin';

        return redirect()->route("$prefix.stos.index")->with('success', 'Sto je uspešno dodat!');
    }

    public function edit($id)
    {
        $sto = Sto::findOrFail($id);
    
        return view('sto.edit', [
            "sto" => $sto
        ]);
    }
    public function update(Request $request, $id)
    {
        $sto = Sto::findOrFail($id);
        if (empty($request->naziv_stola)) {
            return redirect()->back()->with('error', 'Naziv stola je obavezan.')->withInput();
        }
        if (!is_numeric($request->broj_mesta) || $request->broj_mesta < 1) {
            return redirect()->back()->with('error', 'Broj mesta mora biti broj veći od 0.')->withInput();
        }
        if ($request->za_pusace !== '0' && $request->za_pusace !== '1') {
            return redirect()->back()->with('error', 'Molimo izaberite validnu opciju za pušače.')->withInput();
        }
        $sto->naziv_stola = $request->naziv_stola;
        $sto->broj_mesta = $request->broj_mesta;
        $sto->za_pusace = $request->za_pusace;
        $sto->save();
        $role = Auth::user()?->role;
        $prefix = $role === 'editor' ? 'editor' : 'admin';
        return redirect()->route("$prefix.stos.index")->with('success', 'Sto je uspešno izmenjen!');
    }

    public function destroy($id)
    {
        $sto = Sto::findOrFail($id);

        foreach ($sto->rezervacije as $r) {
            $r->delete();
        }
        $sto->delete();
        return redirect()->route('admin.stos.index')->with('success', 'Sto je uspešno obrisan i sve rezervacije za njega!');
    }

    public function show($id)
    {
        $sto = Sto::findOrFail($id);
        $danas = date('Y-m-d');
        $vremenski_slotovi = [];
        for ($sat = 10; $sat <= 22; $sat++) {
            $vremenski_slotovi[] = sprintf('%02d:00:00', $sat);
        }

        return view('stos.show', [
            'sto' => $sto,
            'vremenski_slotovi' => $vremenski_slotovi,
            'danas' => $danas
        ]);
    }

    public function reservations()
    {
        $stos = Sto::with(['rezervacije' => function($query) {
            $query->where('vreme', '>=', now()->startOfDay())
                  ->orderBy('vreme', 'asc');
        }, 'komentari.user'])->get();

        $vremenskiSlotovi = [
            '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', 
            '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'
        ];

        return view('stos.reservations', [
            'stos' => $stos,
            'vremenskiSlotovi' => $vremenskiSlotovi,
            'danas' => now()->format('Y-m-d')
        ]);
    }
}
