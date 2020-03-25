@extends('layouts.app')
@section('content')
  <div class="container" style="margin-top: 120px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">{{$home->name}}</h2>
            <hr>
            <center>	
            <a href="{{url('/login')}}" class="btn btn-primary">Login</a>
			</center>
		</div>
	</div>
</div>
@stop