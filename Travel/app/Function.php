<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Function extends Model
{
    //
    public $table = "Function";
    protected $fillable = [
        'idFunction', 'nameFunction','controller', 'action'
    ];
}
