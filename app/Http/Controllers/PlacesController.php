<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Place;


class PlacesController extends Controller
{

 	
 	public function __construct() {
 		
		$this->middleware('auth');

    }

    public function index(Request $request) 
    {
		$places = Place::with('visits')->where('user_id',Auth::user()->id)->paginate(10);

		// $host = $request->query('host');
		// if ($host) {
		// 	$host = strrev($host) . '.';
		// 	$places=Place::where('rev_host',$host)->orderBy($request->query('sort','frecency'))->paginate(10);
		// } 
		// else $places = Place::orderBy($request->query('sort','frecency'))->paginate(10); 
		// foreach ($places as $place) {
		// 	$split= parse_url($place->url);
		// 	if (!empty($split['query'])) {
		// 		parse_str($split['query'], $split['query']);
		// 		$place['split_url'] = $split;
		// 	}
		// }
		return view('places.index', compact('places'));    	
 
    } 
	
}
