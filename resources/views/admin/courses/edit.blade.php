@extends('admin.layouts.layout')


@section('page_css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css" />
    <!-- END: Page CSS-->
@endsection

@section('page_meta')
    <meta name="description" content=" منصة تعليم البرمجة اونلاين" />
    <meta name="keywords" content=" منصة تعليم البرمجة اونلاين" />

    <title>
        لوحة تحكم منصة تعليم البرمجة اونلاين | تعديل الكورس
    </title>
@endsection





@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">تعديل الكورس</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/control">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active"><a href="/control/courses">الكورسات</a></li>
                                <li class="breadcrumb-item active">تعديل: {{ $course_info->name }}</li>
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
                                        تعديل بيانات الكورس
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
                                        <form novalidate class="form"
                                            action="/control/courses/{{ $course_info->id }}/update" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <h4 class="form-section">
                                                    <i class="la la-user"></i> بيانات الكورس
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>اسم الكورس
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="text" name="name"
                                                                    value="{{ $course_info->name }}"
                                                                    class="form-control mb-1" placeholder="ادخل اسم  الكورس"
                                                                    minlength="6"
                                                                    data-validation-required-message="لا يمكن ان يكون اسم الكورس فارغاً"
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



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>الاختصار
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="text" name="shortcut"
                                                                    value="{{ $course_info->shortcut }}"
                                                                    class="form-control mb-1" placeholder="ادخل الاختصار"
                                                                    data-validation-required-message="لا يمكن ان يكون الاختصار فارغاً"
                                                                    aria-invalid="false">
                                                                <div class="help-block">
                                                                </div>
                                                                @error('shortcut')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('shortcut') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>السعر
                                                            </h5>
                                                            <div class="controls">
                                                                <div class="input-group">
                                                                    <input type="text" name="price"
                                                                        value="{{ $course_info->price }}"
                                                                        class="form-control" placeholder="ادخل السعر"
                                                                        pattern="^\d+(\.\d{1,2})?$" required
                                                                        title="السعر يجب أن يحتوي على أرقام فقط، ويمكن أن يكون عددًا عشريًا مع حد أقصى رقمين بعد الفاصلة"
                                                                        aria-invalid="false">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">$</span>
                                                                    </div>
                                                                </div>
                                                                <div class="help-block">
                                                                    @error('price')
                                                                        <div class="form-text text-danger">
                                                                            {{ $errors->first('price') }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required"></span>صورة الكورس الاساسية
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="file" name="image"
                                                                    class="form-control mb-1"
                                                                    data-validation-images-regex="^.+\.(jpg|jpeg|png|gif|bmp|webp|tiff|tif|ico|svg|heif|heic|raw|cr2|nef|orf|sr2)$"
                                                                    data-validation-images-message="يجب رفع صورة فقط"
                                                                    aria-invalid="false">
                                                                <div class="help-block">يمكنك تركه فارغا اذا كنت لا تريد
                                                                    تغيير الصورة</div>
                                                                @error('image')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('image') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>الوصف
                                                            </h5>
                                                            <div class="controls">
                                                                <textarea name="description" id="textarea" class="form-control " required="" placeholder="الوصف"
                                                                    minlength="10" data-validation-required-message="لا يمكن ان  يكون الوصف فارغاً" aria-invalid="false">{{ $course_info->description }}</textarea>
                                                                @error('description')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">الصورة
                                                                الحالية:</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <img data-action="zoom" class="img-fluid2"
                                                                    data-action="zoom"
                                                                    src="/uploads/{{ $course_info->image }}"
                                                                    alt="صورة  الكورس الرئيسية">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="status" disabled id="status" />
                                                            <label class="custom-control-label" for="status">تفعيل
                                                                الكورس</label>
                                                            <small class="text-muted">سيتم تفعيل الكورس بعد
                                                                الموافقة
                                                                عليه</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="trending"
                                                                @if ($course_info->trending == 1) checked @endif
                                                                id="trending" />
                                                            <label class="custom-control-label" for="trending">جعل
                                                                الكورس
                                                                رائج</label>
                                                        </div>
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

    <!-- END: Page JS-->
@endsection
