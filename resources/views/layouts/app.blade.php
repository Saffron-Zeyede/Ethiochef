<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon2.png') }}">

    <title>
        @yield('title')
    </title>
    <link href="{{ asset('css/admin/float-chart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.min.css') }}" rel="stylesheet">

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    @yield('css')

</head>

<body>

<!--Preloader - spinners.css-->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<!--pages.scss-->
<div id="main-wrapper">

    <!-- The top header -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">

            <div class="navbar-header" data-logobg="skin5">
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <b class="logo-icon p-l-10">
                        <img src="{{ asset('images/logo-icon2.png') }}" alt="homepage" class="light-logo" />
                    </b>
                    <span class="logo-text">
                         <img src="{{ asset('images/logo-text2.png') }}" alt="homepage" class="light-logo" />

                    </span>
                </a>
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>

            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                <!-- toggle and nav items -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                    <!-- Search -->
{{--                    <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>--}}
{{--                        <form class="app-search position-absolute" action="{{ route('foods.index') }}" method="GET">--}}
{{--                            <input type="text" class="form-control" name="search" placeholder="Search..."> <a class="srh-btn"><i class="ti-close"></i></a>--}}
{{--                        </form>--}}
{{--                    </li>--}}
                </ul>

                <!-- User profile-->
                <ul class="navbar-nav float-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('images/d2.jpg') }}" alt="user" class="rounded-circle" width="31"></a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated">
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                            <a class="dropdown-item" href="{{ route('inbox') }}"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off m-r-5 m-l-5"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="get" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <!-- Left Sidebar - sidebar.scss  -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('categories.index') }}" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Food Categories</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('foods.index') }}" aria-expanded="false"><i class="mdi mdi-food-variant"></i><span class="hide-menu">Foods</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('deleted-foods') }}" aria-expanded="false"><i class="mdi mdi-delete-circle"></i><span class="hide-menu">Deleted Foods</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('inbox') }}" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">Inboxes</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" target="_blank" href="https://www.megebaserar.com" aria-expanded="false"><i class="mdi mdi-web"></i><span class="hide-menu">View site </span></a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="page-wrapper">

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        @yield('content')

        <!-- footer -->
        <footer class="footer text-center" style="margin-top: 2%">
            Copyright &copy; 2025 Ethiochef. All Rights Reserved
        </footer>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/admin/jquery.min.js') }}"></script>
<script src="{{ asset('js/admin/popper.min.js') }}"></script>
<script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/admin/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('js/admin/sparkline.js') }}"></script>
<script src="{{ asset('js/admin/waves.js') }}"></script>
<script src="{{ asset('js/admin/sidebarmenu.js') }}"></script>
<script src="{{ asset('js/admin/custom.min.js') }}"></script>

<script src="{{ asset('js/admin/matrix.interface.js') }}"></script>
<script src="{{ asset('js/admin/excanvas.min.js') }}"></script>

<script src="{{ asset('js/admin/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('js/admin/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('js/admin/flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('js/admin/flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('js/admin/flot/jquery.flot.crosshair.js') }}"></script>
<!--<script src="js/admin/flot/jquery.flot.tooltip.min.js"></script>-->

<script src="{{ asset('js/admin/jquery.peity.min.js') }}"></script>
<script src="{{ asset('js/admin/matrix.charts.js') }}"></script>

<script src="{{ asset('js/admin/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('js/admin/jquery.flot.tooltip.min.js') }}"></script>

<script src="{{ asset('js/admin/turning-series.js') }}"></script>

<script src="{{ asset('js/admin/chart-page-init.js') }}"></script>



@yield('scripts')

</body>

</html>
