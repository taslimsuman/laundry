@extends('layouts.admin')
@section('content')
@include('layouts.alert')
<div class="panel panel-default">
	<div class="panel-heading">
    <h3 class="panel-title pull-left">Purchase records</h3>
          
            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">+ Add</button>
           <div class="clearfix">
          </div>
    </div>
     <div class="panel-body">
       <table class="table">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Invoice</th>
        <th scope="col">Supplier</th>
        <th scope="col">Product Amount</th>
        <th scope="col">Tax</th>
        <th scope="col">Discount</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rows as $row)
      <tr>
        <th scope="row">{{$row->purchase_date}}</th>
        <td>{{$row->invoice}}</td>
        <td ><a href="">{{$row->supplier}}</a></td>
        <td>{{$row->product_amount}}</td>
        <td>{{$row->tax_amount}}</td>
        <td>{{$row->discount}}</td>
        <td>{{$row->total}}</td>
        <td>
          <a href="{{url('/purchase/delete',$row->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure delete this purchase?');">
            <i class="fa fa-trash"></i></a>
        </td>
        
      </tr>
      @endforeach
    </tbody>
</table>
{{$rows->appends(Request::except('page'))->links()}}
    </div>
</div>
<!-- endpanel -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Purchase Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/purchase')}}" method="post">
            {{csrf_field()}}
            <div class="row">
                 <div class="form-group col-md-6">
	            <label  class="col-form-label">Invoice</label>
	            <input type="text" class="form-control" name="invoice" required>
	          </div>
	          <div class="form-group col-md-6">
	            <label for="message-text" class="col-form-label">Supplier</label>
	            <input type="text" class="form-control" name="supplier" required>
	          </div>
          </div>
          <div class="row">
              <div class="form-group col-md-8">
                <label for="message-text" class="col-form-label">Description</label>
                <input type="text" class="form-control" name="description" required>
              </div>
              <div class="form-group col-md-4">
                <label for="message-text" class="col-form-label">Purchase Date</label>
                <input type="text" class="form-control datepicker" name="purchase_date" autocomplete="off" required>
              </div>
            </div>
          
          <div class="row">         
	           <div class="form-group col-md-3">
	            <label for="message-text" class="col-form-label">Product Amount</label>
	             <input type="number" class="form-control cal" name="product_amount" id="product_amount" step="0.01" required>
	          </div>
	          <div class="form-group col-md-3">
	            <label for="message-text" class="col-form-label">Tax Amount</label>
	             <input type="tax_amount" class="form-control cal" name="tax_amount" id="tax_amount" value="0" required>
	          </div>
            <div class="form-group col-md-3">
              <label for="message-text" class="col-form-label">Discount</label>
               <input type="discount" class="form-control cal" name="discount" id="discount" value="0" required>
            </div>
	          <div class="form-group col-md-3">
	            <label for="message-text" class="col-form-label">Total</label>
	             <input type="total" class="form-control" name="total" id="total" readonly>
	          </div>
           </div>
           <div class="row">
             <div class="form-group col-md-12">
              <label for="message-text" class="col-form-label">Note</label>
               <input type="note" class="form-control" name="note" required>
            </div>
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
  $(document).ready(function(){

    $(document).on('blur','.cal',function(){

      get_total();

      })

      function get_total(){

         var total = 0;
         var product_amount = $('#product_amount').val();
         var tax_amount = $('#tax_amount').val();
         var discount = $('#discount').val();

          total = parseFloat(product_amount)+parseFloat(tax_amount)-parseFloat(discount);

          $('#total').val(total);
      }

  });
</script>
@stop