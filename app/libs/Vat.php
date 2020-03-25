<?php
namespace App\libs;

use App\Invoice;
use App\Purchase;

class Vat {


	public $total_invoice = 0;
	public $total_product_amount = 0;
	public $total_vat_amount = 0;
	public $total_invoice_amount = 0;

	public $total_purchase = 0;
	public $total_purchase_product_amount = 0;
	public $total_purchase_vat_amount = 0;
	public $total_purchase_amount = 0;

	public $vat_return = 0;


	public function summary($from_date,$to_date){

			$inv = Invoice::whereBetween('idate',[$from_date,$to_date])->get();

			$this->total_invoice = $inv->count();
			$this->total_product_amount = $inv->sum('taxable_amount');
			$this->total_vat_amount = $inv->sum('total_tax');
			$this->total_invoice_amount = $inv->sum('net_amount');

			$pur = Purchase::whereBetween('purchase_date',[$from_date,$to_date])->get();

			$this->total_purchase = $pur->count();
			$this->total_purchase_product_amount = $pur->sum('product_amount');
			$this->total_purchase_vat_amount = $pur->sum('tax_amount');
			$this->total_purchase_amount = $pur->sum('total');

			// set return
			$this->vat_return = $this->total_vat_amount - $this->total_purchase_vat_amount;

			return $this;


	}
}