@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
     @include('admin.partial.loader.style',['load'=>[
        \App\Enums\Assets\StyleLoader::Toast(),
    ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.acf.template.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.acf.template.index') }}">{{ trans('panel.acf.template.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.acf.template.create') }}</li>
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
                        <x-admin.input identify="photo" :title="trans('fields.acf.template.photo')" type="file" />

                        <x-admin.input identify="title" :title="trans('fields.acf.template.title')" type="text" />

                        <x-admin.select-model identify="template" key="key" value="value" :title="trans('fields.acf.template.template')" :items="$availableTemplates" />

                        <x-admin.textarea identify="description" :title="trans('fields.acf.template.description')" />

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
