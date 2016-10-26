<?php

namespace App\Console\Commands;

use Illuminate\Support\Collection;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

use App\MozModel;
use App\MozHost;
use App\MozPlace;
use App\MozVisit;

use App\Place;
use App\Host;
use App\Visit;
use App\Query;

class importHistoryFirefox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importHistory:firefox 
            {user : the id of the user} 
            {places : path to Firefox places.sqlite}
            {--force : wipes and replace existing places}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports Firefox places.sqlite history file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->argument('user');
        $placesFile = $this->argument('places');
        $this->info('Processing ' . $placesFile . ' for user ' . $userId);

        $user = Auth::loginUsingId($userId);
        if (!$user) {
            $this->error( 'User ' . $userId . ' does not exist.');
            exit(1);
        }

        if ($this->option('force') && $user->hosts()->count()) {
            $user->hosts()->chunk(200, function ($hosts) {
              foreach($hosts as $host) $host->delete();
            });
        }

        if ($user->hosts()->count()) {
            $this->error( 'User ' . $userId . ' already has a places. Use --force option to replace them.');
            exit(1);   
        }

        if (!file_exists($placesFile)) {
            $this->error( $placesFile . ' does not exist.');
            exit(1);      
        }

        $this->import($user, $placesFile, progress);

    }

    public function progress($total, $chunk = null) {
        static $progress_bar;

        if ($current == null) {
            $progress_bar = $this->output->createProgressBar($total);
            $progress_bar->start();
        }
        elseif ($total == $chunk) {
            $progress->finish();
        }
        else {
            $progress->advance($chunk);
        }

    }

    public function import($user, $file, $callback)
    { 
        MozModel::setMozPlacesFile($file);

        //$progress->start();
        //$progress = $this->output->createProgressBar(MozPlace::count());
        $progress = $callback(MozPlace::count());

        $user->import_progress = 0;
        $user->save();

        MozPlace::with('visits')->chunk(200, function ($mozPlaces) use ($progress, $user) {

            $queries = array();
            $visits = array();
            
            foreach ($mozPlaces as $mozPlace) {
                
                $place = new Place ($mozPlace->toArray());

                $host = $user->hosts()->where(['host' => substr(strrev($mozPlace->rev_host),1)])
                    ->first();
                if (!$host) $host= $user->hosts()->create(['host' => substr(strrev($mozPlace->rev_host),1)]);

                $place->host_id = $host->id;

                $split= parse_url($mozPlace->url);
                switch ($split['scheme']) {
                    case 'https': $place->scheme = PLACE::SCHEME_HTTPS; break;
                    case 'http': $place->scheme = PLACE::SCHEME_HTTP; break;
                    default: $place->scheme = PLACE::SCHEME_UNKNOWN; break;
                }
                $place->path = $split['path'];
                $place = Auth::user()->places()->save($place);

                if (!empty($split['query'])) {
                    parse_str($split['query'], $split['query']);
                    foreach ($split['query'] as $key => $value)
                         // $place->queries()->create(['key' => $key, 'value' => json_encode($value)]);
                        $queries[] = ['place_id' => $place->id, 'key' => $key, 'value' => json_encode($value)];
                }

                $mozvisits = $mozPlace->visits->toArray();
                if (count($mozvisits)) {
                    foreach ($mozvisits as $mozvisit) {
                        $visits[] = [ 
                            'from_visit' => $mozvisit['from_visit'], 
                            'place_id' => $place->id, 
                            'visit_date' => $mozvisit['visit_date'], 
                            'visit_type' => $mozvisit['visit_type'] 
                        ];
                    }
                    
                }

                unset($place);
                
            }

            if (count($visits)) {
                $chunks = array_chunk($visits, 500);
                foreach ($chunks as $chunk) Visit::insert($chunk);
            }
            if (count($queries)) {
                $chunks = array_chunk($queries, 500);
                foreach ($chunks as $chunk) Query::insert($chunk);
            }

            unset($places);
            unset($visits);

            $user->import_progress = round($progress->getProgressPercent()*100);
            $user->save();
            
            //$progress->advance(200);
            $callback(MozPlace::count(),200);


        });

        //$progress->finish();
        $callback(MozPlace::count(), MozPlace::count());

        $user->import_progress = 100;
        $user->save();    

    }
    
}
