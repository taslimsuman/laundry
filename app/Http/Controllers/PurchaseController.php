<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Purchase;


class PurchaseController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

    	$rows = Purchase::orderBy('purchase_date','DESC')->paginate(30);

    	return view('purchase.index',compact('rows'));
    }

    public function store(Request $r){

    	
    	$data = new Purchase;

    	$data->invoice = $r->invoice;
    	$data->supplier = $r->supplier;
    	$data->purchase_date = $r->purchase_date;
    	$data->description = $r->description;
    	$data->purchase_date = $r->purchase_date;
    	$data->product_amount = $r->product_amount;
        $data->tax_amount = $r->tax_amount;
    	$data->discount = $r->discount;
    	$data->total = $r->total;
    	$data->note = $r->note;

    	$data->save();

    	return back()->with('success','Purchase has been recorded');
    }

    public function delete($id){

        $data = Purchase::findOrFail($id);

        $data->delete();
        
        return back()->with('success','Purchase has been recorded');
    }

}