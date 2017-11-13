<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{	
	public $table = "District";
    protected $fillable = [
        'idDistrict', 'idProvince', 'name'
    ];
    public function provinces()
    {
        return $this->belongsTo(Province::class, 'idProvince', 'idProvince');
    }

}
