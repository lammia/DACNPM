<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{	
	public $table = "Schedule";
    protected $fillable = [
        'idSchedule','amountOfPeople', 'money', 'timeBegin', 'timeEnd', 'type'
    ];
    public function listplace()
    {
        return $this->hasMany(listPlace::class, 'idSchedule');
    }

}
