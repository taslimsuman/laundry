@extends('layouts.inv')
@section('content')
@include('layouts.alert')

<style type="text/css">
    .title {
        font-size: 18px;
        font-family: sans-serif;
    }
    .small{
    font-size: 1.2em;
     margin-bottom: 2px;
    }
</style>
<div class="receipt-main col-xs-12 col-sm-12 col-md-10   col-md-offset-1" style="height:1050px;margin-top: 2px;border: 1px solid #414141">
            <div class="row" style="">
    			<div class="receipt-header">
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="receipt-left">
							<img class="img-responsive" alt="" src="{{asset('upload/'.$home->logo)}}" style="width: 120px;">
						</div>
					</div>
               
                    <div class="col-xs-6 col-sm-6 col-md-6 text-center" style="padding-top: 5px">
                        <h2 style="font-weight: bold;">{{$home->name}}</h2>
                        <p class="small">{{$home->address}}</p>
                        <p class="small">{{'Phone: '.$home->contact}}</p>
                        
                            <h4 style="margin-top: 2px">TRN: {{$home->tax_no}}</h4>

                    </div>
					<div class="col-xs-3 col-sm-3 col-md-3 text-right">
                       
					</div>
				</div>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-5 col-sm-5 col-md-5 text-left">
						<div class="receipt-rights">
							<p class="title"><b>Customer Name :</b> {{$inv->customer_name}}</p>
							<p class="title"><b>Contact :</b> {{$inv->customer_contact}}</p>
							<p class="title"><b>Address :</b> {{$inv->customer_address}}</p>

						</div>
					</div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                
                         <h3 style="margin-top: 0px">TAX INVOICE</h3>
                        
                    </div>
					<div class="col-xs-3 col-sm-3 col-md-3 text-right">
						<div class="receipt-rights">
                            <p class="title"> <strong>Invoice# {{$inv->id}}</strong></p>
                            <p class="title"><strong>Date:</strong> {{date('d-M-y',strtotime($inv->idate))}}</p>
                            <p class="title"><strong>Delivery Date:</strong> {{date('d-M-y',strtotime($inv->del_date))}}</p>
							
						</div>
					</div>
				</div>
            </div>
			
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 22%">Item</th>
                            <th style="width: 8%">Job</th>
                            <th style="width: 8%">Qty</th>
                            <th style="width: 10%">Price</th>
                            <th style="width: 12%">Taxable price</th>
                            <th style="width: 8%">Tax %</th>
                            <th style="width: 12%">Tax Amt</th>
                            <th style="width: 15%">Total Amount({{$home->currency}})</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        @foreach($inv->invoicedetails as $item)
                        <tr>
                            <td class="">{{$i}}</td>
                            <td class="">{{$item->inv_item}}</td>
                            <td class="">{{$item->inv_job}}</td>
                            <td class="">{{$item->inv_qty}}</td>
                            <td class="">{{$item->inv_price}}</td>
                            <td class="">{{$item->inv_txamt}}</td>
                            <td class="">{{$item->inv_taxp}}</td>
                            <td class="">{{$item->inv_taxv}}</td>
                            <td class="">{{$item->inv_row_total}}</td>
                    
                        </tr>
                        <?php $i++;  ?>
                        @endforeach
                        
                        <tr>
                            <td class="text-right" colspan="8">
                            <p>
                                <strong>Taxable Amount: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p>
							<p>
                                <strong>Discount: </strong>
                            </p>
							<p>
                                <strong>Net Amount: </strong>
                            </p>
                           
							</td>
                            <td>
                            <p>
                                <strong>{{$inv->taxable_amount}}</strong>
                            </p>
                            <p>
                                <strong>{{$inv->total_tax}}</strong>
                            </p>
							<p>
                                <strong>{{$inv->discount}}</strong>
                            </p>
                            <p>
                                <strong>{{$inv->net_amount}}</strong>
                            </p>
                            
							</td>
                        </tr>
                        <tr>
                           
                            <td colspan="9">
                                {{$inv->note}}
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
			<style type="text/css">
                .dark{
                    color:#8c8c8c;
                }
                .ftxt{
                    padding: 2px;
                }        
            </style>
			<div class="row" style="position:absolute;bottom: 40px;width: 90%;padding: 5px">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-4 col-sm-4 col-md-4 text-left ftxt">
						<div class="receipt-left">
							<h4 class="dark">Thank you for your purchase!</h4>
						</div>
					</div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-center ftxt" style="padding-top:15px ">
                        <center>
                            <p style="color: blue;font-family: sans-serif;font-size: 11px">Emai: {{$home->email}},<br> {{$home->website}}</p>
                        </center>  
                    </div>

					<div class="col-xs-2 col-sm-2 col-md-2 text-right ftxt">
						<div class="receipt-right">
							<h4 class="dark">Signature</h4>
						</div>
					</div>
				</div>
            </div>
			
</div>
@endsection