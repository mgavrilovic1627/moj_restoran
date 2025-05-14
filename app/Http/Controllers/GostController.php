<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gost;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GostController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $gosti = Gost::select('*');
            
            return DataTables::of($gosti)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $role = Auth::user()?->role;
                    $prefix = $role === 'editor' ? 'editor' : 'admin';
                    
                    $btn = '<a href="'.route("$prefix.gosts.edit", $row->id).'" class="btn btn-warning btn-sm">Izmeni</a>';
                    
                    if ($role !== 'editor') {
                        $btn .= ' <form action="'.route("$prefix.gosts.delete", $row->id).'" method="POST" style="display:inline;" onsubmit="return confirm(\'Obrisati gosta?\')">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                        </form>';
                    }
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view("gost.index");
    }

    
    public function create()
    {
        return view('gost.create');
    }

    
    public function store(Request $request)
    {
        if (empty($request->ime)) {
            return redirect()->back()->with('error', 'Ime je obavezno.')->withInput();
        }

        if (empty($request->prezime)) {
            return redirect()->back()->with('error', 'Prezime je obavezno.')->withInput();
        }

        if (empty($request->email) || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Unesite ispravan email.')->withInput();
        }

        if (empty($request->kontakt_telefon)) {
            return redirect()->back()->with('error', 'Kontakt telefon je obavezan.')->withInput();
        }

        $gost = new Gost();
        $gost->ime = $request->ime;
        $gost->prezime = $request->prezime;
        $gost->email = $request->email;
        $gost->kontakt_telefon = $request->kontakt_telefon;
        $gost->save();

        $role = Auth::user()?->role;
        $prefix = $role === 'editor' ? 'editor' : 'admin';

        return redirect()->route("$prefix.gosts.index")->with('success', 'Gost je uspešno dodat!');
    }

    
    public function edit($id)
    {
        $gost = Gost::findOrFail($id);

        return view('gost.edit', [
            "gost" => $gost
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $gost = Gost::findOrFail($id);

        if (empty($request->ime)) {
            return redirect()->back()->with('error', 'Ime je obavezno.')->withInput();
        }

        if (empty($request->prezime)) {
            return redirect()->back()->with('error', 'Prezime je obavezno.')->withInput();
        }

        if (empty($request->email) || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Unesite ispravan email.')->withInput();
        }

        if (empty($request->kontakt_telefon)) {
            return redirect()->back()->with('error', 'Kontakt telefon je obavezan.')->withInput();
        }

        $gost->ime = $request->ime;
        $gost->prezime = $request->prezime;
        $gost->email = $request->email;
        $gost->kontakt_telefon = $request->kontakt_telefon;
        $gost->save();
        $role = Auth::user()?->role;
        $prefix = $role === 'editor' ? 'editor' : 'admin';
        return redirect()->route("$prefix.gosts.index")->with('success', 'Gost je uspešno izmenjen!');
    }
    public function destroy($id)
    {
        $gost = Gost::findOrFail($id);

        foreach ($gost->rezervacije as $r) {
            $r->delete();
        }
        $gost->delete();


        return redirect()->route('admin.gosts.index')->with('success', 'Gost je uspešno obrisan i sve njegove rezervacije!');
    }
}
