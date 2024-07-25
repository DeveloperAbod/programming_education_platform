@extends('admin.layouts.layout')


@section('page_css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css" />
    <!--Internal  treeview -->
    <link href="/admin/app-assets/css-rtl/plugins/treeview/treeview-rtl.css" rel="stylesheet" type="text/css" />
    <!-- END: Page CSS-->
@endsection

@section('page_meta')
    <meta name="description" content=" منصة تعليم البرمجة اونلاين" />
    <meta name="keywords" content=" منصة تعليم البرمجة اونلاين" />

    <title>
        لوحة تحكم منصة تعليم البرمجة اونلاين | تعديل الصلاحية
    </title>
@endsection





@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">تعديل الصلاحية</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/control">الصفحة الرئيسية</a></li>
                                @can('عرض الصلاحيات')
                                    <li class="breadcrumb-item active"><a href="/control/roles">الصلاحيات</a></li>
                                @endcan
                                <li class="breadcrumb-item active">تعديل صلاحية: {{ $role->name }}</li>
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
                                        تعديل الصلاحية
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
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <form novalidate class="form" action="/control/roles/{{ $role->id }}/update"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-body">
                                                <h4 class="form-section">
                                                    <i class="la la-user"></i> بيانات الصلاحية
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>اسم الصلاحية
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="text" name="name"
                                                                    value="{{ $role->name }}" class="form-control mb-1"
                                                                    placeholder="ادخل اسم الصلاحية"
                                                                    data-validation-required-message="لا يمكن ان يكون اسم الصلاحية فارغاً"
                                                                    aria-invalid="false">
                                                                <div class="help-block">
                                                                </div>
                                                                @error('name')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('name') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-4">
                                                        @error('permission')
                                                            <div class="form-text text-danger">
                                                                {{ $errors->first('permission') }}</div>
                                                        @enderror
                                                        <ul id="treeview1">
                                                            <li>العمليات
                                                                <ul>
                                                            </li>
                                                            @foreach ($permission as $value)
                                                                <label>
                                                                    <input type="checkbox" name="permission[]"
                                                                        value="{{ $value->id }}" class="name"
                                                                        @if (in_array($value->id, $rolePermissions)) checked @endif>
                                                                    {{ $value->name }}
                                                                </label>
                                                                <br>
                                                            @endforeach
                                                            </li>

                                                        </ul>
                                                        </li>
                                                        </ul>
                                                    </div>


                                                </div>


                                            </div>

                                            <div class="form-actions">
                                                <button type="reset" class="btn btn-warning">
                                                    اعادة ضبط <i class="ft-refresh-cw position-right"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>حفظ البيانات
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


    <!-- END: Page Vendor JS-->
@endsection


@section('page_js')
    <!-- BEGIN: Page JS-->
    <script src="/admin/app-assets/js/scripts/forms/validation/form-validation.js"></script>
    <script src="/admin/app-assets/css-rtl/plugins/treeview/treeview.js"></script>


    <!-- END: Page JS-->
@endsection
