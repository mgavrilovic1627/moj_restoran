<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sto;
use App\Models\Rezervacija;

class HomeController extends Controller
{
    public function index()
    {
        $danas = date('Y-m-d');
        $vremenski_slotovi = [];
        for ($sat = 10; $sat <= 22; $sat++) {
            $vremenski_slotovi[] = sprintf('%02d:00:00', $sat);
        }
        $stolovi = Sto::all();

        return view('welcome', [
            "stolovi" => $stolovi,
            "vremenski_slotovi" => $vremenski_slotovi,
            "danas" => $danas
        ]);
    }
}
