<ul class="sidebar-menu">
        <li class="treeview">
          <a href="{{url('/dashboard')}}">
            <i class="fa fa-tachometer"></i> <span>Dashboard</span>
          </a>
        </li>
      

        <li class="treeview">
          <a href="#"><i class="fa fa-file"></i> <span>Invoice</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        
          <ul class="treeview-menu">
            <li><a href="{{url('/invoice/create')}}">Add New</a></li>
            <li><a href="{{url('/invoices/all')}}">All</a></li>
            <li><a href="{{url('/invoices/collection')}}">Collection</a></li>
            <li><a href="{{url('/invoices/process')}}">Process</a></li>
            <li><a href="{{url('/invoices/ready')}}">Ready</a></li>
            <li><a href="{{url('/invoices/delivered')}}">Delivered</a></li>
            
          </ul>
          
        </li>             

        @if(Auth::user()->role->name =='Admin')
        <li class="treeview">
          <a href="#"><i class="fa fa-cog"></i> <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-user-circle-o pull-right"></i>
            </span>
          </a>
        
            <ul class="treeview-menu">
            <li><a href="{{url('items')}}">Price List</a></li>
            <li><a href="{{url('users')}}">All Users</a></li>
            <li><a href="{{url('settings')}}">Settings</a></li>
          </ul>
          
        </li>
        @endif

      

</ul>