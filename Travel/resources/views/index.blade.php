<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('bootstraps/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstraps/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstraps/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstraps/green.css') }}" rel="stylesheet">  
    <link href="{{ asset('bootstraps/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstraps/jqvmap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('bootstraps/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstraps/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/jquery.datetimepicker.min.css') }}">

    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/link.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('css/map.css') }}" rel="stylesheet"/>
    <!-- Design a Footer -->
    <link rel="stylesheet" href="{{ asset('css/Pretty-Registration-Form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Pretty-Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font_awesome.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">

    <script LANGUAGE="JavaScript">
    function confirmAction() {
        return confirm("Are you sure you want to delete?")
    }
    </script> 

</head>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          @include('nav')
      </div>

      <!-- top navigation -->
      <div class="top_nav">
          <div class="nav_menu" style="margin-bottom: 0px">           
              @include('topnav')          
          </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col table-responsive" role="main">
          <!-- top tiles -->
           @yield('content')
      </div>
       
      <!-- /page content -->

       <!-- footer content -->
      <div class="pull-right">
          <footer>
          <div class="col-md-4 col-sm-6 footer-navigation">
                <h4><a href="#">Danang <span>Travel </span></a></h4>
                
                <p class="company-name">TRAVEL MANAGEMENT © 2017 </p>
            </div>
            <div class="col-md-4 col-sm-6 footer-contacts">
                <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                    <p><span class="new-line-span">Nguyen Luong Bang Street</span> Danang, VietNam</p>
                </div>
                <div><i class="fa fa-phone footer-contacts-icon"></i>
                    <p class="footer-center-info email text-left"> +84 (236) 625 3000</p>
                </div>
                <div><i class="fa fa-envelope footer-contacts-icon"></i>
                    <p> <a href="#" target="_blank"> www.travel.com</a></p>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-4 footer-about">
                <h4>Introduction</h4>
                <p>Da Nang is one of the cultural and educational centers of Vietnam, and it is also one of the biggest cities in Vietnam. Da Nang has a long coast with many beautiful beaches such as Non Nuoc, My Khe,... Coming to Da Nang, you will have opportunities to enjoy the beautiful scenery such as Ngu Hanh Son, Ba Na, Son Tra peninsula, Hai Van pass, beaches and many historical relics. 
                </p>
            </div>
                <div class="clearfix"></div>
          </footer>
      </div>
      <!-- /footer content -->
</div>
</div>

<script src="{{ asset('js/jquery-1.12.4.js')}}"></script>
 <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
 <script src="{{ asset('js/search.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>


<!-- bootstrap-progressbar -->
<script src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('js/custom.min.js') }}"></script>

<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.replace('ckeditor');
</script>

 <script src="{{ asset('js/jquery.datetimepicker.full.js')}}"></script>
 <script>
   $(".datetime").datetimepicker({
    step:10
   });
 </script>
 <script src="{{ asset('js/mycustom.js')}}"></script>

</body>
</html>
