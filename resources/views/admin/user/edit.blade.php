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
        <h1 class="page-title">User</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
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

                        <x-admin.input identify="avatar" title="avatar" type="text" placeholder="Enter avatar" :old="$user->avatar"/>
<x-admin.input identify="deleted_at" title="deleted_at" type="text" placeholder="Enter deleted_at" :old="$user->deleted_at"/>
<x-admin.input identify="email" title="email" type="text" placeholder="Enter email" :old="$user->email"/>
<x-admin.input identify="email_verified_at" title="email_verified_at" type="text" placeholder="Enter email_verified_at" :old="$user->email_verified_at"/>
<x-admin.input identify="firstname" title="firstname" type="text" placeholder="Enter firstname" :old="$user->firstname"/>
<x-admin.input identify="lastname" title="lastname" type="text" placeholder="Enter lastname" :old="$user->lastname"/>
<x-admin.input identify="password" title="password" type="text" placeholder="Enter password" :old="$user->password"/>
<x-admin.input identify="remember_token" title="remember_token" type="text" placeholder="Enter remember_token" :old="$user->remember_token"/>


                        <x-admin.button-submit title="ویرایش"/>
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

        })
    </script>
@endsection
