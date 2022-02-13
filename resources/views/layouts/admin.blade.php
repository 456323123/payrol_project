
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Pay Roll</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css')}}">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    {{--  //toster  --}}
     <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/tether-theme-arrows.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/tether.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/shepherd-theme-default.css') }}"><link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/dropify/css/dropify.min.css') }}">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">

</head>
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Navbar-->
    @include('Admin.components.navbar')
    <!--End: Navbar-->

    <!-- BEGIN: Sidebar-->
    @include('Admin.components.sidebar')
    <!-- END: Sidebar-->



    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">

                @yield('content')


            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>



    <!-- BEGIN: Vendor JS-->

    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
        <script src="{{  asset('app-assets/vendors/js/forms/select/select2.full.min.js')  }} "></script>

    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ asset('app-assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/masking-input.js') }}"  data-autoinit="true"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
        <script src="{{asset('app-assets/dropify/js/dropify.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="../../../app-assets/js/scripts/forms/select/form-select2.js"></script>

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>

    <script>
    $(document).ready(function(){
        $("#contact").inputmask({ mask: "(999) 999-9999" });
$(":input").inputmask();
                    $('.summernote').summernote({
                height: 150,
            });
        $(function () {
            $(".datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: '-0m',
                minDate: 0,
            });
        });
        var deleteID = document.querySelectorAll(".alert-confirm");
        deleteID.forEach(function(e) {
            e.addEventListener("click", function(event) {
                event.preventDefault();
                $url=$(this).attr("href");
                swal({
                    title: 'Are you sure?',
                    text: 'You want be to do this?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = $url;
                    }

                    });
            });
            });
        });
    </script>
    <script>
       	@if(session('message'))
            toastr.success("{{ session('message') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        $('.dropify').dropify();
    </script>
    <script>
        function deleteAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }
        function unblockAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Activate!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, activate it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }
    </script>


    @yield('js')

</body>
<!-- END: Body-->

</html>
