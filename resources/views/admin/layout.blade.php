<!DOCTYPE html>
<html>

<!-- Mirrored from themesdesign.in/admiry/red/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Sep 2019 06:00:28 GMT -->
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>@yield('title')</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!---------------------------custom css links----------------------------->

        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"/>

        @yield('style')
        <!-----toastr style sheet---------->
        <link href="{{asset('toastr/toastr.min.css')}}" rel="stylesheet">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <!--<a href="index.html" class="logo">Admiry</a>-->
                        <a href="index.html" class="logo"><img src="{{asset('assets/images/logo.png')}}" height="42" alt="logo"></a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">

                    <div class="user-details">
                        <div class="user-info">

                            <h4 class="font-16">{{Auth::guard('admin')->user()->name}}</h4>
                            <span class="text-muted user-status"><i class="fa fa-dot-circle-o text-success"></i> Online</span>
                        </div>
                    </div>

                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{route('admin.index')}}" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="{{asset('javascript:void(0);')}}" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Categories</span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('admin.category.create')}}">Create Category</a></li>
                                    <li><a href="{{route('admin.category.index')}}">Show All</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="{{asset('javascript:void(0);')}}" class="waves-effect"><i class="mdi mdi-buffer"></i> <span>Sub Categories</span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('admin.subcategory.create')}}">Create Sub-Category</a></li>
                                    <li><a href="{{route('admin.subcategory.index')}}">Show All</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="{{asset('javascript:void(0);')}}" class="waves-effect"><i class="dripicons-shopping-bag"></i> <span> Products</span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('admin.product.create')}}">Create Product</a></li>
                                    <li><a href="{{route('admin.product.index')}}">Show All</a></li>
                                    <li><a href="{{route('admin.product.limited')}}">Limited Stock</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="{{asset('javascript:void(0);')}}" class="waves-effect"><i class="ion-arrow-graph-up-right"></i> <span>Sales</span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('admin.sales.create')}}">Create Sale</a></li>
                                    <li><a href="{{route('admin.sales.index')}}">Show Graphs</a></li>
                                    <li><a href="{{route('admin.sales.all')}}">Sales</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="{{asset('javascript:void(0);')}}" class="waves-effect"><i class="ion-ios7-cart"></i> <span>Order</span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="#">Confirmed Orders</a></li>
                                    <li><a href="#">Pending Orders</a></li>
                                </ul>
                            </li>


                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>

                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                    <h3 class="page-title">@yield('pagename')</h3>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>
                    <!-- Top Bar End -->

                        @yield('content')

                </div> <!-- content -->

                <footer class="footer">
                    Â© 2017 - 2018 Admiry - By Themesdesign.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/tether.min.js')}}"></script><!-- Tether for Bootstrap -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('assets/js/detect.js')}}"></script>
        <script src="{{asset('assets/js/fastclick.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>

        <script src="{{asset('assets/pages/dashborad.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>


        <!---------------cutome script ------------------>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
        <script src="{{asset('toastr/toastr.min.js')}}"></script>
        @toastr_render
        @yield('script')

    </body>

<!-- Mirrored from themesdesign.in/admiry/red/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Sep 2019 06:01:04 GMT -->
</html>
@yield('modal')










