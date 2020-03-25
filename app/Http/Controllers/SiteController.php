<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\libs\Helper;
use App\Plate;
use App\Mobile;
use App\User;
use Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function LangSwitcher($lang){

       Session::put('locale',$lang);
       return redirect()->back();

    }

   public function index(){

        $sold_plate = Plate::where('sold','on')->count('id');
        $sold_mobile = Mobile::where('sold','on')->count('id');
        

      return view('index',compact('sold_plate','sold_mobile'));


    }

    public function plates(Request $r, Plate $plates){


        

        $plates = $plates->newQuery();

        if($r->has('digits') && !empty($r->digits)){

            $plates->where('digits','=',$r->digits);


        }

        if($r->has('similar') && !empty($r->similar)){

            $similar = '%'.$r->similar.'%';

            $plates->where('plate','like',$similar);

        }
        if($r->has('minprice') && !empty($r->minprice)){

            $plates->where('price','>=',$r->minprice);
        }

        if($r->has('maxprice') && !empty($r->maxprice)){

            $plates->where('price','<=',$r->maxprice);
        }

        if($r->has('code') && !empty($r->code)){

            $plates->where('code',$r->code);

        }

        if($r->has('city') && !empty($r->city)){

            $plates->where('city',$r->city);

        }

        if($r->has('enclosed') && !empty($r->enclosed)){
            $plates->where('enclosed',$r->enclosed);


        }

        if($r->has('superEnclosed') && !empty($r->superEnclosed)){

            $plates->where('superEnclosed',$r->superEnclosed);
        }
        
        if($r->has('doubleEnclosed') && !empty($r->doubleEnclosed)){

            $plates->where('doubleEnclosed',$r->doubleEnclosed);
        }
        

        if($r->has('middleTriple') && !empty($r->middleTriple)){

            $plates->where('middleTriple',$r->middleTriple);
        }
        

      $plates = $plates->where('type','=','tag')->with('user')->paginate(20);

    
      
      $path = Helper::imgpath();

      return view('plate.plates',compact('plates','path'));
     
    }

    public function showplate($slug){

        $path = Helper::imgpath();
        $plate = Plate::with('user')->where('slug','=',$slug)->first();

        return view('plate.showplate',compact('plate','path'));
    }


    // show all plate canvas
    public function all_plate_canvas(){

        $plates = Plate::where('type','!=','tag')->with('user')->get();
        $path = Helper::imgpath();

        return view('plate.all_plate_canvas',compact('plates','path'));

    }

    // show single plate canvas
    public function show_plate_canvas($slug){

    	$path = Helper::imgpath();
        $plate = Plate::with('user')->where('slug','=',$slug)->first();

        return view('plate.show_plate_canvas',compact('plate','path'));
    }

    // MOBILE NUMBERS
    public function numbers(Request $r, Mobile $numbers){

        $numbers = $numbers->newQuery();

        if($r->has('similar') && !empty($r->similar)){

                $similar = '%'.$r->similar.'%';

            $numbers->where('number','like',$similar);

        }

        if($r->has('minprice') && !empty($r->minprice)){

            $numbers->where('price','>=',$r->minprice);

        }

        if($r->has('maxprice') && !empty($r->maxprice)){

            $numbers->where('price','<=',$r->maxprice);
        }

        if($r->has('code') && !empty($r->code)){

            $numbers->where('code',$r->code);

        }

        if($r->has('carrier') && !empty($r->carrier)){

            $numbers->where('carrier',$r->carrier);

        }

        if($r->has('repeat_three') && !empty($r->repeat_three)){

            $numbers->where('repeat_three',$r->repeat_three);
            
        }

        if($r->has('repeat_four') && !empty($r->repeat_four)){

            $numbers->where('repeat_four',$r->repeat_four);
            
        }

        if($r->has('enclosed') && !empty($r->enclosed)){

            $numbers->where('enclosed',$r->enclosed);
            
        }

        if($r->has('superEnclosed') && !empty($r->superEnclosed)){

            $numbers->where('superEnclosed',$r->superEnclosed);
            
        }

        if($r->has('doubleEnclosed') && !empty($r->doubleEnclosed)){

            $numbers->where('doubleEnclosed',$r->doubleEnclosed);
            
        }

        if($r->has('bothside') && !empty($r->bothside)){

            $numbers->where('bothside',$r->bothside);
            
        }

        $numbers = $numbers->where('type','=','tag')->paginate(20);

        //return $numbers;

        $path = Helper::mimgpath();

        return view('mobile.index',compact('numbers','path'));

    }

    public function shownumber($slug){

        $number = Mobile::where('slug','=',$slug)->first();

        $path = Helper::mimgpath();

        return view('mobile.shownumber',compact('number','path'));


    }

    public function number_canvas(){

         $numbers = Mobile::where('type','=','canvas')->paginate(20);

        $path = Helper::mimgpath();

        return view('mobile.canvases',compact('numbers','path'));


    }

    public function show_number_canvas($slug){

        $path = Helper::mimgpath();

        $number = Mobile::with('user')->where('slug','=',$slug)->first();

       

        return view('mobile.show_mobile_canvas',compact('number','path'));

    }

    // site links

     public function about(){

        if(App::getLocale()=='ar'){
            return view('site.ar.about');
        }
        return view('site.about');
    }

     public function terms_condition(){
        
        if(App::getLocale()=='ar'){
            return view('site.ar.terms_condition');
        }

        return view('site.terms_condition');
    }

     public function privacy(){

            if(App::getLocale()=='ar'){
                return view('site.ar.privacy');
            }

            return view('site.privacy');
        }

     public function pricing(){

            if(App::getLocale()=='ar'){
                return view('site.ar.pricing');
            }

            return view('site.pricing');
        }

     public function refund_policy(){

            if(App::getLocale()=='ar'){
                 return view('site.ar.refund_policy');
            }

            return view('site.refund_policy');
        }

     public function contact(){

            if(App::getLocale()=='ar'){
                return view('site.ar.contact');
            }

            return view('site.contact');
    }

    public function seller($profile){

        $profile = User::where('profile',$profile)->first();


        $plates = $profile->plates()->where('type','tag')->get();
        $canvases = $profile->plates()->where('type','canvas')->get();
        $numbers = $profile->mobiles()->get();

        $mydata = [

            'profile'=>$profile,
            'plates'=>$plates,
            'canvases'=>$canvases,
            'numbers'=>$numbers
            ];

        return view('user.seller_profile',compact('mydata'));
    }


}
