<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorize extends Model
{
    //
    public $table = "Authorize";
    protected $fillable = [
        'idAuthorize', 'idGroup','idFuncion', 'isEnable'
    ];
}
