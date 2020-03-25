@extends('layouts.admin')
@include('layouts.alert')
@section('content')
<div class="panel panel-default">
	  <div class="panel-heading">
        <h3>User Update</h3>
    </div>
     <div class="panel-body">
         <form class="form-row" method="post" action="{{url('/user/update',$user->id)}}" autocomplete="off">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Email</label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Role</label>
                    
                    <select name="role_id" class="form-control">
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" {{$role->id==$user->role_id?'selected':''}}>{{$role->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{$user->status==1?'selected':''}}>Active</option>
                        <option value="0" {{$user->status==0?'selected':''}}>Inactive</option>                
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Password</label>
                    <input type="password" name="new_password" value="" class="form-control" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                    <label></label>
                    
                </div>
            </div>
            
            <input type="submit" value="Update" class="btn btn-success">
        </form>

    </div>
</div>
<!-- endpanel -->
@endsection