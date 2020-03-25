@extends('layouts.admin')
@section('content')

<div class="row">
	<div class="col-md-6">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th >Sell ({{$home->currency}})</th>
                    <th >Purchase ({{$home->currency}})</th>
                  </tr>
                <tr>
                  <td>1.</td>
                  <td>Sell/Purchase</td>
                  <td>{{$data->total_invoice}}</td>
                  <td>{{$data->total_purchase}}</td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Product total</td>
                  <td>{{$data->total_product_amount}}</td>
                  <td>{{$data->total_purchase_product_amount}}</td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Total VAT</td>
                  <td>{{$data->total_vat_amount}}</td>
                  <td>{{$data->total_purchase_vat_amount}}</td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Total</td>
                  <td>{{$data->total_invoice_amount}}</td>
                  <td>{{$data->total_purchase_amount}}</td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td colspan="2">Vat return ({{$home->currency}})</td>
                  <td><span class="badge bg-{{$data->vat_return<0?'red':'green'}}">{{$data->vat_return}} </span></td>
                </tr>             
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <form>
                <div class="row">      
                      <div class="col-md-4">
                        <input type="text" name="from_date" class="form-control datepicker" placeholder="From date" autocomplete="off">
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="to_date" class="form-control datepicker" placeholder="To date" autocomplete="off">
                      </div>
                      <div class="col-md-4">
                        <input type="submit" name="" class="btn btn-primary" value="Submit">
                      </div>
                  </div>
              </form>
            </div>
            
          </div>
    </div>
	</div>



@endsection