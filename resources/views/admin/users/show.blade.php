@extends('admin.layouts.layout')


@section('page_css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/pages/page-users.min.css" /> <!-- END: Page CSS-->
@endsection

@section('page_meta')
    <meta name="description" content=" منصة تعليم البرمجة اونلاين" />
    <meta name="keywords" content=" منصة تعليم البرمجة اونلاين" />

    <title>
        لوحة تحكم منصة تعليم البرمجة اونلاين | عرض المستخدم
    </title>
@endsection





@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <!-- users view start -->
                <section class="users-view">
                    <!-- users view media object start -->
                    <div class="row">
                        <div class="col-12 col-sm-7">
                            <div class="media mb-2">
                                <a class="mr-1" href="#">
                                    <img src="/uploads/{{ $user->avatar }}" alt="users view avatar"
                                        class="users-avatar-shadow rounded-circle" height="64" width="64" />
                                </a>
                                <div class="media-body pt-25">
                                    <h4 class="media-heading">

                                        <span class="users-view-name">{{ $user->name }} </span>
                                        <br>
                                        <span class="text-muted font-medium-1"> {{ $user->email }}</span>
                                    </h4>
                                    <span>رقم المستخدم:</span>
                                    <span class="users-view-id">{{ $user->id }}</span>
                                </div>
                            </div>
                        </div>
                        @can('تعديل مستخدم')
                            <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                                <a href="/control/users/{{ $user->id }}/edit" class="btn btn-sm btn-primary">تعديل
                                    المستخدم</a>
                            </div>
                        @endcan

                    </div>
                    <!-- users view media object ends -->
                    <!-- users view card data start -->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>تاريخ انشاء المستخدم:</td>
                                                    <td>{{ $user->created_at }}</td>
                                                </tr>
                                                <tr>
                                                    <td>اسم المستخدم:</td>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>البريد الالكتروني:</td>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>الصلاحيات:</td>
                                                    <td class="users-view-role">
                                                        @if (!empty($user->getRoleNames()))
                                                            @foreach ($user->getRoleNames() as $v)
                                                                <label
                                                                    class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>حالة المستخدم:</td>
                                                    <td>
                                                        {{-- status if --}}
                                                        @if ($user->status == 1)
                                                            <span class="badge badge-success users-view-status">مفعل</span>
                                                        @else
                                                            <span class="badge badge-danger users-view-status">موقف</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>رقم هاتف المستخدم:</td>
                                                    <td>
                                                        {{ $user->phone }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view card data ends -->

                </section>
                <!-- users view ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_vendor_js')
    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->
@endsection


@section('page_js')
    <!-- BEGIN: Page JS-->
    <script src="/admin/app-assets/js/scripts/pages/page-users.min.js"></script>

    <!-- END: Page JS-->
@endsection
