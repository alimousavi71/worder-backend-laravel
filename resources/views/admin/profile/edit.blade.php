@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[
       \App\Enums\Assets\StyleLoader::Toast(),
   ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">ویرایش پروفایل</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item active">ویرایش پروفایل</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> کاربر گرامی در این قسمت میتوانید پروفایل خود را ویرایش کنید.</h3>
                </div>
                <div class="card-body pb-3">
                    <form class="request-form forms-sample" method="post" action="{{ $routeUpdate }}">
                        @csrf
                        @method('PATCH')

                        <img class="admin-avatar" src="{{ asset($admin->avatar) }}" alt="{{ $admin->first_name }} {{ $admin->last_name }}">

                        <x-admin.input identify="avatar" title="تصویر" type="file" />

                        <x-admin.input identify="email" title="پست الکترونیکی" type="text" :old="$admin->email" readonly="readonly" disabled />

                        <x-admin.input identify="first_name" title="نام" type="text" :old="$admin->first_name" />

                        <x-admin.input identify="last_name" title="نام خانوادگی" type="text" :old="$admin->last_name" />

                        <x-admin.button-submit title="ویرایش"/>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @include('admin.partial.request')
@endsection
