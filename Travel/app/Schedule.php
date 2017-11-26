<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{	
	public $table = "Schedule";
  public $incrementing = true;
  protected $fillable = [
      'amountOfPeople', 'money', 'timeBegin', 'timeEnd', 'type'
  ];
  public function listplace()
  {
      return $this->hasMany(listPlace::class, 'idlistPlace');
  }

}
