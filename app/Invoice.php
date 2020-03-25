<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    
	public $timestamps = false;
	
    public function person(){

    	return $this->belongsTo('App\Person');
    }

    public function invoicedetails(){
    	
    	return $this->hasMany('App\InvoiceDetails');
    }

    public function payments(){

    	return $this->hasMany(Payment::class);
    }
}
