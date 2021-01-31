<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = ['id'];

    public function countryforuser()
    {
        return $this->hasOne('App\Models\Country', 'id' , 'country');
    }
}
