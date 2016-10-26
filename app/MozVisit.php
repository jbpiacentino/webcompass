<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MozVisit extends MozModel
{

	protected $table = 'moz_historyvisits';

	public function place() {
		return $this->belongsTo(MozPlace::class, 'place_id');	
    }
}
