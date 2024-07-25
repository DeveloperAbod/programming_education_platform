@extends('admin.layouts.layout')


@section('page_css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/colors/palette-gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/tables/datatable/datatables.min.css" />
    <!-- END: Page CSS-->
@endsection

@section('page_meta')
    <meta name="description" content=" منصة تعليم البرمجة اونلاين" />
    <meta name="keywords" content=" منصة تعليم البرمجة اونلاين" />

    <title>
        لوحة تحكم منصة تعليم البرمجة اونلاين | جميع الكورسات
    </title>
@endsection



@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الكورسات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/control">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active">جميع الكورسات</li>
                            </ol>
                        </div>
                    </div>
                </div>
                @can('اضافة كورس')
                    <div class="content-header-right col-md-6 col-12">
                        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                            <a href="/control/courses/create" class="btn btn-info round  box-shadow-2 px-2 mb-1"><i
                                    class="ft-plus-circle icon-left"></i> اضافة كورس جديد</a>
                        </div>
                    </div>
                @endcan

            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الكورسات</h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered dataex-visibility-selector">
                                                <thead>
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الاسم</th>
                                                        <th>الأختصار</th>
                                                        <th>السعر</th>
                                                        <th>الصورة</th>
                                                        <th>الحالة</th>
                                                        <th>المستخدم</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($courses as $item)
                                                        <tr>

                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->shortcut }}</td>
                                                            <td>{{ $item->price }}</td>

                                                            <td>
                                                                <a href="/uploads/{{ $item->image }}" target="_blank"><img
                                                                        src="/uploads/{{ $item->image }}" width="50px"
                                                                        alt="صورة الكورس"></a>
                                                            </td>
                                                            <td>
                                                                {{-- status if --}}
                                                                @if ($item->status == -1)
                                                                    <label class="badge badge-warning">قيد مراجعة
                                                                        التعديل</label>
                                                                @elseif($item->status == 0)
                                                                    <label class="badge badge-warning">قيد المراجعة</label>
                                                                @elseif ($item->status == 1)
                                                                    <label class="badge badge-success">مفعل</label>
                                                                @elseif($item->status == 2)
                                                                    <label class="badge badge-danger">موقف</label>
                                                                @endif
                                                            </td>
                                                            <td>{{ $item->user->id }}-{{ $item->user->name }} </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-info dropdown-toggle mr-1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        عرض اكثر
                                                                    </button>
                                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(14px, 41px, 0px);">
                                                                        <a class="dropdown-item"
                                                                            href="/control/courses/{{ $item->id }}/show">عرض</a>
                                                                        @can('تعديل كورس')
                                                                            <a class="dropdown-item"
                                                                                href="/control/courses/{{ $item->id }}/edit">تعديل</a>
                                                                        @endcan

                                                                        @if ($item->user_id == Auth::user()->id)
                                                                            @can('تعديل كورس خاص بي')
                                                                                <a class="dropdown-item"
                                                                                    href="/control/courses/{{ $item->id }}/editMind">تعديل
                                                                                    خاص بي</a>
                                                                            @endcan
                                                                        @endif

                                                                        @can('حذف كورس')
                                                                            <button class="dropdown-item delete_courses_btn"
                                                                                value="{{ $item->id }}">حذف</button>
                                                                        @endcan
                                                                        @can('ايقاف وتفعيل كورس')
                                                                            @if ($item->status == 1)
                                                                                <a href="/control/courses/{{ $item->id }}/deactivate"
                                                                                    class="dropdown-item "
                                                                                    value="{{ $item->id }}">ايقاف</a>
                                                                            @elseif($item->status == 2)
                                                                                <a href="/control/courses/{{ $item->id }}/active"
                                                                                    class="dropdown-item "
                                                                                    value="{{ $item->id }}">تفعيل</a>
                                                                            @endif
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الاسم</th>
                                                        <th>الأختصار</th>
                                                        <th>السعر</th>
                                                        <th>الصورة</th>
                                                        <th>الحالة</th>
                                                        <th>المستخدم</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_vendor_js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="/admin/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    {{-- start vendor print tables --}}
    <script src="/admin/app-assets/vendors/js/tables/buttons.colVis.min.js"></script>
    <script src="/admin/app-assets/vendors/js/tables/buttons.print.min.js"></script>
    {{-- end vendor print tables --}}


    <!-- END: Page Vendor JS-->
@endsection


@section('page_js')
    <!-- BEGIN: Page JS-->
    <script src="/admin/app-assets/js/scripts/tables/datatables/datatable-basic.min.js"></script>
    {{-- start print tables --}}
    <script src="/admin/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-print.min.js">
    </script>
    {{-- end print tables --}}
    <script>
        $(document).on('click', '.delete_courses_btn', function(e) {
            e.preventDefault();
            var id = $(this).val();
            Swal.fire({
                title: 'هل انت متأكد',
                text: "لن تستطيع استرجاع هذا السجل",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'لا',
                confirmButtonText: 'نعم'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Construct the URL with parameters
                    var url = "/control/courses/" + id + "/delete";
                    // Create a hidden form to submit the request
                    var form = $('<form>', {
                        'action': url,
                        'method': 'POST',
                        'style': 'display:none;'
                    }).append(
                        $('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '{{ csrf_token() }}'
                        }),
                        $('<input>', {
                            'type': 'hidden',
                            'name': '_method',
                            'value': 'DELETE'
                        })
                    );
                    // Append the form to the body and submit it
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    </script>





    <!-- END: Page JS-->
@endsection
