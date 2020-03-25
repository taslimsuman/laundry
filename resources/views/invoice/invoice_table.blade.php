<table class="table">
    <thead>
      <tr>
        <th scope="col">Inv#</th>
        <th scope="col">Date</th>
        <th scope="col">Customer</th>
        <th scope="col">Inv Amount</th>
        <th scope="col">Status</th>
        <th scope="col">Pay Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoices as $inv)
      <tr>
        <th scope="row">{{$inv->id}}</th>
        <td>{{$inv->idate}}</td>
        <td ><a href="{{url('/invoice',$inv->id)}}" target="_blank">{{$inv->customer_name}}</a></td>
        <td>{{$inv->net_amount}}</td>
        <td>{{$inv->status}}</td>
        <td>{{$inv->pay_status}}</td>
        <td>
          <a href="{{url('/invoice',$inv->id)}}" target="_blank" class="btn btn-success">Open</a>
          <a href="{{url('/invoice/update',$inv->id)}}" class="btn btn-info">Update</a>
          <a href="{{url('/invoice/delete',$inv->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure delete this invoice?');">
            <i class="fa fa-trash"></i></a>
        </td>
        
      </tr>
      @endforeach
    </tbody>
</table>
{{$invoices->appends(Request::except('page'))->links()}}