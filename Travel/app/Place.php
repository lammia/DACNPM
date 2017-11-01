<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{	
	public $table = "Place";
    protected $fillable = [
        'idPlace', 'namePlace','MoneyToTravel', 'address', 'img','idType', 'description', 'latlog', 'idAccount'
    ];
    public function events()
    {
        return $this->hasMany(Event::class, 'idEvent');
    }

    public function festivals()
    {
        return $this->hasMany(Festival::class, 'idFestival');
    }

    public function type()
    {
        return $this->belongsTo(typePlace::class, 'idType', 'idType');
    }
}
