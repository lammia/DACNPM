<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Account extends Model 
{
    public $table = 'Account';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAccount', 'email', 'password', 'phone','img', 'description', 'idProvince', 'idDistrict'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'idProvince', 'idProvince');
    }

    public function districts()
    {
        return $this->belongsTo(District::class, 'idDistrict', 'idDistrict');
    }
}
