<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Visit extends Model
{
	public $timestamps = false;
	protected $fillable = [ 'from_visit', 'visit_date', 'visit_type'];
	
	public function place() {
		return $this->belongsTo('App\Place');	
    }
}
