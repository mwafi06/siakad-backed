<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ ucfirst($page).' - ' ?? null }} {{ ucfirst($title) }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('themes/css/main.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @stack('customCss')
</head>
<body class="hold-transition layout-fixed layout-navbar-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('layout.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid" style="padding-top: 20px">
                {!! general()->flashMessage() !!}

                @includeWhen(isset($content),isset($content) ? 'page.'.$content : null)
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('themes/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('themes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('themes/plugins/jquery-redirect/jquery.redirect.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('themes/js/adminlte.min.js') }}"></script>

<script src="{{ asset('themes/js/main.js') }}"></script>

@stack('customJs')
</body>
</html>
