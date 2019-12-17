<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>

    @yield('css')
    <!-- Bootstrap Core CSS -->
    <!-- a --><link href="{{ ('/booking-dev/public/ampleplugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"> 
    
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Menu CSS -->
    <!-- a --><link href="{{ ('/booking-dev/public/ampleplugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    
    <!--alerts CSS -->
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Page plugins css -->
    <!-- <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet"> -->
    
    <!-- Color picker plugins css -->
    <!-- <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet"> -->
    
    <!-- Date picker plugins css -->
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Daterange picker plugins css -->
    <!-- <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"> -->
    
    <!-- <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"> -->
    
    <!-- animation CSS -->
    <!-- a --><link href="{{ ('/booking-dev/public/ampleplugins/css/animate.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <!-- a --><link href="{{ ('/booking-dev/public/ampleplugins/css/style.css') }}" rel="stylesheet">
    
    <!-- color CSS -->
    <!-- a --><link href="{{ ('/booking-dev/public/ampleplugins/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">
    
    <!-- page CSS -->
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css') }}" />
    
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    
    <link href="{{ ('/booking-dev/public/ampleplugins/bower_components/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a href="{{ url('/home') }}" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="hidden-sm hidden-md hidden-lg">Ruang</span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="hidden-xs p-l-10">Ruang BPAD</span>
                    </a>
                    
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                <?php if (Auth::check()) { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{ ('/booking-dev/public/ampleplugins/images/users/varun.jpg') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{Session::get('user_data')->name}}</b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ ('/booking-dev/public/ampleplugins/images/users/varun.jpg') }}" alt="user" /></div>
                                    <div class="u-text"><h4>{{Session::get('user_data')->name}}</h4><p class="text-muted">{{ucwords(Session::get('user_data')->bidang_name)}}</p></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <!-- <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li> -->
                            <li>
                                <a class="dropdown-item btn btn-danger btn-flat" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="dropdown tasks-menu" style="background-color: green">
                        <a href="{{ url('login') }}" class="nav-link">
                            Login
                        </a>
                    </li>
                <?php } ?>                  
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Menu</span></h3> 
                </div>
                <ul class="nav" id="side-menu">
                    <li class="devider"></li>
                    <li> <a href="{{ url('home') }}" class="waves-effect"><i class="mdi mdi-home fa-fw" data-icon="v"></i> <span class="hide-menu"> Home </span></a></li>

                    @if(Auth::check() and Session::get('user_data')->user_status == 1)
                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-human-male fa-fw" data-icon="v"></i> <span class="hide-menu"> Pengguna <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ url('users') }}"><i class=" fa-fw">1</i><span class="hide-menu">Kelola Pengguna</span></a> </li>
                            <li><a href="{{ url('roles') }}"><i class=" fa-fw">2</i><span class="hide-menu">Kelola Hak Akses</span></a> </li>
                        </ul>
                    </li>
                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-key fa-fw" data-icon="v"></i> <span class="hide-menu"> Master Data <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ url('time') }}"><i class=" fa-fw">1</i><span class="hide-menu">Data Waktu</span></a> </li>
                            <li><a href="{{ url('bidang') }}"><i class=" fa-fw">2</i><span class="hide-menu">Data Bidang</span></a> </li>
                            <li><a href="{{ url('book_status') }}"><i class=" fa-fw">3</i><span class="hide-menu">Data Status</span></a> </li>
                            <li><a href="{{ url('ruang') }}"><i class=" fa-fw">4</i><span class="hide-menu">Data Ruang</span></a> </li>
                            <li><a href="{{ url('tipe_ruang') }}"><i class=" fa-fw">5</i><span class="hide-menu">Data Tipe Ruang</span></a> </li>
                        </ul>
                    </li>
                    @endif

                    <li class="devider"></li>

                    @if(Auth::check() and Auth::user()->user_status == 2)
                        <li><a href="{{ url('booking/form') }}" class="waves-effect"><i class="mdi mdi-plus fa-fw"></i> <span class="hide-menu">Buat Pinjaman Baru</span></a></li>
                    @endif

                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-book-open fa-fw" data-icon="v"></i> <span class="hide-menu"> Booking <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ url('booking') }}"><i class=" fa-fw">1</i><span class="hide-menu">Semua Pinjaman</span></a> </li>
                            @if(Auth::check())
                                @if(Auth::user()->user_status == 2)
                                    <li><a href="{{ url('booking/my-booking') }}"><i class=" fa-fw">2</i><span class="hide-menu">Pinjaman Saya</span></a> </li>
                                    <li><a href="{{ url('booking/bidang-lain') }}"><i class=" fa-fw">3</i><span class="hide-menu">Pinjaman Dari Bidang Lain</span></a> </li>
                                @elseif(Auth::user()->user_status != 2)
                                    <li><a href="{{ url('booking/not') }}"><i class=" fa-fw">2</i><span class="hide-menu">Pinjaman Belum Disetujui</span></a> </li>
                                    <li><a href="{{ url('booking/cancel') }}"><i class=" fa-fw">3</i><span class="hide-menu">Pinjaman Dibatalkan</span></a> </li>
                                    <li><a href="{{ url('booking/done') }}"><i class=" fa-fw">4</i><span class="hide-menu">Pinjaman Telah Disetujui</span></a> </li>
                                @endif
                            @endif
                        </ul>
                    </li>

                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-note-outline fa-fw" data-icon="v"></i> <span class="hide-menu"> Rekap Bulanan <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ url('list/bidang') }}"><i class=" fa-fw">1</i><span class="hide-menu">Per Bidang</span></a> </li>
                            <li><a href="{{ url('list/ruang') }}"><i class=" fa-fw">2</i><span class="hide-menu">Per Ruang</span></a> </li>
                        </ul>
                    </li>
                    
                    <li class="devider"></li>

                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-help-circle fa-fw" data-icon="v"></i> <span class="hide-menu"> Bantuan <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ url('home/downloadManual') }}"><i class=" fa-fw">1</i><span class="hide-menu">Manual Book</span></a> </li>
                            <!-- <li><a href="{{ url('list/ruang') }}"><i class=" fa-fw">2</i><span class="hide-menu">Kontak</span></a> </li> -->
                            <li><a href="#" class="waves-effect"><i class=" fa-fw">2</i><span class="hide-menu">Kontak</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="javascript:void(0)"><i class="mdi mdi-whatsapp fa-fw" data-icon="v"></i><span class="hide-menu"> 0812-8169-3711<br>IVALDY PUTRA </span></a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        @yield('content')
        
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <!-- a --><script src="{{ ('/booking-dev/public/ampleplugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <!-- a --><script src="{{ ('/booking-dev/public/ampleplugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <!-- Menu Plugin JavaScript -->
    <!-- a --><script src="{{ ('/booking-dev/public/ampleplugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    
    <!--slimscroll JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/js/jquery.slimscroll.js') }}"></script>
    
    <!--Wave Effects -->
    <script src="{{ ('/booking-dev/public/ampleplugins/js/waves.js') }}"></script>
    
    <!-- Sweet-Alert  -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/js/custom.min.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    
    <!-- Plugin JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/moment/moment.js') }}"></script>
    
    <!-- Clock Plugin JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}"></script>
    
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    
    <!-- Date range Plugin JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/switchery/dist/switchery.min.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript" src="{{ ('/booking-dev/public/ampleplugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    
    <script src="{{ ('/booking-dev/public/ampleplugins/js/cbpFWTabs.js') }}"></script>
    

    <!-- jquery validation -->
    <!-- <script src="{{ ('/booking-dev/public/js/jquery-validation2/dist/jquery.validate.min.js') }}"></script> -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    
    <!--Style Switcher -->
    <script src="{{ ('/booking-dev/public/ampleplugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>

    @yield('datepicker')
  
    @yield('formvalidation')

    @yield('datatable')

    @yeild('stylishtabs')

    @yield('formadvanced')
</body>

</html>