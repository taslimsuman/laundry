<?php
namespace App\libs;
use App\Shop;

class Home {


	public $name;
	public $address;
	public $contact;
	public $email;
	public $website;
	public $tax_no;
	public $tax_percent;
	public $logo;
	public $currency;

	protected $shop;

	public function __construct() {
		
		$this->shop = Shop::find(1);

		$this->name = $this->shop->name;
		$this->address = $this->shop->address;
		$this->contact = $this->shop->contact;
		$this->email = $this->shop->email;
		$this->website = $this->shop->website;
		$this->tax_no = $this->shop->tax_no;
		$this->tax_percent = $this->shop->tax_percent;
		$this->logo = $this->shop->logo;
		$this->currency = $this->shop->currency;
	}


}
