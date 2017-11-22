<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    public $table = 'Rating';

    protected $fillable = [
       'idRating', 'rating','idTypeService', 'idService', 'timeComment', 'idAccount'
    ];

    public function user()
    {
        return $this->belongsTo(Account::class, 'idAccount', 'idAccount');
    }

    public function place()
    {
        return $this->belongsTo(Place::class,'idService', 'idPlace');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'idService', 'idEvent');
    }

}
