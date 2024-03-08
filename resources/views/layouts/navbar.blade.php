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
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/users/avatar-1.jpg')}}" alt="user-image" class="rounded-circle">
                        <span class="d-none d-sm-inline-block ml-1 font-weight-medium"><?= $this->session->userdata('user_nickname').' ('.$this->session->userdata('user_role') . ')'  ?></span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i><!--<i class="fa fa-user fa-fw"></i>-->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-outline"></i>
                            <span>Profile</span>
                        </a>
                        <!-- item-->
                        <a href="{{ route('/user/credenciales') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-settings-outline"></i>
                            <span>Cambiar clave</span>
                        </a>
                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="<?= base_url('/home/logout') ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>Cerrar sesión</span>
                        </a>
                    </div>
                </li>
            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.html" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="<?= base_url('assets/images/logo.png') ?>" alt="" height="22">
                        <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-lg-text-dark">U</span> -->
                        <img src="<?= base_url('assets/images/logo-sm.png') ?>" alt="" height="24">
                    </span>
                </a>

                <a href="index.html" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="<?= base_url('assets/images/logo-light.png') ?>" alt="" height="22">
                        <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-lg-text-dark">U</span> -->
                        <img src="<?= base_url('assets/images/logo-sm-light.png') ?>" alt="" height="24">
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
                        <a href="index.html">
                            <i class="mdi mdi-view-dashboard"></i>Dashboard
                        </a>
                    </li>

                    <li class="menu">
                        <a href="<?=site_url('admin/users')?>">
                            <i class="mdi mdi-format-underline"></i>Usuarios
                        </a>
                    </li>

                    <li class="menu">
                        <a href="<?=site_url('admin/institutos')?>">
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
