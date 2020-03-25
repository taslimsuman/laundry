@extends('layouts.admin')
@section('content')
@include('layouts.alert')
<div class="panel panel-default">
     <div class="panel-body">
     	<div class="row">
     		<div class="col-md-10">
		        <form action="{{url('change_password')}}" method="post">
		        	{{csrf_field()}}
		        		<div class="row">
		                <div class="form-group col-md-4">
		                    <label>Password</label>
		                    <input type="password" name="new_password" class="form-control">
		                </div>
		                </div>
		                <div class="row">
		                <div class="form-group col-md-4">
		                    <label>Confirm Passport</label>
		                    <input type="password" name="con_password" class="form-control">
		                    
		                </div>
		            </div>

		             <div class="row">
		                <div class="form-group col-md-4">
		                    <input type="submit" value="Change" class="btn btn-success btn-block">
		                </div>
		            </div>
		                
		           
		        </form>
		</div>
		     	</div>

    </div>
</div>
<!-- endpanel -->
@endsection