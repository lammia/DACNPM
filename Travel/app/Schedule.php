<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{	
	public $table = "Schedule";
  public $incrementing = true;
  protected $fillable = [
      'idSchedule', 'idlistPlace', 'amountOfPeople', 'money', 'timeBegin', 'timeEnd', 'type'
  ];
  public function listplaces()
  {
      return $this->hasMany(listPlace::class, 'idlistPlace', 'idlistPlace');
  }

}
