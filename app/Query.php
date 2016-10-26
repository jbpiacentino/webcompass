<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
	public $timestamps = false;
	protected $fillable = [ 'key', 'value'];

 	public function place () {
 		return $this->belongsTo('App\Place');
 	}
}
