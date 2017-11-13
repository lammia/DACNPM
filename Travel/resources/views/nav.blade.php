<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="{{url('login')}}" class="site_title"><span>TRAVEL</span></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile clearfix">
    <div class="profile_pic">
      <img src="{{asset('upload/default.png')}}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
      <span>Welcome,</span>
      <h2>Admin</h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>Menu</h3>
      <ul class="nav side-menu">
        <li><a href="{{url('user')}}"><i class="fa fa-table"></i> User</a>
        </li>
        <li><a href="{{url('place')}}"><i class="fa fa-table"></i> Place</a>
        </li>
        <li><a href="{{url('event')}}"><i class="fa fa-table"></i> Event</a>
        </li>
        <li><a href="{{url('festival')}}"><i class="fa fa-table"></i> Festival</a>
        </li>
        <li><a href="{{url('discount')}}"><i class="fa fa-table"></i> Discount</a>
        </li>
        <li><a href="{{url('tour')}}"><i class="fa fa-table"></i> Tour</a>
        </li>
      </ul>
    </div>
  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  
  <!-- /menu footer buttons -->
</div>