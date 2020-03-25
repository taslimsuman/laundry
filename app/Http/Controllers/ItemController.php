<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;


class ItemController extends Controller
{

	public function __construct(){

		$this->middleware('admin');
	}

	public function get_items(Request $r){

		if($r->ajax()){

		
		$data = Item::findOrFail($r->item_id);

         return response()->Json($data);

         }
	}

	public function index(){
		
		$items = Item::paginate(20);

		return view('item.index',compact('items'));

	}

	public function store(Request $r){

		$item = new Item;

		$item->name = $r->name;
		$item->price_iron = $r->price_iron;
		$item->price_wash = $r->price_wash;
		$item->save();

		return back()->with('success','Item has been added');
	}

	public function edit($id){

		$item = Item::findOrFail($id);
		return view('item.edit',compact('item'));
	}

	public function update(Request $r,$id){

		$item = Item::findOrFail($id);

		$item->name = $r->name;
		$item->price_iron = $r->price_iron;
		$item->price_wash = $r->price_wash;
		$item->save();

		return back()->with('success','Item has been updated');

	}

	public function delete($id){

		$item = Item::findOrFail($id);

		$item->delete();

		return back()->with('success','Item has been deleted');

	}
}