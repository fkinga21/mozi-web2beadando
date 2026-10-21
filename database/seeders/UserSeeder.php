<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // updateOrInsert: a seeder többször is futtatható duplikált kulcs hiba nélkül
        $this->felhasznalo('Felhasználó', 'user@mozi.hu', 'user1234', 2);
        $this->felhasznalo('Admin', 'admin@mozi.hu', 'admin1234', 1);
    }

    private function felhasznalo(string $nev, string $email, string $jelszo, int $szerep): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => $email],
            [
                'name'              => $nev,
                'password'          => bcrypt($jelszo),
                'role'              => $szerep,
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]
        );
    }
}
