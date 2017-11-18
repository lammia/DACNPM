<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listPlace extends Model
{

    public $table = 'listPlace';

    protected $fillable = [
       'idlistPlace', 'idSchedule','idPlace', 'idEvent', 'idDiscount', 'numDayTravel'
    ];

    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'idSchedule', 'idSchedule');
    }

}