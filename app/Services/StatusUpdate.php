<?php
namespace App\Services;

use App\Invoice;
use App\Payment;

class StatusUpdate {


	public static function update($id){

		$inv = Invoice::findOrFail($id);

		$bill = $inv->net_amount;
		$pays = $inv->payments->sum('pay');

		if($pays>=$bill){

			$inv->pay_status = 'Paid';

			$inv->save();

			return true;
		}

		return false;
	}
}