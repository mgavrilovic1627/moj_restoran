<?php

namespace Database\Seeders;

use App\Models\Gost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $g1 = new Gost();
        $g1->ime = "Pera";
        $g1->prezime = "Peric";
        $g1->email = "pperic@raf.rs";
        $g1->kontakt_telefon = "063 654 321";
        $g1->save();

        $g2 = new Gost();
        $g2->ime = "Mika";
        $g2->prezime = "Mikic";
        $g2->email = "mmikic@raf.rs";
        $g2->kontakt_telefon = "063 123 321";
        $g2->save();

        $g3 = new Gost();
        $g3->ime = "Zika";
        $g3->prezime = "Zikic";
        $g3->email = "zzikic@raf.rs";
        $g3->kontakt_telefon = "063 444 321";
        $g3->save();

        $g4 = new Gost();
        $g4->ime = "Jelena";
        $g4->prezime = "Jelenic";
        $g4->email = "jjelenic@raf.rs";
        $g4->kontakt_telefon = "063 111 321";
        $g4->save();

        $g5 = new Gost();
        $g5->ime = "Milica";
        $g5->prezime = "Mitrovic";
        $g5->email = "mmitrovic@raf.rs";
        $g5->kontakt_telefon = "063 222 321";
        $g5->save();
    }
}
