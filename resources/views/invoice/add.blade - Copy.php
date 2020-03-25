@extends('layouts.admin')
@section('content')
@include('layouts.alert')
     <form name="cart" action="{{url('/invoice/store')}}" id="invoice" method="post">
                {{csrf_field()}}
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title text-center">Invoice</h3>
   </div>
     <div class="panel-body">
        <div id="box" style="">
       
              
            <div class="row">
              <div class="col-md-4">
                <label>Customer:</label>
                  <input type="text" name="customer_name" id="customer_name"  class="form-control" required>
              </div>
                
                <div class="col-md-4">
                  <label for="del_date" class="">Contact No</label> 
                  <input type="text" class="form-control" id="customer_contact" name="customer_contact" required>
                </div>
                <div class="col-md-4">
                  <label for="type">Date</label>
                  <input type="text" id="idate" class="form-control datepicker" name="idate" required>
                </div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <label>Address</label>
                <input type="text" name="customer_address" class="form-control">
              </div>
              <div class="col-md-6">
                <label>Note</label>
                <input type="text" name="note" class="form-control">
              </div>

            </div>
            <style type="text/css">
              .cell{
                padding: 1px;
              }
              .cellr{
                padding-right: 1px;
              }
            </style>
            <div class="row" style="margin-top: 20px">
              <div class="col-md-4 cellr">
                <label>Item</label>
                <input type="text" name="inv_item[]" id="inv_item1"  class="form-control" required>
              </div>
              <div class="col-md-1 cell">
                <label>Qty</label>
                <input type="number" name="inv_qty[]" id="inv_qty1" step="0.05" class="form-control upqty" required>
              </div>
              <div class="col-md-1 cell">
                <label>Price</label>
                <input type="number" name="inv_price[]" id="inv_price1" step="0.05"  class="form-control upprice" required>
              </div>
              <div class="col-md-1 cell">
                <label>TaxAmt</label>
                <input type="number" name="inv_txamt[]" id="inv_txamt1" step="0.05" class="form-control" readonly>
              </div>
              <div class="col-md-1 cell">
                <label>Tax%</label>
                <input type="number" name="inv_taxp[]" id="inv_taxp1" step="0.05" class="form-control uptax">
              </div>
              <div class="col-md-1 cell"  >
                <label>TaxV</label>
                <input type="number" name="inv_taxv[]" id="inv_taxv1" step="0.05" class="form-control" readonly>
              </div>
              <div class="col-md-2 cell" >
                <label>Total</label>
                <input type="number" name="inv_row_total[]" id="inv_row_total1" step="0.05" value="0" class="form-control" readonly required>
              </div>
              <div class="col-md-1"  style="padding-top: 25px">
                
              </div>
            </div>
            
        </div>
          <!-- endbox -->
   
      
        <div class="row">
          <div class="col-md-7" style="padding-top: 25px;width: 50%">
            <button type="button" id="addrow" class="btn btn-primary">Add Row</button>
            <input type="submit" value="Save" class="btn btn-success">
          </div>
          <div class="col-md-1 cell">
              <label>Item:</label> 
              <input type="text" class="form-control" name="total_item" id="total_item" readonly>
          </div>
          <div class="col-md-1 cell">
            <label>Taxable:</label>
              <input type="number" class="form-control" name="final_taxable_amount" id="final_taxable_amount" value="0" readonly>
          </div>
          <div class="col-md-1 cell">
            <label>Tax:</label>
              <input type="number" class="form-control" name="total_tax" id="total_tax" value="0" readonly>
          </div>
          <div class="col-md-1 cell">
            <label>Discount:</label>
              <input type="number" class="form-control" name="discount" id="discount" step="0.01" value="0">
          </div>
          <div class="col-md-1 cell">
            <label>Net Amount</label>
              <input type="number" class="form-control" name="net_amount" id="net_amount" value="0" readonly>
          </div>
        </div>
      


        </div>
        <!-- panel -->
</div>

</form>

      


@endsection
@section('script')

<script type="text/javascript">
 
  
  $(document).ready(function(){
    // default tax percent from db
     var tax = "{{$home->tax_percent}}";
     $('#inv_taxp1').val(tax);

     var final_taxable_amount = 0;
    $('#final_taxable_amount').val(final_taxable_amount);

    var count = 1;
    $('#total_item').val(count);

    $('#addrow').on('click',function(){
      
      count+=1;

      $('#total_item').val(count);
      var html_row = '';
          html_row+='<div class="row" id="row_id"'+count+'>';
          html_row+='<div class="col-md-4 cellr">';
            html_row+='<input type="text" name="inv_item[]" id="inv_item'+count+'" class="form-control" required>';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';

            html_row+='<input type="number" name="inv_qty[]" step="0.05" id="inv_qty'+count+'"  class="form-control upqty">';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';
          
            html_row+='<input type="number" name="inv_price[]" step="0.05" id="inv_price'+count+'" class="form-control upprice">';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';
        
           html_row+=' <input type="number" name="inv_txamt[]" id="inv_txamt'+count+'"  class="form-control" readonly>';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';
     
           html_row+=' <input type="number" name="inv_taxp[]" id="inv_taxp'+count+'" value="'+tax+'" class="form-control uptax">';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';
          
           html_row+=' <input type="number" name="inv_taxv[]" id="inv_taxv'+count+'"  class="form-control" readonly>';
         html_row+=' </div>';
         html_row+=' <div class="col-md-2 cell" style="padding-left: 1px">';
          html_row+='  <input type="number" name="inv_row_total[]" id="inv_row_total'+count+'" value="0" class="form-control" readonly>';
          html_row+='</div>';
          html_row+='<div class="col-md-1"  style="padding-top: 1px">';
          html_row+='  <button class="btn btn-danger btn-sm remove" id="'+count+'">X</button>';
          html_row+='</div>';
       html_row+=' </div>';

       $('#box').append(html_row);
       $('.remove').on('click',function(){
          let rowid = $(this).attr('id'); 

          $(this).parent().parent().remove();
          count-=1;
          $('#total_item').val(count);
          cal_final_total(count);
          
       });

    });

// calculate row total after chagen qty, price and tax
   $(document).on('blur','.upqty',function(){

    cal_final_total(count);
   })

   $(document).on('blur','.upprice',function(){

    cal_final_total(count);
   })
   $(document).on('blur','.uptax',function(){

    cal_final_total(count);
   })

   $(document).on('blur','#discount',function(){

    cal_final_total(count);


   })



// function to update calculation

    function cal_final_total(count){
   
      var final_taxable_amount = 0;
      var total_tax_amount = 0;
      var net_amount = 0;

      for(j = 1;j <= count;j++){
         
        var qty = 0;
        var price = 0;
        var taxable_amount = 0;
        var tax_rate = 0;
        var tax_amount = 0;
        var item_total = 0;
        var row_item_total = 0;


        // if no value then make 0
        $('#inv_txamt'+j).val(taxable_amount);
        $('#inv_taxv'+j).val(tax_amount);
        $('#inv_row_total'+j).val(item_total);
        $('#final_taxable_amount').val(final_taxable_amount);
         $('#total_tax').val(total_tax_amount);
         $('#net_amount').val(net_amount);

        qty = $('#inv_qty'+j).val();

        if(qty > 0){

          price = $('#inv_price'+j).val();
          if(price>0){
            taxable_amount = parseFloat(qty)*parseFloat(price);
            taxable_amount = parseFloat(taxable_amount).toFixed(2);

            $('#inv_txamt'+j).val(taxable_amount);
          }
          tax_rate = $('#inv_taxp'+j).val();
          if(tax_rate>0){
            tax_amount = parseFloat(taxable_amount)*parseFloat(tax_rate)/100;
            tax_amount = parseFloat(tax_amount).toFixed(2);
          }
          $('#inv_taxv'+j).val(tax_amount);
         

          row_item_total = parseFloat(taxable_amount)+parseFloat(tax_amount);
          row_item_total = parseFloat(row_item_total).toFixed(2);

          $('#inv_row_total'+j).val(row_item_total);
          // set final taxable amount
           final_taxable_amount = parseFloat(final_taxable_amount) + parseFloat(taxable_amount);
           final_taxable_amount = parseFloat(final_taxable_amount).toFixed(2);

            // add to total tax amount
            total_tax_amount = parseFloat(total_tax_amount) + parseFloat(tax_amount);
            total_tax_amount = parseFloat(total_tax_amount).toFixed(2);

            // cal discount
            var discount = $('#discount').val();


            // Net amount
            net_amount = parseFloat(final_taxable_amount) + parseFloat(total_tax_amount) - parseFloat(discount);
            net_amount = parseFloat(net_amount).toFixed(2);
            
        }

       
      }
      //  end loop
      // set final total and final tax amount
       $('#final_taxable_amount').val(final_taxable_amount);
       $('#total_tax').val(total_tax_amount);
       $('#net_amount').val(net_amount);

    } 

  });
</script>



@endsection