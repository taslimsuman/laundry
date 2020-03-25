@extends('layouts.admin')
@section('header',strtoupper($status))
@section('content')
@include('layouts.alert')
<div class="panel panel-default">
     <div class="panel-body">
     	 <form action="#" method="get">
          
          <div class="row">
          		<div class="col-md-2">
	            	<label>Invoice No</label>
	           		<input type="text" name="invoice" value="{{$param['invoice']}}" class="form-control">
	          	</div>

	            <div class="col-md-3">
	            <label>Name</label>
	           		<input type="text" name="name" value="{{$param['name']}}" class="form-control">
	          	</div>
              <div class="col-md-2">
                <label>Mobile No</label>
                <input type="text" name="contact" value="{{$param['contact']}}" class="form-control">
              </div>
              <div class="col-md-2">
                <label>Action</label><br>
                <input type="submit" value="Search" class="btn btn-success">
                <a href="{{url('invoices')}}" class="btn btn-default">Cancel</a>
              </div>
          </div>
        </form>
        <hr>
       @include('invoice.invoice_table')
    </div>
</div>
<!-- endpanel -->
@endsection