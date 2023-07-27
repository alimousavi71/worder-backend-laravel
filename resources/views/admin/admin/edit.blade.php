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
        <h1 class="page-title">{{ trans('panel.admin.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">{{ trans('panel.admin.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.admin.edit') }}</li>
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

                        @if($admin->avatar)
                            <img class="admin-avatar" src="{{ asset($admin->avatar) }}" alt="{{ $admin->first_name }} {{ $admin->last_name }}">
                        @endif

                        <x-admin.input identify="avatar" :title="trans('fields.admin.avatar')" type="file" />

                        <x-admin.input readonly identify="email" :title="trans('fields.admin.email')" type="text" :old="$admin->email" />

                        <x-admin.input identify="first_name" :title="trans('fields.admin.first_name')" type="text" :old="$admin->first_name" />

                        <x-admin.input identify="last_name" :title="trans('fields.admin.last_name')" type="text" :old="$admin->last_name" />

                        <x-admin.input identify="password" :title="trans('fields.admin.password')" type="password" />

                        <x-admin.select-model identify="role" :title="trans('fields.admin.role')" :items="$roles" key="id" value="name" />

                        <x-admin.checkbox identify="has_access" :description="trans('fields.admin.has_access')" :old="$admin->has_access" />

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

        })
    </script>
@endsection
