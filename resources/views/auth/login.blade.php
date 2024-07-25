@extends('admin.layouts.auth_layout')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
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
                                        <span>تسجيل الدخول</span>
                                    </p>
                                    <div class="card-body pt-0">
                                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <label for="email">البريد الإلكتروني</label>

                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>البريد الالكتروني او كلمة المرور غير صحيحة</strong>
                                                </span>
                                            @enderror

                                            <label for="password">كلمة المرور</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                    <strong>البريد الالكتروني او كلمة المرور غير صحيحة</strong>
                                                </span>
                                            @enderror
                                            <br>



                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 text-center text-sm-left">
                                                    <fieldset>
                                                        <input class="form-check-input chk-remember" type="checkbox"
                                                            name="remember" id="remember"
                                                            {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">تذكرني</label>
                                                    </fieldset>




                                                </div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right">
                                                    @if (Route::has('password.request'))
                                                        <a class="bcard-link" href="{{ route('password.request') }}">
                                                            {{ __('نسيت كلمة المرور') }}
                                                        </a>
                                                    @endif

                                                </div>


                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i
                                                    class="ft-unlock"></i>تسجيل الدخول</button>
                                        </form>
                                        <div
                                            class="col-sm-12 col-12 float-sm-left float-left text-center text-sm-left  pt-2 pb-1">

                                            <a class="bcard-link" href="{{ route('register') }}">
                                                ليس لديك حساب ؟ انشاء حساب جديد
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
