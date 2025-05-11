<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admin/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Tasu</h1>

          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">Food </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('addfood')}}">Add Food</a></li>
                    <li><a href="{{url('viewfood')}}">View Food</a></li>
                  </ul>
                </li>

                <li><a href="{{url('orders')}}"> Orders </a></li>
      </nav>
      <!-- Sidebar Navigation end-->