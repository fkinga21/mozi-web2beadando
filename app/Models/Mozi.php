<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mozi extends Model
{
    protected $table = 'mozi';
    public $timestamps = false;
    protected $fillable = ['nev', 'varos', 'ferohely'];

    public function eloadasok()
    {
        return $this->hasMany(Eloadas::class, 'moziid');
    }
}