@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')
    <div class="page-header">
        <h1 class="page-title">مدیریت مدیران</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">مدیران</a></li>
                <li class="breadcrumb-item active">نمایش</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اطلاعات مدیر</h3>
                </div>
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>تصویر</td>
                                <td>
                                    <img class="admin-avatar" src="{{ asset($admin->avatar) }}" alt="{{ $admin->first_name }} {{ $admin->last_name }}">
                                </td>
                            </tr>
                            <tr>
                                <td>شناسه</td>
                                <td><a href="{{ route('admin.admin.edit',$admin->id) }}">{{ $admin->id }}</a></td>
                            </tr>
                            <tr>
                                <td>پست الکترونیکی</td>
                                <td><a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a></td>
                            </tr>
                            <tr>
                                <td>نام</td>
                                <td>{{ $admin->first_name }}</td>
                            </tr>
                            <tr>
                                <td>نام خانوادگی</td>
                                <td>{{ $admin->last_name }}</td>
                            </tr>
                            <tr>
                                <td>نقش کاربری</td>
                                <td>{{ $admin->roles()->get()->implode('name',',') }}</td>
                            </tr>
                            <tr>
                                <td>تاریخ ایجاد</td>
                                <td>{{$admin->created_at->toJalali()->format('Y-m-d H:i')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ورود ها</h3>
                </div>
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>آی پی</th>
                                <th>تاریخ ورود</th>
                                <th>عامل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($admin->logins->isNotEmpty())
                                @foreach ($admin->logins as $item)
                                    <tr>
                                        <td>{{ $item->ip }}</td>
                                        <td>{{ $item->login_at->toJalali()->format('h:i Y-m-d') }}</td>
                                        <td>{{ $item->agent }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
