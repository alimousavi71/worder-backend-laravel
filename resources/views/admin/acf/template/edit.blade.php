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
        <h1 class="page-title">{{ trans('panel.acf.template.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.acf.template.index') }}">{{ trans('panel.acf.template.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.acf.template.edit') }}</li>
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

                        <x-admin.input identify="id" title="id" type="hidden" :old="$template->id" />

                        <img src="{{ asset($template->photo) }}" alt="{{ $template->title }}">

                        <x-admin.input identify="photo" :title="trans('fields.acf.template.photo')" type="file" />

                        <x-admin.input identify="title" :title="trans('fields.acf.template.title')" type="text" :old="$template->title"/>

                        <x-admin.select-model identify="template" key="key" value="value" :title="trans('fields.acf.template.template')" :items="$availableTemplates" :old="$template->template" />

                        <x-admin.textarea identify="description" :title="trans('fields.acf.template.description')" :old="$template->description"/>

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
@endsection
