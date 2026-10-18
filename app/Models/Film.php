<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film';
    public $timestamps = false;
    protected $fillable = ['cim', 'ev', 'hossz'];

    public function eloadasok()
    {
        return $this->hasMany(Eloadas::class, 'filmid');
    }
}