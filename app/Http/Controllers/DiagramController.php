<?php

namespace App\Http\Controllers;

use App\Models\Eloadas;
use App\Models\Film;
use App\Models\Mozi;

class DiagramController extends Controller
{
    public function index()
    {
        // 1) Havi bevétel
        $havi = Eloadas::selectRaw('MONTH(datum) as honap, SUM(bevetel) as osszeg')
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
        $varosok = Mozi::withSum('eloadasok', 'nezoszam')
            ->get()
            ->groupBy('varos')
            ->map(fn ($mozik) => $mozik->sum('eloadasok_sum_nezoszam'))
            ->sortDesc()
            ->take(10);

        // 3) A 10 legnagyobb bevételű film
        $filmek = Film::withSum('eloadasok', 'bevetel')
            ->orderByDesc('eloadasok_sum_bevetel')
            ->take(10)
            ->get();

        return view('diagram', [
            'haviCimkek'    => $haviCimkek,
            'haviAdatok'    => $haviAdatok,
            'varosCimkek'   => $varosok->keys()->values(),
            'varosAdatok'   => $varosok->values()->map(fn ($v) => (int) $v),
            'filmCimkek'    => $filmek->pluck('cim'),
            'filmAdatok'    => $filmek->pluck('eloadasok_sum_bevetel')->map(fn ($v) => (int) $v),
        ]);
    }
}