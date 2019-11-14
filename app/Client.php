<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('username', 'email', 'date_of_birth', 'blood_type_id', 'last_donation', 'city_id', 'phone', 'pin_code',);

    protected $hidden = [
        'password', 'api_token',
    ];

    public function articles()
    {
        return $this->morphedByMany('App\Article', 'clientable');
    }

    public function governorates()
    {
        return $this->morphedByMany('App\Governorate', 'clientable');
    }

    public function blood_types()
    {
        return $this->morphedByMany('App\BloodType', 'clientable');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Notification', 'clientable')->withPivot('is_read');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

}
