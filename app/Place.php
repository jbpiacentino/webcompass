<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Place extends Model
{
    
    const SCHEME_HTTP = 1;
    const SCHEME_HTTPS = 2;
    const SCHEME_UNKNOWN = -1;

    public $timestamps = false;
	protected $fillable = [ 'path', 'title'];
	
    public static function boot()
    {
        parent::boot();    
    
        // static::deleting(function($model)
        // {
        //    $model->visits()->delete();
        //    $model->queries()->delete();
        // });
    }  

	public function user() {
		return $this->belongsTo('App\User');
	}

    public function visits() {
		return $this->hasMany('App\Visit');	
    }

    public function host() {
    	return $this->belongsTo('App\Host');
    }

    public function queries() {
    	return $this->hasMany('App\Query');
    }

}
