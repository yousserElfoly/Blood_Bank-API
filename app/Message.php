<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model 
{

    protected $table = 'messages';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'subject', 'content');

}