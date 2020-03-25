<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Purchase;
use App\libs\Vat;

class VatController extends Controller
{

	public function __construct()
    {
        $this->middleware('admin');

    }


    public function vat(Request $r){
		
		$fdate = date('Y-m-01');
    	$today = date('Y-m-d');
    	$title = 'Summary for the month of '.date('M, Y');

    	if($r->from_date && $r->to_date){

    		$fdate = $r->from_date;
    		$today = $r->to_date;
    		$title = 'Summary from '.date('d-m-y',strtotime($fdate)).' to '.date('d-m-y',strtotime($today));
    	}

    	//$new_date_str = strtotime('-2 day',strtotime($today));
    	//$new_date = date('Y-m-d',$new_date_str);

    	$vat = new Vat;
    	$data = $vat->summary($fdate,$today);


    	
    	return view('vat.index',compact('data','title'));

    }

  
}