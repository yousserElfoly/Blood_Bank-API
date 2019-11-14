<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function clients()
    {
        return $this->morphToMany('App\Client', 'clientable');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get first name

    // public function clients()
    // {
    //     return $this->hasMany('App\Client');
    // }

}
