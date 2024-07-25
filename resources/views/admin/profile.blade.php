@extends('admin.layouts.layout')


@section('page_css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css" />
    <!-- END: Page CSS-->
@endsection

@section('page_meta')
    <meta name="description" content="منصة تعليم البرمجة اونلاين" />
    <meta name="keywords" content=" منصة تعليم البرمجة اونلاين" />

    <title>
        لوحة تحكم منصة تعليم البرمجة اونلاين | الملف الشخصي
    </title>
@endsection


@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab"
                                            data-toggle="tab" href="#account" aria-controls="account" role="tab"
                                            aria-selected="true">
                                            <i class="ft-settings mr-25"></i><span class="d-none d-sm-block">الحساب</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="password-tab" data-toggle="tab"
                                            href="#password" aria-controls="password" role="tab" aria-selected="false">
                                            <i class="ft-lock mr-25"></i><span class="d-none d-sm-block">تغيير كلمة
                                                المرور</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab"
                                        role="tabpanel">
                                        <!-- users edit media object start -->
                                        <div class="media mb-2">
                                            <a class="mr-2" href="#">
                                                <img data-action="zoom" src="/uploads/{{ $user_info->avatar }}"
                                                    alt="users avatar" class="users-avatar-shadow rounded-circle"
                                                    height="64" width="64" />
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">الصورة الشخصية</h4>
                                            </div>
                                        </div>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form novalidate action="{{ Route('update_profile') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*الاسم</label>
                                                            <input type="text" name="name" class="form-control"
                                                                placeholder="الاسم" value="{{ $user_info->name }}" required
                                                                data-validation-required-message="يجب كتابة اسم المستخدم" />
                                                            @error('name')
                                                                <div class="form-text text-danger">
                                                                    {{ $errors->first('name') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-6 col-sm-6">

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*البريد الإلكتروني</label>
                                                            <input type="text" name="email" class="form-control"
                                                                placeholder="البريد الإلكتروني"
                                                                value="{{ $user_info->email }}" required
                                                                data-validation-required-message="يجب كتابة البريد الإلكتروني" />
                                                            @error('email')
                                                                <div class="form-text text-danger">
                                                                    {{ $errors->first('email') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*رقم الهاتف (رقم يمني)</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                placeholder="رقم الهاتف" value="{{ $user_info->phone }}"
                                                                required="" data-validation-containsnumber-regex="(\d)+"
                                                                minlength="9" maxlength="9"
                                                                data-validation-containsnumber-message="رقم الهاتف يحتوي على ارقام فقط"
                                                                aria-invalid="false">
                                                            @error('phone')
                                                                <div class="form-text text-danger">
                                                                    {{ $errors->first('phone') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>تغيير الصورة الشخصية</label>
                                                            <input type="file" name="avatar"
                                                                class="form-control mb-1" aria-invalid="false">
                                                            <div class="help-block">يمكنك تركه فارغا اذا كنت لا تريد
                                                                تغيير الصورة</div>
                                                            @error('avatar')
                                                                <div class="form-text text-danger">
                                                                    {{ $errors->first('avatar') }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit"
                                                        class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                        حفظ التغييرات
                                                    </button>
                                                    <button type="reset" class="btn btn-warning">
                                                        اعادة ضبط <i class="ft-refresh-cw position-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                    <div class="tab-pane" id="password" aria-labelledby="password-tab" role="tabpanel">
                                        <!-- users edit Info form start -->
                                        <form novalidate action="{{ Route('change_password') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <h5 class="mb-1">
                                                        <i class="ft-lock  mr-25"></i>تغيير كلمة المرور
                                                    </h5>

                                                    <div class="form-group validate">
                                                        <h5>
                                                            كلمة المرور القديمة
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="password" name="current_password"
                                                                class="form-control mb-1" required=""
                                                                data-validation-required-message="هذا الحقل مطلوب"
                                                                aria-invalid="false">
                                                            <div class="help-block"></div>
                                                            @error('current_password')
                                                                <div class="form-text text-danger">
                                                                    {{ $errors->first('current_password') }}</div>
                                                                <script>
                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        activatePasswordTab();
                                                                    });
                                                                </script>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="form-group validate">
                                                        <h5>
                                                            كلمة المرور الجديدة
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="password" name="new_password"
                                                                class="form-control mb-1" required=""
                                                                data-validation-required-message="هذا الحقل مطلوب"
                                                                aria-invalid="false">
                                                            <div class="help-block"></div>
                                                            @error('new_password')
                                                                <div class="form-text text-danger">
                                                                    {{ $errors->first('new_password') }}</div>
                                                                <script>
                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        activatePasswordTab();
                                                                    });
                                                                </script>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group validate">
                                                        <h5>
                                                            تأكيد كلمة المرور الجديدة
                                                            <span class="required">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="password" name="new_password_confirmation"
                                                                data-validation-match-match="new_password"
                                                                class="form-control mb-1" required=""
                                                                aria-invalid="false">
                                                            <div class="help-block"></div>
                                                            @error('new_password_confirmation')
                                                                <div class="form-text text-danger">
                                                                    {{ $errors->first('new_password_confirmation') }}</div>
                                                                <script>
                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        activatePasswordTab();
                                                                    });
                                                                </script>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit"
                                                        class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                        تغيير كلمة المرور
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit Info form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
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
    <script>
        // when there is any vadation for change password , the password tap will be shown
        function activatePasswordTab() {
            var passwordTab = document.getElementById('password-tab');
            var myTabContent = new bootstrap.Tab(passwordTab);
            myTabContent.show();
        }
    </script>
    <!-- END: Page JS-->
@endsection
