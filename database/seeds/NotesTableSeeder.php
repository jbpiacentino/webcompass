<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\EloquentModel;
use Carbon\Carbon;
use App\Card;

class NotesTableSeeder extends Seeder {


	public function run() {
	  	
	  	// Card::all()->each(function ($card) {
	  	// 	$notes = factory(App\Note::class, 7)->make();
	  	// 	foreach ($notes as $note) {
	  	// 		$note->user_id = $card->user_id;
	  	// 		$card->notes()->save($note);
	  	// 	}
	  	// 	//$card->notes()->saveMany(factory(App\Note::class, 7)->make());
	  	// });
		
	}
}