<?php

namespace Database\Seeders;

use App\Models\Komentar;
use App\Models\Sto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $k1 = new Komentar();
        $k1->sadrzaj = "Veoma prijatan ambijent, sto je bio odlican.";
        $k1->ocena = 5;
        $k1->user_id = 1;
        $k1->sto_id = 1;
        $k1->save();

        $k2 = new Komentar();
        $k2->sadrzaj = "Stolica je skripala, ali sto je bio stabilan.";
        $k2->ocena = 3;
        $k2->user_id = 2;
        $k2->sto_id = 2;
        $k2->save();

        $k3 = new Komentar();
        $k3->sadrzaj = "Odlicna pozicija stola, miran deo lokala.";
        $k3->ocena = 4;
        $k3->user_id = 3;
        $k3->sto_id = 3;
        $k3->save();

        $k4 = new Komentar();
        $k4->sadrzaj = "Sto je bio ispod klime, nije mi prijalo.";
        $k4->ocena = 2;
        $k4->user_id = 1;
        $k4->sto_id = 4;
        $k4->save();

        $k5 = new Komentar();
        $k5->sadrzaj = "Savrsen za vece drustvo, sve pohvale.";
        $k5->ocena = 5;
        $k5->user_id = 2;
        $k5->sto_id = 5;
        $k5->save();

        $k6 = new Komentar();
        $k6->sadrzaj = "Malo je tesno, ali lepo izgleda.";
        $k6->ocena = 3;
        $k6->user_id = 3;
        $k6->sto_id = 2;
        $k6->save();

        $k7 = new Komentar();
        $k7->sadrzaj = "Previse blizu WC-a, smeta miris.";
        $k7->ocena = 1;
        $k7->user_id = 1;
        $k7->sto_id = 1;
        $k7->save();

        $k8 = new Komentar();
        $k8->sadrzaj = "Lep pogled kroz prozor, preporucujem.";
        $k8->ocena = 4;
        $k8->user_id = 2;
        $k8->sto_id = 4;
        $k8->save();

        $k9 = new Komentar();
        $k9->sadrzaj = "Nije bilo dovoljno mesta za sve nas.";
        $k9->ocena = 2;
        $k9->user_id = 3;
        $k9->sto_id = 3;
        $k9->save();

        $k10 = new Komentar();
        $k10->sadrzaj = "Sto i konobar savrseni, odlican dozivljaj.";
        $k10->ocena = 5;
        $k10->user_id = 1;
        $k10->sto_id = 2;
        $k10->save();

    }
}
