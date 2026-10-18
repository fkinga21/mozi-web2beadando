<?php

namespace App\Http\Controllers;

use App\Models\Eloadas;
use App\Models\Film;
use App\Models\Mozi;
use Illuminate\Http\Request;

class AdatbazisController extends Controller
{
    public function index(Request $request)
    {
        $filmek = Film::withCount('eloadasok')
            ->withSum('eloadasok', 'bevetel')
            ->orderBy('cim')
            ->get();

        $mozik = Mozi::withSum('eloadasok', 'nezoszam')
            ->withSum('eloadasok', 'bevetel')
            ->orderBy('varos')
            ->orderBy('nev')
            ->get();

        $eloadasok = Eloadas::with(['film', 'mozi'])
            ->when($request->filled('mozi'), fn ($q) => $q->where('moziid', $request->mozi))
            ->when($request->filled('film'), fn ($q) => $q->where('filmid', $request->film))
            ->orderBy('datum', 'desc')
            ->orderBy('id')
            ->paginate(25)
            ->withQueryString();

        return view('adatbazis', compact('filmek', 'mozik', 'eloadasok'));
    }
}