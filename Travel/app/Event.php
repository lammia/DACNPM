<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    public $table = 'Event';

    protected $fillable = [
       'idEvent', 'nameEvent','idPlace', 'timeBeginEvent', 'timeEndEvent', 'description', 'img', 'idAccount'
    ];

    public function places()
    {
        return $this->belongsTo(Place::class, 'idPlace', 'idPlace');
    }

}
