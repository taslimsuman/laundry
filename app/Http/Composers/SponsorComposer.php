<?php

namespace App\Http\Composers;
use Illuminate\Contracts\View\View;
use App\Sponsor;
use Auth;

class SponsorComposer
{
	
	public function compose(View $view){

		$sponsor = Sponsor::find(1);
		

		$view->with('sponsor',$sponsor);

	}

	

}