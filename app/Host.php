<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Host extends Model
{
	public $timestamps = false;
	protected $fillable = ['host'];
	
	public static function boot()
    {
        parent::boot();    
    
        // static::deleting(function($model)
        // {
        //    $model->places()->delete();
        // });
    }

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function places() {
		return $this->hasMany('App\Place');
	}

	public function visits() {
		return $this->hasManyThrough('App\Visit', 'App\Place');
	}

}
