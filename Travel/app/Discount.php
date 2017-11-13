<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $table = 'Discount';

    protected $fillable = [
        'idDiscount', 'percentDiscount','idPlace', 'timeBeginDiscount', 'timeEndDiscount', 'idAccount'
    ];

    public function places()
    {
        return $this->belongsTo(Place::class, 'idPlace', 'idPlace');
    }
}
