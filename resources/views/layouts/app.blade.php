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
</head>
<body>
<!--Start Header-->
<div id="screensaver">
    <canvas id="canvas"></canvas>
    <i class="fa fa-lock" id="screen_unlock"></i>
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
                <div class="row" style="width: 100%">
                    <div class="col-xs-8 col-sm-4 top-panel-right">
                        <div id="search">
                            <input type="text" placeholder="search"/>
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 pull-right" >
                        @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('add_new_user') }}">Add New User</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                    </div>
                    <
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

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-bar-chart-o"></i>
                        <span class="hidden-xs">Data Entry</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('add_vessel')}}"><i class="fa fa-book">&nbsp;</i>Vessels</a></li>
                        <li><a href="{{route('add_client')}}"><i class="fa fa-book">&nbsp;</i>Clients</a></li>
                        <li><a href="{{route('add_vessel_operator')}}"><i class="fa fa-book">&nbsp;</i>Vessel Operators </a></li>
                        <li><a href="{{route('add_vessel_operator')}}"><i class="fa fa-book">&nbsp;</i>Load Port Charges</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-table"></i>
                        <span class="hidden-xs">Invoicing</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('invoice')}}"><i class="fa fa-book">&nbsp;</i>Prepare Invoice</a></li>
                        <li><a href="{{route('invoiceInfoPage')}}"><i class="fa fa-book">&nbsp;</i>Invoice History</a></li>
                        <li><a href="{{route('add_vessel_operator')}}"><i class="fa fa-book">&nbsp;</i>Track Payments</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-pencil-square-o"></i>
                        <span class="hidden-xs">Payment</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('getPayment')}}">Make Payment</a></li>
                        <li><a  href="{{route('getPayment')}}">Cash Payments</a></li>
                        <li><a  href="{{route('getPayment')}}">Cheque Payments</a></li>
                        <li><a  href="{{route('getPayment')}}">Payment On Account</a></li>
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
<!-- jsPDF scripts -->
<script src="plugins/jspdf/jspdf.js"></script>
<script src="plugins/jspdf/from_html.js"></script>
<script src="plugins/jspdf/split_text_to_size.js"></script>
<script src="plugins/jspdf/standard_fonts_metrics.js"></script>
<script src="plugins/jspdf/cell.js"></script>
<script src="plugins/jspdf/html2pdf.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>

@yield('additional_script')
</body>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
</html>
