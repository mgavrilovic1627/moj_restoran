<?php

namespace Database\Seeders;

use App\Models\Sto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $s1 = new Sto();
        $s1->naziv_stola = "Sto 1";
        $s1->broj_mesta = 10;
        $s1->za_pusace = true;
        $s1->save();
        
        $s2 = new Sto();
        $s2->naziv_stola = "Sto 2";
        $s2->broj_mesta = 5;
        $s2->za_pusace = true;
        $s2->save();

        $s3 = new Sto();
        $s3->naziv_stola = "Sto 3";
        $s3->broj_mesta = 4;
        $s3->za_pusace = false;
        $s3->save();

        $s4 = new Sto();
        $s4->naziv_stola = "Sto 4";
        $s4->broj_mesta = 6;
        $s4->za_pusace = false;
        $s4->save();

        $s5 = new Sto();
        $s5->naziv_stola = "Sto 5";
        $s5->broj_mesta = 9;
        $s5->za_pusace = false;
        $s5->save();

        $s6 = new Sto();
        $s6->naziv_stola = "Sto 6";
        $s6->broj_mesta = 5;
        $s6->za_pusace = true;
        $s6->save();
    }
}
