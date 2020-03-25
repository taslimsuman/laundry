@extends('layouts.admin')
@section('content')
@include('layouts.alert')

    
<div class="panel panel-default">
   <div class="panel-heading">
      <h1 class="panel-title">Invoice</h3>
   </div>
    <div class="panel-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
           
              <td><b>Invoice:</b> {{$inv->id}}</td>
              <td><b>Date:</b> {{$inv->idate}}</td>
              <td><b>Delivery:</b> {{$inv->del_date}}</td>
              <td><b>Status:</b> {{$inv->status}}</td>
              <td><b>Payment Status:</b> {{$inv->pay_status}}</td>
            </tr>
            <tr>
              <td colspan="2"><b>Customer Name:</b> {{$inv->customer_name}}</td>
              <td><b>Contact :</b> {{$inv->customer_contact}}</td>
              <td colspan="2"><b>Address: </b> {{$inv->customer_address}}</td>
              
            </tr>
            <tr>
              <td><b>Invoice Amount:</b> {{$inv->net_amount}} {{$home->currency}}</td>
              <td><b>Pay:</b> {{$inv->payments->sum('pay')}} {{$home->currency}}</td>
              <td><b>Due:</b> {{$inv->net_amount - $inv->payments->sum('pay')}} {{$home->currency}}</td>
              <td colspan="2"><b>Type: </b> {{$inv->type}}</td>
              
            </tr>
          </tbody>
        </table>

        <form action="{{url('invoice/update/'.$inv->id)}}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-2">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value="">Select</option>
                  <option value="Process">Process</option>
                  <option value="Ready">Ready</option>
                  <option value="Delivered">Delivered</option>
                  
                </select>
              </div>
              <div class="col-md-6">
                <label>Note</label>
                <input type="text" name="note" value="{{$inv->note}}" class="form-control">
              </div>
              <div class="col-md-4">
                <label>Action</label><br>
                <input type="submit" value="Update" class="btn btn-success">
                
            
                <a href="#" onClick="MyWindow=window.open('https://api.whatsapp.com/send?phone=971{{substr($inv->customer_contact,1)}}&text=Hello I would like to contact you.','MyWindow','width=600,height=300'); return false;" class="btn btn-success">
                  <i class="fa fa-whatsapp my-float"></i> Send Message
                </a>
              </div>
          </div>
        </form>
  
    </div>
        <!-- panel -->
</div>

<div class="panel panel-info">
   <div class="panel-heading">
      <h1 class="panel-title">Payments</h3>
   </div>
    <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Date</th>
              <th>Pay note</th>
              <th>Payment</th>
            </tr>
          </thead>
          <tbody>
            @foreach($inv->payments as $pay)
            <tr>
              <td>{{$pay->tdate}}</td>
              <td>{{$pay->pay_note}}</td>
              <td>{{$pay->pay}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <form action="{{url('invoice/payment/'.$inv->id)}}" method="post">
          @csrf
          <div class="row">
              <div class="col-md-3">
                <label>Pay Note</label>
                <input type="text" name="pay_note" class="form-control">
              </div>
              <div class="col-md-2">
                <label>Amount</label>
                <input type="number" name="pay" class="form-control" min="1" required>
              </div>
              <div class="col-md-2">
                <label>Action</label><br>
                <input type="submit" value="Pay" class="btn btn-success">
                <a href="{{url('invoices/all')}}" class="btn btn-default">Close</a>
                
              </div>
          </div>
        </form>
  
    </div>
        <!-- panel -->
</div>



@endsection
@section('script')
