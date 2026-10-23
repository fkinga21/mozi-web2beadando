<?php

namespace App\Http\Controllers;

use App\Models\Eloadas;
use App\Models\Film;
use App\Models\Mozi;
use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
{
    public function index()
    {
        // A diagramok a legutolsó év adatait mutatják, hogy a különböző évek ne adódjanak össze
        $utolso = Eloadas::max('datum');
        $ev = $utolso ? (int) substr($utolso, 0, 4) : (int) date('Y');
        $evben = fn ($q) => $q->whereBetween('datum', ["$ev-01-01", "$ev-12-31"]);

        // 1) Havi bevétel (a hónap kifejezés MySQL-en és SQLite-on is működik)
        $honapKif = DB::connection()->getDriverName() === 'sqlite'
            ? "CAST(strftime('%m', datum) AS INTEGER)"
            : 'MONTH(datum)';

        $havi = Eloadas::selectRaw("$honapKif as honap, SUM(bevetel) as osszeg")
            ->where($evben)
            ->groupBy('honap')
            ->orderBy('honap')
            ->pluck('osszeg', 'honap');

        $honapNevek = ['Jan', 'Feb', 'Már', 'Ápr', 'Máj', 'Jún', 'Júl', 'Aug', 'Szep', 'Okt', 'Nov', 'Dec'];
        $haviCimkek = [];
        $haviAdatok = [];
        foreach ($honapNevek as $i => $nev) {
            $haviCimkek[] = $nev;
            $haviAdatok[] = (int) ($havi[$i + 1] ?? 0);
        }

        // 2) Városonkénti nézőszám (a Mozi modell kapcsolatán keresztül)
        $varosok = Mozi::withSum(['eloadasok' => $evben], 'nezoszam')
            ->get()
            ->groupBy('varos')
            ->map(fn ($mozik) => $mozik->sum('eloadasok_sum_nezoszam'))
            ->sortDesc()
            ->take(10);

        // 3) A 10 legnagyobb bevételű film
        $filmek = Film::withSum(['eloadasok' => $evben], 'bevetel')
            ->orderByDesc('eloadasok_sum_bevetel')
            ->take(10)
            ->get();

        return view('diagram', [
            'ev'            => $ev,
            'haviCimkek'    => $haviCimkek,
            'haviAdatok'    => $haviAdatok,
            'varosCimkek'   => $varosok->keys()->values(),
            'varosAdatok'   => $varosok->values()->map(fn ($v) => (int) $v),
            'filmCimkek'    => $filmek->pluck('cim'),
            'filmAdatok'    => $filmek->pluck('eloadasok_sum_bevetel')->map(fn ($v) => (int) $v),
        ]);
    }
}
