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
        لوحة تحكم منصة تعليم البرمجة اونلاين | تعديل المستخدم
    </title>
@endsection





@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">تعديل المستخدم</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/control">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active"><a href="/control/users">المستخدمين</a></li>
                                <li class="breadcrumb-item active">تعديل: {{ $user->name }}</li>
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
                                        تعديل بيانات المستخدم
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
                                        <form novalidate class="form" action="/control/users/{{ $user->id }}/update"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-body">
                                                <h4 class="form-section">
                                                    <i class="la la-user"></i> بيانات المستخدم
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>اسم المستخدم
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="text" name="name"
                                                                    value="{{ $user->name }}" class="form-control mb-1"
                                                                    placeholder="ادخل اسم المستخدم"
                                                                    data-validation-required-message="لا يمكن ان يكون اسم المستخدم فارغاً"
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
                                                                <span class="required">*</span>البريد الالكتروني
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="email" name="email"
                                                                    value="{{ $user->email }}" class="form-control mb-1"
                                                                    placeholder="ادخل البريد الالكتروني"
                                                                    data-validation-required-message="لا يمكن ان يكون البريد الالكتروني فارغاً"
                                                                    aria-invalid="false">
                                                                <div class="help-block">
                                                                </div>
                                                                @error('email')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('email') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required"></span>كلمة المرور الجديدة
                                                                <small class="text-muted">اتركها فارغة اذا كنت لا تريد تغيير
                                                                    كلمة المرور</small>
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="password" name="password"
                                                                    value="{{ old('password') }}" class="form-control mb-1"
                                                                    placeholder="ادخل كلمة المرور">
                                                                <div class="help-block">
                                                                </div>
                                                                @error('password')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('password') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required"></span>تاكيد كلمة المرور الجديدة

                                                                <small class="text-muted">اتركها فارغة اذا كنت لا تريد تغيير
                                                                    كلمة المرور</small>
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="password" name="confirm-password"
                                                                    value="{{ old('confirm-password') }}"
                                                                    class="form-control mb-1"
                                                                    placeholder="تاكيد كلمة المرور"
                                                                    data-validation-match-match="password"
                                                                    aria-invalid="false">
                                                                <div class="help-block">
                                                                </div>
                                                                @error('confirm-password')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('confirm-password') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>صورة المستخدم

                                                                <small class="text-muted">اتركها فارغة اذا كنت لا تريد
                                                                    تغيير
                                                                    الصورة</small>
                                                            </h5>

                                                            <div class="controls">
                                                                <input type="file" name="avatar"
                                                                    class="form-control mb-1"
                                                                    data-validation-images-regex="^.+\.(jpg|jpeg|png|gif|bmp|webp|tiff|tif|ico|svg|heif|heic|raw|cr2|nef|orf|sr2)$"
                                                                    data-validation-images-message="يجب رفع صورة فقط"
                                                                    aria-invalid="false">
                                                                <div class="help-block"></div>
                                                                @error('avatar')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('avatar') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>رقم هاتف المستخدم
                                                            </h5>
                                                            <div class="controls">
                                                                <input type="text" name="phone"
                                                                    value="{{ $user->phone }}" class="form-control mb-1"
                                                                    placeholder="ادخل رقم هاتف المستخدم"
                                                                    data-validation-containsnumber-regex="^7.*\d"
                                                                    minlength="9" maxlength="9"
                                                                    data-validation-containsnumber-message="رقم الهاتف يبدا ب 7 ويحتوي على ارقام فقط"
                                                                    data-validation-required-message="لا يمكن ان يكون رقم هاتف المستخدم فارغة"
                                                                    aria-invalid="false">
                                                                <div class="help-block">
                                                                </div>
                                                                @error('phone')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('phone') }}</div>
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
                                                                    src="/uploads/{{ $user->avatar }}"
                                                                    alt="صورة المستخدم">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h5>
                                                                <span class="required">*</span>الصلاحيات
                                                                <small class="text-muted">اضغط ctrl في لوحة المفاتيح واختر
                                                                    اكثر من صلاحية</small>
                                                            </h5>
                                                            <div class="controls">
                                                                <select style="height: 300px;" name="roles_name[]"
                                                                    class="form-control" multiple>
                                                                    @foreach ($roles as $key => $role)
                                                                        <option value="{{ $key }}"
                                                                            @if (in_array($key, $userRole)) selected @endif>
                                                                            {{ $role }}</option>
                                                                    @endforeach
                                                                </select>


                                                                <div class="help-block">
                                                                </div>
                                                                @error('roles_name')
                                                                    <div class="form-text text-danger">
                                                                        {{ $errors->first('roles_name') }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="d-inline-block custom-control custom-checkbox mr-1">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="status"
                                                                @if ($user->status == 1) checked @endif
                                                                id="checkbox2" />
                                                            <label class="custom-control-label" for="checkbox2">تفعيل
                                                                المستخدم</label>
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
