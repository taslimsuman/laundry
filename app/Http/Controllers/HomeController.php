<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Image;
use App\Libs\Home;
use App\Services\DashboardReport;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        
        $chart = DashboardReport::chartData();


        $db_top = [

            'getTotalCustomers' => DashboardReport::getTotalCustomers(),
            'getSaleThisMonth' => DashboardReport::getSaleThisMonth(),
            'getSaleLastMonth' => DashboardReport::getSaleLastMonth(),
            'getPresentDue' => DashboardReport::getPresentDue(),
            'chart' => DashboardReport::chartData(),
            

        ];



        return view('dashboard',compact('db_top','chart'));
        
    }
   
    public function settings()
    {
        $shop = Shop::find(1);

        return view('shop.index',compact('shop'));
    }

    public function update(Request $r){

        $data = Shop::find(1);

        $data->name = $r->name;
        $data->address = $r->address;
        $data->contact = $r->contact;
        $data->website = $r->website;
        $data->email = $r->email;
        $data->tax_no = $r->tax_no;
        $data->tax_percent = $r->tax_percent;
        $data->currency = $r->currency;

         if($r->has('logo') && !empty($r->file('logo'))){

            $img = $r->file('logo');

            
            
            $image = Image::make($img->getRealPath());

            $path = 'upload/logo.jpg';

            $image->resize(300,NULL,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
            })->save($path);

            $data->logo = 'logo.jpg';

        }

        $data->save();

        return back()->with('success','Updated');
        
    }

}
