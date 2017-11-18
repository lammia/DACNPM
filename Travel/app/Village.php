<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{	
	public $table = "Village";
    protected $fillable = [
        'idVillage', 'idDistrict', 'name'
    ];
    public function districts()
    {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }

}
