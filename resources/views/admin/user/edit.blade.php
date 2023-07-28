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
        <h1 class="page-title">{{ trans('panel.user.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">{{ trans('panel.user.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.user.edit') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-3">
                    @include('admin.partial.message')
                    <form class="request-form forms-sample" enctype="multipart/form-data" method="post" action="{{ $routeUpdate }}">
                        @csrf
                        @method('PATCH')

                        @if($user->avatar)
                            <img class="admin-avatar" src="{{ asset($user->avatar) }}" alt="{{ $user->first_name }} {{ $user->last_name }}">
                        @endif

                        <x-admin.input identify="avatar" :title="trans('fields.user.avatar')" type="file" />

                        <x-admin.input identify="email" :title="trans('fields.user.email')" type="text" readonly disabled :old="$user->email" />

                        <x-admin.input identify="firstname" :title="trans('fields.user.firstname')" type="text" :old="$user->firstname"/>

                        <x-admin.input identify="lastname" :title="trans('fields.user.lastname')" type="text" :old="$user->lastname"/>

                        <x-admin.input identify="password" :title="trans('fields.user.password')" type="text" />

                        <x-admin.button-submit title="{{ trans('panel.update') }}"/>

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
