<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DMS Software</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-confirm.min.css') }}">
    @stack('css')
    <style>
        .available {
            background-color: rgb(230, 241, 230);
        }

        .unavailable {
            background-color: rgb(246, 218, 218);
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.partials.topbar')
                @yield('content')

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            @include('layouts.partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-confirm.min.js') }}"></script>

    @stack('js')

    <script>
        // toastr configuration 
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": 2000,
        }

        // toastr message setup
        if ('{{ session('success') }}') {
            toastr.success('{{ session('success') }}');
        }

        if ('{{ session('error') }}') {
            toastr.error('{{ session('error') }}');
        }

        // remove caching session from blade
        '{{ session()->forget('success') }}'
        '{{ session()->forget('error') }}'
    </script>


</body>

</html>
