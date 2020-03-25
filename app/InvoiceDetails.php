<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
  
	protected $table = 'invoice_details';
	public $timestamps = false;

    public function invoice(){

    	return $this->belognsTo('App\Invoice');
    }
    
}