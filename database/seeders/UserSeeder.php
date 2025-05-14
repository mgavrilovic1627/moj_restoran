<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $u1 = new User();
        $u1->name = "Obican korisnik";
        $u1->email = "user@pwa.rs";
        $u1->password = Hash::make("user");
        $u1->role = "user";
        $u1->save();

        $u2 = new User();
        $u2->name = "Urednik";
        $u2->email = "editor@pwa.rs";
        $u2->password = Hash::make("editor");
        $u2->role = "editor";
        $u2->save();

        $u3 = new User();
        $u3->name = "Administrator";
        $u3->email = "admin@pwa.rs";
        $u3->password = Hash::make("admin");
        $u3->role = "admin";
        $u3->save();
    }
}
