<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Yajra\Datatables\Datatables;

class UserController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('user.index',compact('users'));
    }

    public function getUsers(){

        $users = User::with('role')->select('users.*');

        return Datatables::of($users)
                
                ->make(true);
    }

    public function store(Request $r){

        $this->validate($r,[

            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = new User;

        $user->name = $r->name;
        $user->email = $r->email;
        $user->role_id = $r->role_id;
        $user->password = Hash::make($r->password);
        $user->status = 1;
        $user->save();

        return back()->with('success','User has been added');


    } 


    public function edit($id){

        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit',compact('user','roles'));
    }

     public function update(Request $r,$id){
        
          
        $user = User::findOrFail($id);

        $user->name = $r->name;
        $user->email = $r->email;
        $user->role_id = $r->role_id;
        $user->status = $r->status;


        if($r->new_password!=null){


            $user->password = Hash::make($r->new_password);

        }

        $user->save();

        return redirect('/users')->with('success','User has been updated');
    }

    public function delete($id){
        
        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('success','User has been deleted');
    }


   
}
