<?php

namespace App\Http\Controllers;

use App\Models\Rezervacija;
use App\Models\Sto;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // Dobavi sve stolove
        $stolovi = Sto::all();

        $data = [];

        // Za svaki sto izbrojimo koliko rezervacija ima
        foreach ($stolovi as $sto) {
            $brojRezervacija = Rezervacija::where('sto_id', $sto->id)->count();
            $data[] = [
                'naziv' => $sto->naziv_stola,
                'broj' => $brojRezervacija
            ];
        }

        return view('admin.chart.chart', [
            "data" => $data
        ]);
    }
}
