@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[
       \App\Enums\Assets\StyleLoader::Toast(),
       \App\Enums\Assets\StyleLoader::Alert(),
   ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">مدیریت مدیران</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">مدیران</a></li>
                <li class="breadcrumb-item active">ویرایش</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-3">
                    @include('admin.partial.message')
                    <form class="request-form forms-sample" method="post" action="{{ $routeUpdate }}">
                        @csrf
                        @method('PATCH')

                        <img class="admin-avatar" src="{{ asset($admin->avatar) }}" alt="{{ $admin->first_name }} {{ $admin->last_name }}">

                        <x-admin.input identify="avatar" title="آواتار" type="file"/>

                        <x-admin.input identify="email" title="ایمیل" type="email" :old="$admin->email" readonly disabled/>

                        <x-admin.input identify="first_name" title="نام" type="text" :old="$admin->first_name"/>

                        <x-admin.input identify="last_name" title="نام خانوادگی" type="text" :old="$admin->last_name"/>

                        <x-admin.input identify="password" title="گذرواژه" type="password" value=""/>

                        <x-admin.select-model identify="role" title="نقش کاربری" :items="$roles" key="id" value="name" :old="$currentRole" />

                        <x-admin.checkbox identify="has_access" description="دسترسی داشته باشد" :old="$admin->has_access"/>

                        <x-admin.button-submit title="به روز رسانی"/>

                        <x-admin.button-delete/>

                    </form>

                    <form id="deleteItem" action="{{ $routeDestroy }}" method="post" class="form-inline">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.partial.request')
    @include('admin.partial.loader.script',['load'=>[
        \App\Enums\Assets\ScriptLoader::Alert(),
    ]])
    <script>
        $(document).ready(function () {
            $('#password').val('');
        })
    </script>
@endsection
