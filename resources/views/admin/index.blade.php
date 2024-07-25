@extends('admin.layouts.layout')

@section('page_css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/fonts/simple-line-icons/style.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/pages/timeline.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/pages/dashboard-ecommerce.min.css" />
    <!-- END: Page CSS-->
@endsection

@section('page_meta')
    <meta name="description" content="منصة تعليم البرمجة اونلاين" />
    <meta name="keywords" content="منصة تعليم البرمجة اونلاين" />

    <title>
        لوحة تحكم منصة تعليم البرمجة اونلاين | الصفحة الرئيسية
    </title>
@endsection





@section('content')
    {{-- content --}}
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <!-- home -->
                <div class="row">
                    @can('عرض المستخدمين')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="/control/users">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h3 class="purple">{{ $users_unm }}</h3>
                                                    <h6>المستخدمين</h6>
                                                </div>
                                                <div>
                                                    <i class="la la-user purple font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-purple" role="progressbar"
                                                    style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('عرض الصلاحيات')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="/control/roles">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h3 class="pink">{{ $Roles_unm }}</h3>
                                                    <h6>الصلاحيات</h6>
                                                </div>
                                                <div>
                                                    <i class="ft-layers pink font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-pink" role="progressbar"
                                                    style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('عرض الكورسات')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <a href="/control/courses">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h3 class="info">{{ $courses_unm }}</h3>
                                                    <h6>الكورسات</h6>
                                                </div>
                                                <div>
                                                    <i class="la la-newspaper-o info font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                                    style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endcan

                </div>
                <!--/ home -->

            </div>
        </div>
    </div>

    {{-- end content --}}
@endsection


@section('page_vendor_js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="/admin/app-assets/vendors/js/charts/raphael-min.js"></script>
    <script src="/admin/app-assets/vendors/js/charts/morris.min.js"></script>
    <script src="/admin/app-assets/vendors/js/timeline/horizontal-timeline.js"></script>
    <!-- END: Page Vendor JS-->
@endsection

@section('page_js')
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
@endsection
