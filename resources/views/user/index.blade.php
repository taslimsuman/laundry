@extends('layouts.admin')
@section('content')
@include('layouts.alert')
<div class="panel panel-default">
    <div class="panel-heading clearfix">
    <h3 class="panel-title pull-left" style="padding-top: 2px;">User list</h3>
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">+Add</button>
           
          </div>
    </div>
     <div class="panel-body">
        <table class="table table-striped" id="datatables">
            <thead>
              
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->status==1?'Active':'Inactive'}}</td>
                    <td>
                        <a href="{{url('/user/edit',$user->id)}}" class="btn btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="{{url('/user/delete',$user->id)}}" class="btn btn-danger btn-sm" onclick=" return confirm('Are you sure want to delete the user?');">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      {{$users->links()}}
    </div>
</div>
<!-- endpanel -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/user')}}" method="post" autocomplete="off">
            {{csrf_field()}}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Email</label>
            <input type="email" class="form-control" name="email" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Role</label>
            <select name="role_id" class="form-control">
                <option value="1">Admin</option>
                <option value="2">Manager</option>
            </select>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Password</label>
             <input type="password" class="form-control" name="password" required autocomplete="off">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
 
</script>

@stop