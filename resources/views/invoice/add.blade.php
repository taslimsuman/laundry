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
              <div class="col-md-5">
                <label>Customer:</label>
                  <input type="text" name="customer_name" id="customer_name"  class="form-control" required>
              </div>
                
                <div class="col-md-3">
                  <label for="del_date" class="">Contact No</label> 
                  <input type="text" class="form-control" id="customer_contact" name="customer_contact" required>
                </div>
                <div class="col-md-2">
                  <label for="type">Collect Date</label>
                  <input type="text" id="idate" class="form-control datepicker" name="idate" required>
                </div>
                <div class="col-md-2">
                  <label for="type">Delivery Date</label>
                  <input type="text" id="del_date" class="form-control datepicker" name="del_date" required>
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
            <hr>
            <div class="row" style="background-color: #add8f1">
              <div class="col-md-4">
                <label>Select Item</label>
                <select id="get_item_ddl" class="form-control select2">
                  <option value="">Select</option>
                  @foreach($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row" style="background-color:#add8f1;padding: 10px 5px;">
              <div class="col-md-4">
                <label>Item</label>
                <input type="text" id="get_item" class="form-control">
              </div>
              <div class="col-md-2">
                <label>Qty</label>
                <input type="number" value="1" id="get_qty" class="form-control">
              </div>
              <div class="col-md-2">
                <label>Job</label>
                <select class="form-control" id="get_job">
                  <option value="">Select</option>
                  <option value="Wash">Wash</option>
                  <option value="Iron">Iron</option>
                  
                </select>
              </div>
              <div class="col-md-2">
                <label>Cost</label>
                <input type="number" id="get_cost" class="form-control">
              </div>
              <div class="col-md-2">
                <label>Action</label><br>
                <button type="button" id="addrow" class="btn btn-primary">Add</button>
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
              <div class="col-md-3 cellr">
                <label>Item</label>
                
              </div>
              <div class="col-md-1 cell">
                <label>Job</label>
                
              </div>
              <div class="col-md-1 cell">
                <label>Qty</label>
                
              </div>
              <div class="col-md-1 cell">
                <label>Price</label>
               
              </div>
              <div class="col-md-1 cell">
                <label>TaxAmt</label>
                
              </div>
              <div class="col-md-1 cell">
                <label>Tax%</label>
                
              </div>
              <div class="col-md-1 cell"  >
                <label>TaxV</label>
                
              </div>
              <div class="col-md-2 cell" >
                <label>Total</label>
                
              </div>
              <div class="col-md-1"  style="padding-top: 25px">
                
              </div>
            </div>
            
        </div>
          <!-- endbox -->
   
      
        <div class="row">
          <div class="col-md-7" style="padding-top: 25px;width: 50%">
            
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
     var selected_item_price_iron = 0;
     var selected_item_price_wash = 0;

  // on selcted change get item details
  $("#get_item_ddl").on('change',function(){
    
    var item_id = $(this).val();

    $.ajax({

        type: 'get',
        url: '{{URL::to("get_items")}}',
        data:{'item_id':item_id},
        dataType:'json',
        success:function(data){
          console.log(data);     

          $('#get_item').val(data.name);
          selected_item_price_iron = data.price_iron;
          selected_item_price_wash = data.price_wash;
      
         
        },

      });
  });

  $("#get_job").on('change',function(){

    var job = $(this).val();

    if(job=="Iron"){
      $("#get_cost").val(selected_item_price_iron);
    }else{
      $("#get_cost").val(selected_item_price_wash);
    }

  });

  function clean_input(){

    $("#get_item").val("");
    $("#get_cost").val("");
    $("#get_job").prop('selectedIndex',0);

     selected_item_price_iron = 0;
     selected_item_price_wash = 0;
    
  }

  
  $(document).ready(function(){
    // default tax percent from db
     var tax = "{{$home->tax_percent}}";
     $('#inv_taxp1').val(tax);

     var final_taxable_amount = 0;
    $('#final_taxable_amount').val(final_taxable_amount);

    var count = 0;
    $('#total_item').val(count);

    // on click add row
    $('#addrow').on('click',function(){

      // set input
      var get_item = $("#get_item").val();
      var get_qty = $("#get_qty").val();
      var get_job = $("#get_job").val();
      var get_cost = $("#get_cost").val();

      // validation

      if(get_item===""){
        alert('Item not found');
        return false;
      }
      if(get_qty < 1) {
        alert('Qty not found');
        return false;
      }
      if(get_job=="") {
        alert('Job not found');
        return false;
      }
      if(get_cost < 1) {
        alert('Cost not found');
        return false;
      }

      
      count+=1;

      $('#total_item').val(count);
      var html_row = '';
          html_row+='<div class="row" id="row_id"'+count+'>';
          html_row+='<div class="col-md-3 cellr">';
            html_row+='<input type="text" name="inv_item[]" id="inv_item'+count+'" value="'+get_item+'" class="form-control" readonly>';
          html_row+='</div>';

          html_row+='<div class="col-md-1 cell">';
          html_row+='<input type="text" name="inv_job[]" id="inv_job'+count+'" value="'+get_job+'" class="form-control" readonly>';
          html_row+='</div>';

          html_row+='<div class="col-md-1 cell">';

            html_row+='<input type="number" name="inv_qty[]"  id="inv_qty'+count+'" value="'+get_qty+'" class="form-control upqty" readonly>';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';
          
            html_row+='<input type="number" name="inv_price[]" step="0.05" id="inv_price'+count+'" value="'+get_cost+'" class="form-control upprice" readonly>';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';
        
           html_row+=' <input type="number" name="inv_txamt[]" id="inv_txamt'+count+'"  class="form-control" readonly>';
          html_row+='</div>';
          html_row+='<div class="col-md-1 cell">';
     
           html_row+=' <input type="number" name="inv_taxp[]" id="inv_taxp'+count+'" value="'+tax+'" class="form-control uptax" readonly>';
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

       // update calculate
       cal_final_total(count);
       clean_input();

       // on click remove
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