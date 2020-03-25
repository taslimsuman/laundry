@extends('layouts.admin')
@section('content')
@include('layouts.alert')
<div class="panel panel-default">
    <div class="panel-heading clearfix">
    <h3 class="panel-title pull-left" style="padding-top: 2px;">Price list</h3>
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">+Add</button>
           
          </div>
    </div>
     <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Iron Price</th>
                    <th>Wash Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price_iron}} {{$home->currency}}</td>
                    <td>{{$item->price_wash}} {{$home->currency}}</td>
                    <td>
                        <a href="{{url('/item/edit',$item->id)}}" class="btn btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="{{url('/item/delete',$item->id)}}" class="btn btn-danger btn-sm" onclick=" return confirm('Are you sure want to delete the Item?');">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    {{$items->links()}}
    </div>
</div>
<!-- endpanel -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/item')}}" method="post" autocomplete="off">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Iron Price</label>
            <input type="number" class="form-control" name="price_iron" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Wash Price</label>
            <input type="number" class="form-control" name="price_wash" required autocomplete="off">
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