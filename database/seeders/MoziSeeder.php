<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MoziSeeder extends Seeder
{
    public function run(): void
    {
        // A táblák ürítése, hogy a seeder többször is futtatható legyen duplikált adatok nélkül
        Schema::disableForeignKeyConstraints();
        DB::table('eloadas')->truncate();
        DB::table('film')->truncate();
        DB::table('mozi')->truncate();
        Schema::enableForeignKeyConstraints();

        $this->betolt('film', 'film.tsv', ['id', 'cim', 'ev', 'hossz']);
        $this->betolt('mozi', 'mozi.tsv', ['id', 'nev', 'varos', 'ferohely']);
        $this->betolt('eloadas', 'eloadas.tsv', ['filmid', 'moziid', 'datum', 'nezoszam', 'bevetel']);
    }

    private function betolt(string $tabla, string $fajl, array $oszlopok, int $csomag = 1000): void
    {
        $f = fopen(database_path('seeders/data/' . $fajl), 'r');
        fgetcsv($f, 0, "\t"); // a fejléc sor kihagyása

        $adatok = [];
        while (($sor = fgetcsv($f, 0, "\t")) !== false) {
            if (count($sor) !== count($oszlopok)) {
                continue;
            }
            $adatok[] = array_combine($oszlopok, $sor);

            if (count($adatok) >= $csomag) {
                DB::table($tabla)->insert($adatok);
                $adatok = [];
            }
        }
        if (!empty($adatok)) {
            DB::table($tabla)->insert($adatok);
        }
        fclose($f);
    }
}