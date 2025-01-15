<!doctype html>
<html lang="en" dir="ltr">
<head>

    @include('dashboard.layout.headerScript')
    <title>@yield('title')</title>
    @stack('css')

</head>

<body class="main-body app sidebar-mini dark-theme">

<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('dashboard/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page">
    @include('dashboard.layout.sidebar')

    <!-- main-content -->
    <div class="main-content app-content">

        <!-- main-header -->
        @include('dashboard.layout.header')        <!-- /main-header -->

        <!-- container -->
        <div class="container-fluid">

            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">Pages</h4><span
                            class="text-muted mt-1 tx-13 ml-2 mb-0">/ @yield('breadcrumb')</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->
            <!-- row -->
            <div class="row">
                @yield('content')

            </div>
            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->


    @include('dashboard.layout.footer')

</div>
<!-- End Page -->
@include('dashboard.layout.footerScript')
@stack('js')
</body>
</html>
