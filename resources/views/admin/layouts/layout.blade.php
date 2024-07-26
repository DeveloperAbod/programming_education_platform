<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">


<!-- BEGIN: Head-->

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="author" content="Yemen verse company | developer Abod" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

    @yield('page_meta')


    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet" />

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/vendors-rtl.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/weather-icons/climacons.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/fonts/meteocons/style.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/charts/morris.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/charts/chartist.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/charts/chartist-plugin-tooltip.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/fonts/line-awesome/css/line-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/extensions/zoom.css">

    <!-- sweet alert -->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/extensions/sweetalert2.min.css" />
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/bootstrap-extended.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/colors.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/components.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/custom-rtl.min.css" />
    <!-- END: Theme CSS-->


    @yield('page_css')


    <!-- BEGIN: Custom CSS if you want add new css-->
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/style-rtl.css" />
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->


<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">


    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="navbar-brand" style="padding: 25px 0 !important;" href="/control"><img
                                class="brand-logo" alt="logo" src="/admin/app-assets/images/logo/logo_light.png" />
                            <h4 class="brand-text">منصة تعليم البرمجة اونلاين</h4>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="la la-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ft-menu"></i></a>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a>
                        </li>


                    </ul>

                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown"><span class="mr-1 user-name text-bold-700 d-inline">مرحباً
                                    {{ Auth::user()->name }}</span><span class="avatar avatar-online"><img
                                        src="/uploads/{{ Auth::user()->avatar }}"
                                        alt="{{ Auth::user()->name }}_avatar" /><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right" style="padding-left: 15px">

                                <a class="dropdown-item" href="{{ route('user_profile') }}"><i
                                        class="ft-user"></i>تعديل
                                    الملف الشخصي</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="ft-power"></i>
                                    تسجيل الخروج</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->

    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item mt-2 {{ Request::is('control') ? 'active open' : '' }}">
                    <a href="/control"><i class="la la-home"></i><span class="menu-title">الصفحة الرئيسية</span></a>
                </li>

                @canany(['عرض المستخدمين', 'اضافة مستخدم', 'عرض الصلاحيات', 'اضافة صلاحية'])
                    <li
                        class="nav-item has-sub {{ Request::is('control/users/*') || Request::is('control/roles/*') ? 'open' : '' }}">
                        <a href="#"><i class="la la-user"></i><span class="menu-title">المستخدمين
                                والصلاحيات</span></a>
                        <ul class="menu-content" style="">
                            @can('عرض المستخدمين')
                                <li class="{{ Request::is('control/users') ? 'active' : '' }}">
                                    <a class="menu-item" href="/control/users"><i class="ft-layers"></i><span>جميع
                                            المستخدمين</span></a>
                                </li>
                            @endcan
                            @can('اضافة مستخدم')
                                <li class="{{ Request::is('control/users/create') ? 'active' : '' }}">
                                    <a class="menu-item" href="/control/users/create"><i
                                            class="ft-plus-circle"></i><span>اضافة مستخدم</span></a>
                                </li>
                            @endcan

                            @can('عرض الصلاحيات')
                                <li class="{{ Request::is('control/roles') ? 'active' : '' }}">
                                    <a class="menu-item" href="/control/roles"><i class="ft-layers"></i><span>جميع
                                            الصلاحيات</span></a>
                                </li>
                            @endcan

                            @can('اضافة صلاحية')
                                <li class="{{ Request::is('control/roles/create') ? 'active' : '' }}">
                                    <a class="menu-item" href="/control/roles/create"><i class="ft-plus-circle"></i><span>اضافة
                                            صلاحية</span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany



                @canany(['عرض الكورسات', 'قبول كورس', 'اضافة كورس'])
                    <li class="nav-item has-sub {{ Request::is('control/courses/*') ? 'open' : '' }}">
                        <a href="#"><i class="la la-newspaper-o"></i><span class="menu-title">الكورسات</span></a>
                        <ul class="menu-content" style="">
                            @can('عرض الكورسات')
                                <li class="{{ Request::is('control/courses') ? 'active' : '' }}">
                                    <a class="menu-item" href="/control/courses"><i class="ft-layers"></i><span>جميع
                                            الكورسات</span></a>
                                </li>
                            @endcan
                            @can('قبول كورس')
                                <li class="{{ Request::is('control/courses/pending-courses') ? 'active' : '' }}">
                                    <a class="menu-item" href="/control/courses/pending-courses"><i
                                            class="ft-check-circle"></i><span>كورسات قيد المراجعة</span></a>
                                </li>
                            @endcan
                            @can('اضافة كورس')
                                <li class="{{ Request::is('control/courses/create') ? 'active' : '' }}">
                                    <a class="menu-item" href="/control/courses/create"><i
                                            class="ft-plus-circle"></i><span>اضافة
                                            كورس</span></a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcanany


            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">حقوق الطبع والنشر &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script>
                <a class="text-bold-800 grey darken-2">منصة تعليم البرمجة اونلاين</a>
            </span><span class="float-md-right d-none d-lg-block">
                صنع من قبل<i class="ft-heart pink"></i>
                <a class="text-bold-800 grey darken-2" href="https://devabod.online/" target="_blank">المطور عبود</a>
                <span id="scroll-top"></span></span>
        </p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="/admin/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/admin/app-assets/vendors/js/extensions/zoom.min.js"></script>

    <!-- END Vendor JS-->


    <!-- BEGIN: Page Vendor JS-->
    @yield('page_vendor_js')

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/admin/app-assets/js/core/app-menu.min.js"></script>
    <script src="/admin/app-assets/js/core/app.min.js"></script>
    <script src="/admin/app-assets/js/scripts/customizer.min.js"></script>
    <script src="/admin/app-assets/js/scripts/footer.min.js"></script>
    <script src="/admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

    <!-- BEGIN: Notfication-->

    @if (session('icon') && session('msg'))
        @php
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header('Cache-Control: post-check=0, pre-check=0', false);
            header('Pragma: no-cache');
        @endphp
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "{{ session('icon') }}",
                title: "{{ session('msg') }}"
            });
        </script>
        {!! session()->forget(['icon', 'msg']) !!}
    @endif
    <!-- END: Notfication-->

    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @yield('page_js')
    <!-- END: Page JS-->

    @stack('other-scripts')

</body>
<!-- END: Body-->

</html>
