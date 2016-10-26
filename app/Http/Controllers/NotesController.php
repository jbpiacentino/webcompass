<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Card;


class NotesController extends Controller
{
	public function store(Request $request, Card $card) {
		
		$card->addNote(
			new Note($request->all())
		);

		return back();

	} 

	public function edit(Note $note) {

		return view('notes.edit', compact('note'));
	
	}

	public function update(Request $request, Note $note) {

		$note->update($request->all());
		return redirect()->action('CardsController@show', $note->card_id);;
	
	} 

	public function destroy(Note $note) {
  		$note->delete();
		return back();
		
	} 
}
