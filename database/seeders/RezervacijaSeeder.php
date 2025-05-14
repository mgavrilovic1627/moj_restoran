<?php

namespace Database\Seeders;

use App\Models\Rezervacija;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RezervacijaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $danas = date('Y-m-d');

        $r1 = new Rezervacija();
        $r1->sto_id = 1;
        $r1->gost_id = 1;
        $r1->vreme = $danas . " 11:00:00";
        $r1->potvrdjeno = false;
        $r1->save();

        $r2 = new Rezervacija();
        $r2->sto_id = 1;
        $r2->gost_id = 2;
        $r2->vreme = $danas . " 13:00:00";
        $r2->potvrdjeno = true;
        $r2->save();

        $r3 = new Rezervacija();
        $r3->sto_id = 2;
        $r3->gost_id = 3;
        $r3->vreme = $danas . " 12:00:00";
        $r3->potvrdjeno = false;
        $r3->save();

        $r4 = new Rezervacija();
        $r4->sto_id = 3;
        $r4->gost_id = 2;
        $r4->vreme = $danas . " 14:00:00";
        $r4->potvrdjeno = false;
        $r4->save();

        $r5 = new Rezervacija();
        $r5->sto_id = 4;
        $r5->gost_id = 5;
        $r5->vreme = $danas . " 15:00:00";
        $r5->potvrdjeno = false;
        $r5->save();

        $r6 = new Rezervacija();
        $r6->sto_id = 5;
        $r6->gost_id = 3;
        $r6->vreme = $danas . " 16:00:00";
        $r6->potvrdjeno = false;
        $r6->save();

        $r7 = new Rezervacija();
        $r7->sto_id = 4;
        $r7->gost_id = 1;
        $r7->vreme = $danas . " 17:00:00";
        $r7->potvrdjeno = false;
        $r7->save();
    }
}
