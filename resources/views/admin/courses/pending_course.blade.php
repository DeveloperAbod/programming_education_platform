@extends('admin.layouts.layout')


@section('page_css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/pages/upload_images.css" />
    <!-- END: Page CSS-->
@endsection

@section('page_meta')
    <meta name="description" content=" منصة تعليم البرمجة اونلاين" />
    <meta name="keywords" content=" منصة تعليم البرمجة اونلاين" />

    <title>
        لوحة تحكم منصة تعليم البرمجة اونلاين | كورس قيد المراجعة
    </title>
@endsection



@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <h3 class="content-header-title">كورس قيد المراجعة</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/control">الصفحة الرئيسية</a></li>
                                @can('عرض الكورسات')
                                    <li class="breadcrumb-item active"><a href="/control/courses">الكورسات</a></li>
                                @endcan
                                <li class="breadcrumb-item active">قبول: {{ $course_info->title }}</li>

                            </ol>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content-body">
                <!-- Hidden label form layout section start -->
                <section id="hidden-label-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="hidden-label-basic-form">
                                        كورس قيد المراجعة
                                    </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse"><i class="ft-minus"></i></a>
                                            </li>
                                            <li>
                                                <a data-action="expand"><i class="ft-maximize"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <form novalidate class="form"
                                    action="/control/courses/{{ $course_info->id }}/update-pending-course" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-content collpase show">
                                        <div class="card-body">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                رقم الكورس
                                                            </h5>
                                                            <div class="controls">
                                                                <p>{{ $course_info->id }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                الاسم
                                                            </h5>
                                                            <div class="controls">
                                                                <p>{{ $course_info->name }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                الاختصار
                                                            </h5>
                                                            <div class="controls">
                                                                <p>{{ $course_info->shortcut }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                السعر
                                                            </h5>
                                                            <div class="controls">
                                                                <p>{{ $course_info->price }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">صورة
                                                                الكورس:</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <img data-action="zoom" class="img-fluid2"
                                                                    data-action="zoom"
                                                                    src="/uploads/{{ $course_info->image }}"
                                                                    alt="صورة الكورس الرئيسية">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required"></span>هل الكورس رائج
                                                            </h5>
                                                            <div class="controls">
                                                                <p>
                                                                    @if ($course_info->trending == 1)
                                                                        <p class="text-success">رائج</p>
                                                                    @else
                                                                        <p class="text-warning">عادي</p>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required"></span>حالة الكورس
                                                            </h5>
                                                            <div class="controls">
                                                                <p>
                                                                    @if ($course_info->status == 1)
                                                                        <p class="text-success">مفعل</p>
                                                                    @elseif ($course_info->status == -1)
                                                                        <p class="text-warning">قيد مراجعة التعديل</p>
                                                                    @elseif ($course_info->status == 0)
                                                                        <p class="text-warning">قيد المراجعة</p>
                                                                    @elseif ($course_info->status == 2)
                                                                        <p class="text- error">موقف</p>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                المستخدم
                                                            </h5>
                                                            <div class="controls">
                                                                <p> {{ $course_info->user->id }}-{{ $course_info->user->name }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h5>
                                                                الوصف
                                                            </h5>
                                                            <div class="controls">
                                                                <p>{{ $course_info->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" name="accept" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>قبول الخبر
                                                </button>

                                                <button type="submit" name="reject" class="btn btn-danger">
                                                    <i class="la la-check-square-o"></i>رفض الخبر
                                                </button>

                                            </div>
                                </form>

                            </div>
                        </div>
                    </div>
            </div>

        </div>

        </section>
        <!-- // Hidden label form layout section end -->
    </div>
    </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_vendor_js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="/admin/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="/admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="/admin/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="/admin/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"></script>
    <script src="/admin/app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
    <script src="/admin/app-assets/vendors/js/editors/ckeditor/ckeditor-super-build.js"></script>


    <!-- END: Page Vendor JS-->
@endsection


@section('page_js')
    <!-- BEGIN: Page JS-->
    <script src="/admin/app-assets/js/scripts/forms/validation/form-validation.js"></script>
    <script src="/admin/app-assets/js/scripts/editors/editor-ckeditor.min.js"></script>


    <!-- END: Page JS-->
@endsection
