<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array('title', 'image', 'content', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function clients()
    {
        return $this->morphToMany('App\Client', 'clientable');
    }

    public function getImagePathAttribute() {

    	return asset('uploads/'. $this->image);
    }
}
