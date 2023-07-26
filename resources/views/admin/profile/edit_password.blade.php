@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[
       \App\Enums\Assets\StyleLoader::Toast(),
   ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">تغییر گذرواژه</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">پروفایل</a></li>
                <li class="breadcrumb-item active">تغییر گذرواژه</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> کاربر گرامی در این قسمت میتوانید گذرواژه خود را ویرایش کنید.</h3>
                </div>
                <div class="card-body pb-2">
                    <form class="request-form forms-sample" method="post" action="{{ $routeUpdate }}">
                        @csrf
                        @method('PATCH')


                        <div class="mb-3">
                            <label for="current_password" class="form-label">گذرواژه فعلی</label>
                            <input type="password" class="form-control" name="current_password" id="current_password" value="">
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">گذرواژه جدید</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" value="">
                        </div>

                        <div class="mb-3">
                            <label for="new_password_rep" class="form-label">تکرار گذرواژه</label>
                            <input type="password" class="form-control" name="new_password_rep" id="new_password_rep" value="">
                        </div>

                        <button type="submit" class="btn btn-primary me-2 has-spinner">به روز رسانی</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.partial.request')
    <script>
        $(document).ready(function () {
            $('#password').val('');
            $('#password_confirmation').val('');
            $('#new_password').val('');
        })
    </script>
@endsection
