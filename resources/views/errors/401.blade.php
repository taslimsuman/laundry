@extends('layout.master')
@section('content')
<div class="alert alert-danger">
        <ul>
           <li>{{ $exception->getMessage() }}</li>
        </ul>
    </div>

<a href="{{url('/login')}}" class="btn btn-info">Login</a>
@endsection