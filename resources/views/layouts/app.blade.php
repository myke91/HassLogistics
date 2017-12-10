<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>HASS Logistics</title>
        <meta name="description" content="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="AharaSolutions">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
        <link href="plugins/select2/select2.css" rel="stylesheet">
        <link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
        <link href="css/style_v2.css" rel="stylesheet">
        <link href="plugins/chartist/chartist.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
        <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <script type="text/javascript" src="...js/paging.js"></script>
        <![endif]-->
        <style>
            #ajaxSpinnerContainer{
                position:fixed;
                top:0px;
                right:0px;
                width:100%;
                height:100%;
                background-color:#666;
                background-image:url('img/ajax-loader.gif');
                background-repeat:no-repeat;
                background-position:center;
                z-index:10000000;
                opacity: 0.4;
                filter: alpha(opacity=40); /* For IE8 and earlier */
            }
        </style>


    </head>
    <body>
        <!--Start Header-->
        <div id="screensaver">
            <canvas id="canvas"></canvas>
            <i class="fa fa-lock" id="screen_unlock"></i>
        </div>
        <div id="ajaxSpinnerContainer">
        </div>

    </div>
    <div id="modalbox">
        <div class="devoops-modal">
            <div class="devoops-modal-header">
                <div class="modal-header-name">
                    <span>Basic table</span>
                </div>
                <div class="box-icons">
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="devoops-modal-inner">
            </div>
            <div class="devoops-modal-bottom">
            </div>
        </div>
    </div>
    <header class="navbar">
        <div class="container-fluid expanded-panel">
            <div class="row">
                <div id="logo" class="col-xs-12 col-sm-2">
                    <a href="{{route('dashboard')}}"><span style="color: #ff2d55">H</span><span style="color: #20895e">A</span><span style="color: #F4C63D">S</span><span style="color: #0066ff">S</span>
                        Logistics</a>
                </div>
                <div id="top-panel" class="col-xs-12 col-sm-10">
                    <div class="row">
                        <div class="col-xs-8 col-sm-4 top-panel-right">
                            <div id="search">
                                <input type="text" placeholder="search"/>
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-8 top-panel-right">
                            <ul class="nav navbar-nav pull-right panel-menu">
                                @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                        <i class="fa fa-angle-down pull-right"></i>
                                        <div class="user-mini pull-right">
                                            <span class="welcome">Welcome,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <span>{{ Auth::user()->fullname }}</span>
                                        </div>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <i class="fa fa-user"></i>
                                            <span>
                                                <a href="{{route('add_new_user')}}">User Management</a>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="fa fa-power-off"></i>
                                            <span><a href="{{ route('logout') }}"
                                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                            </span>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @endguest
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </header>
    <!--End Header-->
    <!--Start Container-->
    <div id="main" class="container-fluid">
        <div class="row">
            <div id="sidebar-left" class="col-xs-2 col-sm-2">
                <ul class="nav main-menu">
                    @if(Auth::user()->role_id == 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-picture-o"></i>
                            <span class="hidden-xs">Data Entry</span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="{{route('add_vessel')}}"><i class="fa fa-shield">&nbsp;</i>Vessels</a></li>

                            <li><a href="{{route('add_client')}}"><i class="fa fa-users">&nbsp;</i>Clients</a></li>
                            <li><a href="{{route('add_vessel_operator')}}"><i class="fa fa-gears">&nbsp;</i>Vessel Operators </a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-plus-circle"></i>
                                    <span class="hidden-xs"> Port Charges</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('getTarrifForm')}}">&nbsp;&nbsp;&nbsp;<i class="fa fa-database">&nbsp;</i>Tarrif </a></li>
                                    <li><a href="{{route('getTarrifTypeForm')}}">&nbsp;&nbsp;&nbsp;<i class="fa fa-database">&nbsp;</i>Tarrif Type</a></li>
                                    <li><a href="{{route('getTarrifParamForm')}}">&nbsp;&nbsp;&nbsp;<i class="fa fa-database">&nbsp;</i>Tarrif Parameters</a></li>
                                    <li><a href="{{route('getTarrifChargeForm')}}">&nbsp;&nbsp;&nbsp;<i class="fa fa-database">&nbsp;</i>Tarrif Charges</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-table"></i>
                            <span class="hidden-xs">Invoicing</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('invoice')}}"><i class="fa fa-shopping-cart">&nbsp;</i>Prepare Invoice</a></li>
                            <li><a href="{{route('invoiceInfoPage')}}"><i class="fa fa-history">&nbsp;</i>Invoice History</a></li>
                            <li><a href="{{route('getTrackPayments')}}"><i class="fa fa-credit-card">&nbsp;</i>Track Payments</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-pencil-square-o"></i>
                            <span class="hidden-xs">Payment</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('getPayment')}}"><i class="fa fa-money">&nbsp;</i>Make Payment</a></li>
                            <li><a href="{{route('cashPayments')}}"><i class="fa fa-certificate">&nbsp;</i>Cash Payments</a></li>
                            <li><a  href="{{route('chequePayments')}}"><i class="fa fa-vk">&nbsp;</i>Cheque Payments</a></li>
                            <li><a  href="{{route('paymentOnAccount')}}"><i class="fa fa-anchor">&nbsp;</i>Payment On Account</a></li>
                        </ul>
                    </li>
                    <!--                        <li class="dropdown">
                                                <a href="#" class="dropdown-toggle">
                                                    <i class="fa fa-desktop"></i>
                                                    <span class="hidden-xs">Reporting</span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="ajax-link" href="ajax/ui_grid.html">Grid</a></li>
                                                    <li><a class="ajax-link" href="ajax/ui_buttons.html">Buttons</a></li>
                                                    <li><a class="ajax-link" href="ajax/ui_progressbars.html">Progress Bars</a></li>
                                                    <li><a class="ajax-link" href="ajax/ui_jquery-ui.html">Jquery UI</a></li>
                                                    <li><a class="ajax-link" href="ajax/ui_icons.html">Icons</a></li>
                                                </ul>
                                            </li>-->
                    @endif
                </ul>
            </div>
            <!--Start Content-->
            <div id="content" class="col-xs-12 col-sm-10">

                <div id="ajax-content">
                    @yield('content')
                </div>
            </div>
            <!--End Content-->
        </div>
    </div>
    <!--End Container-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="http://code.jquery.com/jquery.js"></script>-->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <script src="plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
    <script src="plugins/tinymce/tinymce.min.js"></script>
    <script src="plugins/tinymce/jquery.tinymce.min.js"></script>

    <!-- All functions for this theme + document.ready processing -->
    <script src="js/devoops.js"></script>

    @yield('additional_script')
</body>
<script>
                                                         $(document).ready(function () {
                                                             $.ajaxSetup({
                                                                 headers: {
                                                                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                 }
                                                             });

                                                         }).ajaxStart(function () {
                                                             $("#ajaxSpinnerContainer").show();
                                                         })
                                                                 .ajaxStop(function () {
                                                                     $("#ajaxSpinnerContainer").hide();
                                                                 });
</script>
</html>
