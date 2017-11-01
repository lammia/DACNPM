<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    public $table = 'Festival';

    protected $fillable = [
        'idFestival', 'nameFestival','idPlace', 'timeBeginFestival', 'timeEndFestival', 'description', 'img', 'idAccount'
    ];

    public function places()
    {
        return $this->belongsTo(Place::class, 'idPlace', 'idPlace');
    }
}
