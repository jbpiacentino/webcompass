<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use App\MozModel;

class MozHost extends MozModel
{

	protected $table = 'moz_hosts';

}
