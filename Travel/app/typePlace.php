<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typePlace extends Model
{
    //use Notifiable;

    public $table = 'typePlace';

    protected $fillable = [
        'idType', 'nameType'
    ];

    public function places()
    {
        return $this->hasMany(Place::class, 'idType');
    }
}
