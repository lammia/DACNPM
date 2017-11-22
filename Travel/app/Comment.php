<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public $table = 'Comment';

    protected $fillable = [
       'idComment', 'content','idTypeService', 'idService', 'timeComment', 'idAccount'
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
