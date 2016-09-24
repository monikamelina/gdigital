<!DOCTYPE html>
<html lang="en">
  <head>
   @include('includes.head')
  </head>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><i class="fa fa-glide"></i> <span>{{ config('app.name', 'GDigital') }}</span></a>
            </div>

            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{ '/images/profile.jpg' }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome</span> <h2>{{ Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            @include('includes.sidebar')
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        @include('includes.topmenu')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="page-title">
              <div class="title_left"> </div>
              </div>
              @include('vendor.flash.message')
              <div class="clearfix"></div>
              <div class="container">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright  &copy; 2016 <a href="https://www.genesisdigital.co/">Genesis Digital </a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    @include('includes.footer')
  </body>
</html>