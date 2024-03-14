<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/uplon/layouts/horizontal/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 03:26:31 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Uplon - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Notification css (Toastr) -->
    <link href="{{ asset('assets/libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bootstrap-stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-united.min.css') }}" rel="stylesheet" type="text/css"
        id="bootstrap-united-stylesheet" />

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/apphorizontal.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <!-- Table datatable css -->
    <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

</head>

<body>
    <!--<nav class="navbar navbar-expand-lg sticky-top navbar-dark" style="background-color: #369;">-->
    <!-- Topbar Start -->
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"
                            data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                class="rounded-circle">
                            <span
                                class="d-none d-sm-inline-block ml-1 font-weight-medium">{{ Session::get('display_name') }}
                                ({{ Session::get('rolename') }})</span>
                            <i
                                class="mdi mdi-chevron-down d-none d-sm-inline-block"></i><!--<i class="fa fa-user fa-fw"></i>-->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-outline"></i>
                                <span>Profile</span>
                            </a>
                            <!-- item-->
                            <a href="#" class="dropdown-item notify-item">
                                <i class="mdi mdi-settings-outline"></i>
                                <span>Cambiar clave</span>
                            </a>
                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            {{-- <a href="#" class="dropdown-item notify-item">
                                <i class="mdi mdi-logout-variant"></i>
                                <span>Cerrar sesión</span>
                            </a> --}}
                            <form method="POST" action="{{ route('admin.salir') }}">
                                @csrf
                                <a onclick="$(this).closest('form').submit()" title="Salir"
                                    class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout-variant"></i><span>Cerrar sesión</span>
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="22">
                            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="24">
                        </span>
                    </a>

                    <a href="index.html" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="22">
                            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="{{ asset('assets/images/logo-sm-light.png') }}" alt="" height="24">
                        </span>
                    </a>
                </div>


            </div>
        </div>
        <div class="topbar-menu">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li class="menu">
                            <a href="/">
                                <i class="mdi mdi-view-dashboard"></i>Dashboard
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{ route('admin.users') }}">
                                <i class="mdi mdi-format-underline"></i>Usuarios
                            </a>
                        </li>

                        <li class="menu">
                            <a href="{{ route('admin.institutos') }}">
                                <i class="mdi mdi-black-mesa"></i>Institutos
                            </a>
                        </li>

                        <li class="menu">
                            <a href="#">
                                <i class="mdi mdi-package-variant-closed"></i>Components
                            </a>
                        </li>

                        <li class="menu">
                            <a href="#">
                                <i class="mdi mdi-flip-horizontal"></i>Layouts
                            </a>
                        </li>

                        <li class="menu">
                            <a href="#"> <i class="mdi mdi-google-pages"></i>Pages
                            </a>
                        </li>

                        <li class="menu">
                            <a href="#">
                                <i class="mdi mdi-content-copy"></i>Extra Pages
                            </a>
                        </li>

                    </ul>
                    <!-- End navigation menu -->

                    <div class="clearfix"></div>
                </div>
                <!-- end #navigation -->
            </div>
            <!-- end container -->
        </div>
    </header>

    <!-- Page Content-->
    <div class="wrapper">
        <!-- Page Features-->
        @yield('content')
    </div>

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    2016 - 2019 &copy; Uplon theme by <a href="#">Coderthemes</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->



    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ asset('assets/libs/morris-js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

    <!-- Dashboard init js-->
    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

    <!-- Toastr js -->
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>

    <!-- <script src="< ?= base_url('assets/js/pages/toastr.init.js') }}"></script> -->

    <!-- Datatable plugin js -->
    <script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/vfs_fonts.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.select.min.js') }}"></script>

    <!-- Datatables init -->
    <!-- <script src="< ?= base_url('assets/js/pages/datatables.init.js') }}"></script> -->

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

<!-- Mirrored from coderthemes.com/uplon/layouts/horizontal/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 03:26:55 GMT -->

</html>
