<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Host;
use App\Place;

class HostsController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
    }
    
    public function index(Request $request) {  	
 
    	$sort = $request->query('sort','host');
        $order = $request->query('order','asc');
        $hostname = $request->query('host','');

        if ($hostname) $hosts=Host::with('places')->where('host',$hostname)->orderBy($sort,$order)->paginate(20);
        else $hosts = Host::with('places')->orderBy($sort,$order)->paginate(20); 
        
        // if ($sort == 'visits') {
        //     $hosts = $hosts->sortBy(function ($host, $id) {
        //         return $host['places']->count();
        //     });
        // }
        return view('hosts.index', compact('hosts'));    	
 
    } 
}
