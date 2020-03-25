<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

	public $timestaps = false;

	protected $table = 'items';
}