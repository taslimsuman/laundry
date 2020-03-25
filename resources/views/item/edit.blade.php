@extends('layouts.admin')
@section('content')
@include('layouts.alert')
<div class="panel panel-default">
	  <div class="panel-heading">
        <h3>Item Update</h3>
    </div>
     <div class="panel-body">
         <form class="form-row" method="post" action="{{url('/item/update',$item->id)}}" autocomplete="off">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$item->name}}" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Iron Price</label>
                    <input type="number" name="price_iron" value="{{$item->price_iron}}" class="form-control" autocomplete="off">
                </div>
                <div class="form-group col-md-2">
                    <label>Wash Price</label>
                    <input type="number" name="price_wash" value="{{$item->price_wash}}" class="form-control" autocomplete="off">
                </div>
            </div>

            <input type="submit" value="Update" class="btn btn-success">
            <a href="{{url('items')}}" class="btn btn-default">Cancel</a>
        </form>

    </div>
</div>
<!-- endpanel -->
@endsection