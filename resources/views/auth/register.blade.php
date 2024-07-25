@extends('admin.layouts.auth_layout')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 my-1">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1"><img
                                                style="max-width: 400px; max-height: 170px; object-fit: contain;"
                                                src="/admin/app-assets/images/logo/logo_light.png" alt="branding logo">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-content">

                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                                        <span>انشاء حساب جديد</span>
                                    </p>
                                    <div class="card-body pt-0">
                                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <label for="name"><span class="required">*</span>اسم المستخدم</label>

                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @enderror

                                            <label for="email"><span class="required">*</span>البريد الإلكتروني</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @enderror

                                            <label for="phone"><span class="required">*</span>رقم الهاتف (رقم
                                                يمني)</label>
                                            <input id="phone" type="tel"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ old('phone') }}" required autocomplete="phone">

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @enderror




                                            <label for="password"><span class="required">*</span>كلمة المرور</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @enderror


                                            <label for="password-confirm"><span class="required">*</span>تأكيد كلمة
                                                المرور</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                            <br>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i
                                                    class="ft-unlock"></i>انشاء حساب جديد</button>


                                        </form>
                                        <div
                                            class="col-sm-12 col-12 float-sm-left float-left text-center text-sm-left  pt-2 pb-1">

                                            <a class="bcard-link" href="{{ route('login') }}">
                                                لديك حساب ؟ تسجيل الدخول
                                            </a>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
