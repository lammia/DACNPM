<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{	
	public $table = "Province";
    protected $fillable = [
        'idProvince', 'name'
    ];
    public function districts()
    {
        return $this->hasMany(District::class, 'idDistrict');
    }

}
