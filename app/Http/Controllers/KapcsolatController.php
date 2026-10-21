<?php

namespace App\Http\Controllers;

use App\Models\Uzenet;
use Illuminate\Http\Request;

class KapcsolatController extends Controller
{
    public function urlap()
    {
        return view('kapcsolat');
    }

    public function kuldes(Request $request)
    {
        $adatok = $request->validate([
            'nev'    => 'required|string|min:3|max:100',
            'email'  => 'required|email|max:150',
            'uzenet' => 'required|string|min:10|max:2000',
        ], [
            'required' => 'A(z) :attribute megadása kötelező.',
            'min'      => 'A(z) :attribute legalább :min karakter legyen.',
            'max'      => 'A(z) :attribute legfeljebb :max karakter lehet.',
            'email'    => 'Kérlek, érvényes e-mail címet adj meg.',
        ], [
            'nev'    => 'név',
            'email'  => 'e-mail cím',
            'uzenet' => 'üzenet',
        ]);

        Uzenet::create($adatok);

        return redirect()->route('kapcsolat')->with('siker', 'Köszönjük, az üzeneted megérkezett!');
    }

    public function uzenetek()
    {
        $uzenetek = Uzenet::orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('uzenetek', compact('uzenetek'));
    }
}