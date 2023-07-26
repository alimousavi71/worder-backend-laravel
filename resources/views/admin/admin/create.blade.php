@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[\App\Enums\Assets\StyleLoader::Toast()]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">مدیریت مدیران</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">مدیران</a></li>
                <li class="breadcrumb-item active">ایجاد</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-4">
                    @include('admin.partial.message')
                    <form class="request-form forms-sample" method="post" action="{{ $routeStore }}">
                        @csrf

                        <x-admin.input identify="avatar" title="آواتار" type="file"/>

                        <x-admin.input identify="email" title="ایمیل" type="email" placeholder="wordmempry@gmail.com"/>

                        <x-admin.input identify="first_name" title="نام" type="text"/>

                        <x-admin.input identify="last_name" title="نام خانوادگی" type="text"/>

                        <x-admin.input identify="password" title="گذرواژه" type="password" value=""/>

                        <x-admin.select-model identify="role" title="نقش کاربری" :items="$roles" key="id" value="name" />

                        <x-admin.checkbox identify="has_access" description="دسترسی داشته باشد"/>

                        <x-admin.button-submit/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.partial.request')
@endsection
