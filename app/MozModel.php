<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MozModel extends Model 
{
	static $mozPlacesFile;

	public static function setMozPlacesFile($file) {
    	self::$mozPlacesFile = $file;
    }

    public static function getMozPlacesFile() {
    	return self::$mozPlacesFile;
    }

	public function __construct () {

		// if (!Auth::guest()) {
		// 	$user = Auth::user();
		// 	if ($user->moz_places) {

			Config::set('database.connections.moz_places', [
				"driver" => "sqlite",
				"database" => self::$mozPlacesFile,
				"prefix" => "",
	 		]);
	 		$this->setConnection('moz_places');

		// 	}
		// }
	
	}

}

/*
class MozFavicon extends MozModel
{
	protected $table = 'moz_favicons';

	public function place() {
		return $this->belongsTo(Place::class);	
    }
}

class MozHost extends MozModel
{

	protected $table = 'moz_hosts';

}

class MozPlace extends MozModel
{

	protected $table = 'moz_places';
    
    public function visits() {
		return $this->hasMany('\App\Visit');	
    }

    public function favicon() {
    	return $this->hasOne('App\Favicon');
    }

}

class MozVisit extends MozModel
{

	protected $table = 'moz_historyvisits';

	public function place() {
		return $this->belongsTo(Place::class);	
    }
}
*/


