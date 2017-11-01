<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberGroup extends Model
{
    //
    public $table = "MemberGroup";
    protected $fillable = [
        'idMember', 'idAccount', 'idGroup'
    ];
}
