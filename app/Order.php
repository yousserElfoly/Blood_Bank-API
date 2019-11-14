<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('full_name', 'blood_type_id', 'age', 'quantity', 'hospital_name', 'hospital_address', 'latitude', 'longitude', 'city_id', 'phone', 'notes', 'client_id');

    public function blood_type()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function notifications()
    {
        return $this->hasOne('App\Notification');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}
