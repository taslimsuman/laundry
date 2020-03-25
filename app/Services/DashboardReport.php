<?php
namespace App\Services;

use App\Invoice;
use Carbon\Carbon;


class DashboardReport {



	public static function getTotalCustomers(){

		
			$inv = Invoice::select('customer_contact')->distinct()->count('customer_contact');

			return $inv;


	}

	public static function getUniqueCustomers(){

		
			$inv = Invoice::select('customer_contact')->distinct()->get();

			return $inv;


	}

	public static function getSaleThisMonth(){

			
			$data = Invoice::whereMonth('idate',date('m'))->sum('net_amount');

			$data = round($data,2);

			return $data;


	}

	public static function getSaleLastMonth(){

			
			$data = Invoice::whereMonth('idate',(date('m')-1))->sum('net_amount');

			$data = round($data,2);

			return $data;


	}
	

	public static function getPresentDue(){

			
			$data = Invoice::where('pay_status','Unpaid')->where('status','Delivered')->sum('net_amount');

			$data = round($data,2);

			return $data;


	}

	public static function chartData(){

		$st = Carbon::now()->subDays(15);
		$ed = Carbon::now()->now();

		$data = \DB::table('invoices')->whereBetween('idate',[$st,$ed])->selectRaw('date(idate) as date, sum(net_amount)  as total_sales')
	    ->groupBy('date')
	    ->get();

	    $chart = '';

	    foreach ($data as $d) {

	        $chart.="{ date: '".$d->date."', total_sales: ".round($d->total_sales,0)."},";
	    }


		return $chart;

	}


}