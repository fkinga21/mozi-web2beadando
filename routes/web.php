<?php

use Illuminate\Support\Facades\Route;
use App\Models\Film;
use App\Models\Mozi;
use App\Models\Eloadas;
use App\Http\Controllers\AdatbazisController;
use App\Http\Controllers\KapcsolatController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\FilmController;

Route::get('/', function () {
    return view('fooldal', [
        'filmek'    => Film::count(),
        'mozik'     => Mozi::count(),
        'eloadasok' => Eloadas::count(),
        'nezok'     => Eloadas::sum('nezoszam'),
        'bevetel'   => Eloadas::sum('bevetel'),
    ]);
})->name('home');

Route::get('adatbazis', [AdatbazisController::class, 'index'])->name('adatbazis');
Route::get('kapcsolat', [KapcsolatController::class, 'urlap'])->name('kapcsolat');
Route::post('kapcsolat', [KapcsolatController::class, 'kuldes'])->name('kapcsolat.kuldes');
Route::get('diagram', [DiagramController::class, 'index'])->name('diagram');

Route::middleware(['auth', 'verified'])->group(function () {
    // A bejelentkezés után a Főoldalra kerül a felhasználó
    Route::get('dashboard', function () { return redirect()->route('home'); })->name('dashboard');

    Route::get('uzenetek', [KapcsolatController::class, 'uzenetek'])->name('uzenetek');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('film', FilmController::class)->except(['show']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('login', fn () => view('auth.login'))->name('login');
    Route::get('register', fn () => view('auth.register'))->name('register');
});
