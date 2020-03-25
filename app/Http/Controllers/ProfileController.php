<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;


class ProfileController extends Controller
{
    public function __construct(){

    	$this->middleware('auth');

    }

    public function change_password(){

            return view('profile.change_password');

    }

    public function changePassword(Request $r){

        $this->validate($r,[
                
                'new_password' => 'required|string|min:6',
                'con_password' => 'required|string|min:6',

        ]);
            


                if($r->new_password==$r->con_password){

                    $user = Auth::user();

                    $user->password = Hash::make($r->new_password);

                    $user->save();

                    return back()->with('success','Password has been changed');

                }else{

                  return back()->with('success','Password does not match');

                }

            }

    

}
