<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eloadas extends Model
{
    protected $table = 'eloadas';
    public $timestamps = false;
    protected $fillable = ['filmid', 'moziid', 'datum', 'nezoszam', 'bevetel'];
    protected $casts = ['datum' => 'date'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'filmid');
    }

    public function mozi()
    {
        return $this->belongsTo(Mozi::class, 'moziid');
    }
}