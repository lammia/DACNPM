<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public $table = "Group";
    protected $fillable = [
        'idGroup', 'nameGroup','note'
    ];
}
