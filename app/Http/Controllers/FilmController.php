<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    // READ: lista keresővel és lapozással
    public function index(Request $request)
    {
        $filmek = Film::withCount('eloadasok')
            ->when($request->filled('q'), fn ($q) => $q->where('cim', 'like', '%' . $request->q . '%'))
            ->orderBy('cim')
            ->paginate(15)
            ->withQueryString();

        return view('film.index', compact('filmek'));
    }

    // CREATE: űrlap
    public function create()
    {
        return view('film.create');
    }

    // CREATE: mentés
    public function store(Request $request)
    {
        Film::create($this->adatok($request));

        return redirect()->route('film.index')->with('siker', 'A film sikeresen hozzáadva.');
    }

    // UPDATE: űrlap
    public function edit(Film $film)
    {
        return view('film.edit', compact('film'));
    }

    // UPDATE: mentés
    public function update(Request $request, Film $film)
    {
        $film->update($this->adatok($request));

        return redirect()->route('film.index')->with('siker', 'A film adatai frissítve.');
    }

    // DELETE
    public function destroy(Film $film)
    {
        $db = $film->eloadasok()->count();

        if ($db > 0) {
            return redirect()->route('film.index')
                ->with('hiba', "A(z) „{$film->cim}” film nem törölhető, mert {$db} előadás tartozik hozzá.");
        }

        $film->delete();

        return redirect()->route('film.index')->with('siker', 'A film törölve.');
    }

    // Közös szerver oldali validáció a létrehozáshoz és a módosításhoz
    private function adatok(Request $request): array
    {
        return $request->validate([
            'cim'   => 'required|string|min:2|max:255',
            'ev'    => 'required|integer|between:1890,2100',
            'hossz' => 'required|integer|between:1,600',
        ], [
            'required' => 'A(z) :attribute megadása kötelező.',
            'integer'  => 'A(z) :attribute egész szám legyen.',
            'between'  => 'A(z) :attribute :min és :max között legyen.',
            'min'      => 'A(z) :attribute legalább :min karakter legyen.',
            'max'      => 'A(z) :attribute legfeljebb :max karakter lehet.',
        ], [
            'cim'   => 'cím',
            'ev'    => 'bemutató éve',
            'hossz' => 'hossz',
        ]);
    }
}