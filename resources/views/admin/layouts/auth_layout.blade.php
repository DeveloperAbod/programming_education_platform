<!DOCTYPE html>


<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="تسجيل دخول لوحة تحكم منصة تعليم البرمجة اونلاين">
    <meta name="author" content="abod">
    <title> منصة تعليم البرمجة اونلاين | تسجيل الدخول</title>
    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/components.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/custom-rtl.min.css">
    <!-- sweet alert -->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/extensions/sweetalert2.min.css" />
    <!-- END: Theme CSS-->



    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/style-rtl.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="rtl vertical-layout vertical-menu 1-column bg-cyan bg-lighten-2 blank-page" data-open="click"
    data-menu="vertical-menu" data-col="1-column" style="background-color: #1d5bff80 !important;">
    <div id="app">

        <main>
            @yield('content')
        </main>
    </div>
    <!-- BEGIN: Vendor JS-->
    <script src="/admin/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/admin/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/admin/app-assets/js/core/app-menu.min.js"></script>
    <script src="/admin/app-assets/js/core/app.min.js"></script>
    <script src="/admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

    <!-- BEGIN: Notfication-->
    @if (session('icon') && session('msg'))
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
    @endif
    <!-- END: Notfication-->
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="/admin/app-assets/js/scripts/forms/form-login-register.min.js"></script>
    @yield('page_js')
    <!-- END: Page JS-->
</body>

</html>
