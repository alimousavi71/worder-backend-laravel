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
        <h1 class="page-title">{{ trans('panel.category.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">{{ trans('panel.category.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.category.edit') }}</li>
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

                        <x-admin.input identify="id" title="id" type="hidden" :old="$category->id" />

                        <x-admin.select-enum identify="type" :title="trans('fields.category.type')" :enum-class="\App\Enums\Database\Category\CategoryType::class" :old="$category->type" />

                        <x-admin.input identify="title" :title="trans('fields.category.title')" type="text" :old="$category->title" />

                        <x-admin.input identify="description" :title="trans('fields.category.description')" type="text" :old="$category->description" />

                        <x-admin.input identify="icon" :title="trans('fields.category.icon')" type="text" :old="$category->icon" />

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
