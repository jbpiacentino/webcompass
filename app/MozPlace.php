<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use App\MozModel;

class MozPlace extends MozModel
{

	protected $table = 'moz_places';

    public function visits() {
		return $this->hasMany('\App\MozVisit', 'place_id');	
    }

    public function favicon() {
    	return $this->hasOne('App\MozFavicon');
    }
}
