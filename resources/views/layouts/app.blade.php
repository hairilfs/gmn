<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GMN | @yield('title', 'Dashboard') </title>
  <base href="{{ url('/').'/' }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">

  @yield('head_css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>MN</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>GMN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> {{ Auth::user()->email }}</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="@yield('nav_dashboard', '')">
          <a href="{{ url('/') }}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="@yield('nav_pb', '')">
          <a href="{{ url('performance_budget') }}">
            <i class="fa fa-star"></i> <span>Performance Budget</span>
          </a>
        </li>
        <li class="@yield('nav_po', '')">
          <a href="{{ url('purchase_order') }}">
            <i class="fa fa-file-text"></i> <span>Purchase Order</span>
          </a>
        </li>
        <li class="@yield('nav_invoice', '')">
          <a href="{{ url('invoice') }}">
            <i class="fa fa-envelope"></i> <span>Invoice</span>
          </a>
        </li>
        <li class="@yield('nav_pembayaran', '')">
          <a href="{{ url('pembayaran') }}">
            <i class="fa fa-money"></i> <span>Pembayaran</span>
          </a>
        </li>

        <li class="@yield('nav_realisasi', '')">
          <a href="{{ url('realisasi') }}">
            <i class="fa fa-bar-chart"></i> <span>Realisasi</span>
          </a>
        </li>
        <li class="@yield('nav_', '')">
          <a href="{{ url('/') }}">
            <i class="fa fa-th"></i> <span>Keterangan</span>
          </a>
        </li>

        <li>
          <a href="{{ url('auth/logout') }}">
            <i class="fa fa-close"></i> <span>Logout</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Hot</small>
            </span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->

  @yield('content')

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/fastclick/fastclick.js"></script>
<script src="assets/js/app.min.js"></script>
{{-- <script src="assets/js/demo.js"></script> --}}

@yield('bottom_script')

</body>
</html>
