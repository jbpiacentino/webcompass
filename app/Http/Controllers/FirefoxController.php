<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

use Carbon\Carbon;

use Log;
use Mail;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

use App\MozHost;
use App\MozPlace;
use App\MozVisit;

use App\Place;
use App\Host;
use App\Visit;

use App\Jobs\ImportMozPlaces;

class FirefoxController extends Controller
{
    
    public function __construct() {    
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('firefox.index');
    }

    public function importMozPlaces(Request $request)
    {
        Log::info("Dispatching job", $request->file);
        $this->dispatch(new ImportMozPlaces());
        Log::info("Job dispatched");

        return response()->json(['status' => 'ok']);
    }
    

    public function importProgress(Request $request) {
        if ($request->ajax()) {
            return response()->json(['progress' => Auth::user()->import_progress]);
        }
        else return view('firefox.index');
    }
    
}
