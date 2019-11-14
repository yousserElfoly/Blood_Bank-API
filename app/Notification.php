<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'order_id');

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function clients()
    {
        return $this->morphToMany('App\Client', 'clientable')->withPivot('is_read');
    }

}
