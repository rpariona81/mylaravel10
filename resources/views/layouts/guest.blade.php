<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/uplon/layouts/horizontal/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 03:28:01 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Log In | Uplon - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bootstrap-stylesheet" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body class="authentication-bg">

    <div class="account-pages pt-5 my-5">
        <div class="container">

            @yield('content')
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

<!-- Mirrored from coderthemes.com/uplon/layouts/horizontal/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Dec 2023 03:28:01 GMT -->

</html>
