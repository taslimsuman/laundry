<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Services\StatusUpdate;



class PaymentController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

	public function pay(Request $r, $id){

		// check pay status
		$inv = \App\Invoice::findOrFail($id);
		$inv = $inv->pay_status;

		if($inv=="Paid"){
			return back()->with('danger','Invoice is already paid');
		}


		$pay = new Payment;

		$pay->invoice_id = $id;
		$pay->pay_note = $r->pay_note;
		$pay->pay = abs($r->pay);
		$pay->tdate = date('Y-m-d');
		$pay->user = Auth()->user()->name;

		$pay->save();

		StatusUpdate::update($id);

		return back()->with('success','Pyament has been posted');

	}
}