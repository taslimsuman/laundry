@extends('layouts.admin')
@section('content')
@include('layouts.alert')
<div class="panel panel-default">
	  <div class="panel-heading">
        <h3>Update information</h3>
    </div>
     <div class="panel-body">
         <form class="form-row" method="post" action="{{url('settings')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-8">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$shop->name}}" class="form-control">
                </div>
                
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Address</label>
                    <input type="text" name="address" value="{{$shop->address}}" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label>Contact</label>
                    <input type="text" name="contact" value="{{$shop->contact}}" class="form-control">
                </div>
                
            </div>
            
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Email</label>
                    <input type="text" name="email" value="{{$shop->email}}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Website</label>
                    <input type="text" name="website" value="{{$shop->website}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Tax No</label>
                    <input type="text" name="tax_no" value="{{$shop->tax_no}}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Tax%</label>
                    <input type="text" name="tax_percent" value="{{$shop->tax_percent}}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Currency</label>
                    <input type="text" name="currency" value="{{$shop->currency}}" class="form-control">
                    
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Logo</label>
                    <input type="file" name="logo">
                </div>
                <div class="form-group col-md-4">
                    @if($shop->logo)
                    <img src="{{asset('/upload')}}/{{$shop->logo}}" class="img-responsive" width="75px">
                    @endif
                </div>
            </div>
            
            <input type="submit" value="Update" class="btn btn-success">
            <a href="{{url('/dashboard')}}" class="btn btn-default">Cancel</a>
        </form>

    </div>
</div>
<!-- endpanel -->
@endsection