<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/back/images/favicon.png')}}">
    <title>@yield("title", "{{Lang::get('messages.Default')}}") - {{Lang::get('messages.TaxMendez')}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/back/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/back/plugins/datatables/media/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('assets/back/css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('assets/back/css/colors/default-dark.css')}}" id="theme" rel="stylesheet">

    <!-- toast CSS -->
    <link href="{{asset('assets/back/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">

    <link href="{{asset('assets/back/css/custom.css')}}" id="theme" rel="stylesheet">
    @yield('styles')
</head>
<body class="fix-header fix-sidebar card-no-border">
    <input type="hidden" id="EmptyTable" value="{{Lang::get('messages.EmptyTable')}}" />
    <input type="hidden" id="Info" value="{{Lang::get('messages.Info')}}" />
    <input type="hidden" id="InfoEmpty" value="{{Lang::get('messages.InfoEmpty')}}" />
    <input type="hidden" id="InfoFiltered" value="{{Lang::get('messages.InfoFiltered')}}" />
    <input type="hidden" id="InfoPostFix" value="{{Lang::get('messages.InfoPostFix')}}" />
    <input type="hidden" id="Decimal" value="{{Lang::get('messages.Decimal')}}" />
    <input type="hidden" id="Thousands" value="{{Lang::get('messages.Thousands')}}" />
    <input type="hidden" id="LengthMenu" value="{{Lang::get('messages.LengthMenu')}}" />
    <input type="hidden" id="LoadingRecords" value="{{Lang::get('messages.LoadingRecords')}}" />
    <input type="hidden" id="Processing" value="{{Lang::get('messages.Processing')}}" />
    <input type="hidden" id="Search" value="{{Lang::get('messages.Search')}}:" />
    <input type="hidden" id="SearchPlaceholder" value="{{Lang::get('messages.SearchPlaceholder')}}" />
    <input type="hidden" id="Url" value="{{Lang::get('messages.Url')}}" />
    <input type="hidden" id="ZeroRecords" value="{{Lang::get('messages.ZeroRecords')}}" />
    <input type="hidden" id="first" value="{{Lang::get('pagination.first')}}" />
    <input type="hidden" id="last" value="{{Lang::get('pagination.last')}}" />
    <input type="hidden" id="next" value="{{Lang::get('pagination.next')}}" />
    <input type="hidden" id="previous" value="{{Lang::get('pagination.previous')}}" />

    <input type="hidden" id="cropDimention" value="{{Lang::get('messages.CropDimention')}}" />
    <input type="hidden" id="cropCut" value="{{Lang::get('messages.CropCut')}}" />

    <input type="hidden" id="SwalTitleWarning" value="{{Lang::get('messages.SwalTitleWarning')}}">
    <input type="hidden" id="SwalDescWarning" value="{{Lang::get('messages.SwalDescWarning')}}">
    <input type="hidden" id="SwalTypeWarning" value="{{Lang::get('messages.SwalTypeWarning')}}">
    <input type="hidden" id="SwalAcceptWarning" value="{{Lang::get('messages.Accept')}}">
    <input type="hidden" id="SwalCancelWarning" value="{{Lang::get('messages.Cancel')}}">

    <input type="hidden" id="DropifyDefault" value="{{Lang::get('messages.DropifyDefault')}}">
    <input type="hidden" id="DropifyReplace" value="{{Lang::get('messages.DropifyReplace')}}">
    <input type="hidden" id="DropifyRemove" value="{{Lang::get('messages.DropifyRemove')}}">
    <input type="hidden" id="DropifyError" value="{{Lang::get('messages.DropifyError')}}">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('theme.back.top_header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('theme.back.aside')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Content -->
                <!-- ============================================================== -->
                @yield('content')
                <!-- ============================================================== -->
                <!-- End Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    @yield('contenido')
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('theme.back.footer')
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/back/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/back/plugins/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/back/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/back/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('assets/back/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('assets/back/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('assets/back/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/back/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('assets/back/js/custom.min.js')}}"></script>

    <script src="{{asset('assets/back/plugins/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('assets/back/plugins/datatables/datatables.min.js')}}"></script>
    
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/back/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>

    <script src="{{asset('assets/back/scripts/funciones.js')}}"></script>

    <script src="{{asset('assets/back/scripts/buscador.js')}}"></script>

    <!-- ============================================================== -->
    <!-- Plugins para páginas específicas -->
    <!-- ============================================================== -->
    @yield('scriptsPlugins')
    <!-- ============================================================== -->
    <!-- Scripts para páginas específicas -->
    <!-- ============================================================== -->
    @yield('scripts')
</body>
</html>