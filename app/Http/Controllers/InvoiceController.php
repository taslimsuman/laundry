<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\InvoiceDetails;
use Auth;
use App\Item;


class InvoiceController extends Controller
{
    
    public function __construct(){

    	$this->middleware('auth');
    }

    public function index(Invoice $invoices){       

        $invoices = $invoices->orderBy('id','DESC')->paginate(20);
        $status = "All Invoices";

        return view('invoice.index',compact('invoices','status'));
    }

    public function invoices($status, Invoice $inv, Request $r){

        $param = [

          'invoice' => '',
          'name'=>'',
          'contact'=>''
        ];

          $inv = $inv->newQuery();

          if($status!='all'){
              $inv = $inv->where('status',$status);
          }

          // filter

          if(!empty($r->invoice)){

              $inv = $inv->where('id',$r->invoice);
              $param['invoice'] = $r->invoice;
          }

          if(!empty($r->name)){

              $inv = $inv->where('customer_name','LIKE',"%".$r->name."%");
              $param['name'] = $r->name;
          }
          if(!empty($r->contact)){

              $inv = $inv->where('customer_contact','LIKE',"%".$r->contact."%");
              $param['contact'] = $r->contact;
          }
          
          $invoices = $inv->orderBy('id','DESC')->paginate(20);

          return view('invoice.index',compact('invoices','status','param'));
      

    }

    public function add(){

      $items = Item::orderBy('name','ASC')->get();

      return view('invoice.add',compact('items'));
    }

    public function store(Request $r){

      	$this->validate($r,[

                'customer_name' => 'required',
                'idate' => 'required',
                'net_amount' => 'required',
        ]);

        // save invoice
    	$inv = new Invoice;

        $inv->customer_name = $r->customer_name;
        $inv->customer_contact = $r->customer_contact;
        $inv->idate = $r->idate;
        $inv->del_date = $r->del_date;
        $inv->customer_address = $r->customer_address;
        $inv->note = $r->note;
        $inv->taxable_amount = $r->final_taxable_amount;
        $inv->total_tax = $r->total_tax;
        $inv->discount = $r->discount;
        $inv->net_amount = $r->net_amount;
        $inv->status = 'Collection';
        $inv->pay_status = 'Unpaid';
       
    	$inv->save();

         $inv_id = $inv->id;
         $inv_items = $r->inv_item;
         $inv_jobs = $r->inv_job;
         $inv_prices  = $r->inv_price;
         $inv_txamts = $r->inv_txamt;
         $inv_taxps = $r->inv_taxp;
         $inv_taxvs = $r->inv_taxv;
         $inv_row_totals = $r->inv_row_total;

        // add invoice records

        foreach($r->inv_qty as $k => $v){

            if($v>0){

                $data = new InvoiceDetails;
                $data->invoice_id = $inv_id;
                $data->inv_item = $inv_items[$k];
                $data->inv_job = $inv_jobs[$k];
                $data->inv_qty = $v;
                $data->inv_price = $inv_prices[$k];
                $data->inv_txamt = $inv_txamts[$k];
                $data->inv_taxp = $inv_taxps[$k];
                $data->inv_taxv = $inv_taxvs[$k];
                $data->inv_row_total = $inv_row_totals[$k];

                $data->save();

             }

        }

    return redirect('/invoices/all');
    	
    }

    public function show($id){

        $inv = Invoice::findOrFail($id);

        return view('invoice.invoice',compact('inv'));
    }

    public function edit($id){

        $inv = Invoice::findOrFail($id);

        return view('invoice.edit',compact('inv'));
    }

    public function update(Request $r,$id){

        $inv = Invoice::findOrFail($id);

        $inv->note = $r->note;

        if($r->status){
          $inv->status = $r->status;
          // send notification
        }
        
        $inv->save();
        

        return back()->with('success',"Updated");
    }

 

    public function delete($id){

     if(Auth::user()->role->name =='Admin'){

        return back()->with('danger','Only admin can delete the invoice');
     }

      $inv = Invoice::findOrFail($id);

      if($inv){

        $inv->invoicedetails()->delete();
        $inv->payments()->delete();

        $inv->delete();

        return back()->with('success','The invoice has been deleted');
      }



    }
       
}
