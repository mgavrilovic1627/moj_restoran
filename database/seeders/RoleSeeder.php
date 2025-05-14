<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $r1 = new Role();
        $r1->name = "user";
        $r1->save();

        $r2 = new Role();
        $r2->name = "editor";
        $r2->save();

        $r3 = new Role();
        $r3->name = "admin";
        $r3->save();
    }
}
