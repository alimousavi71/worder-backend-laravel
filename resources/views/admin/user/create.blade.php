@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
     @include('admin.partial.loader.style',['load'=>[
        \App\Enums\Assets\StyleLoader::Toast(),
    ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">User</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
                <li class="breadcrumb-item active">User - Create</li>
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

                        <x-admin.input identify="avatar" title="avatar" type="text" placeholder="Enter avatar" />
<x-admin.input identify="deleted_at" title="deleted_at" type="text" placeholder="Enter deleted_at" />
<x-admin.input identify="email" title="email" type="text" placeholder="Enter email" />
<x-admin.input identify="email_verified_at" title="email_verified_at" type="text" placeholder="Enter email_verified_at" />
<x-admin.input identify="firstname" title="firstname" type="text" placeholder="Enter firstname" />
<x-admin.input identify="lastname" title="lastname" type="text" placeholder="Enter lastname" />
<x-admin.input identify="password" title="password" type="text" placeholder="Enter password" />
<x-admin.input identify="remember_token" title="remember_token" type="text" placeholder="Enter remember_token" />


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
