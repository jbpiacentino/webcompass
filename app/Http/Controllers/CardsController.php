<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Card;

class CardsController extends Controller
{

 	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
		// $cards = Card::whereUserId(Auth::user()->id)
		// 	->paginate(5);
   		$cards = Card::paginate(5);
    	return view('cards.index', compact('cards'));    	
    } 

	public function store(Request $request) {

		$this->validate($request, [
			'title' => 'required|min:10'
		]);
		$card = new Card($request->all());
		$card->user()->associate(Auth::user());
		$card->save();

		return back();

	} 

	public function edit(Card $card) {

		return view('cards.edit', compact('card'));
	
	}

	public function update(Request $request, Card $card) {

		$card->update($request->all());
		return view('cards.view', compact('card'));
	
	} 

	public function show(Card $card) {
		$card->load('notes', 'user');		
		return view('cards.view', compact('card'));
		
	} 
  
  	public function destroy(Card $card) {
  		$card->delete();
		return redirect ('/cards');
		
	} 
}
