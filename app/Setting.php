<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('title', 'about_us', 'logo', 'email', 'phone', 'facebook_url', 'twitter_url', 'youtube_url', 'instagram_url');

}
