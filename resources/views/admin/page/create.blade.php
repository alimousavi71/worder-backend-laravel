@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
     @include('admin.partial.loader.style',['load'=>[
        \App\Enums\Assets\StyleLoader::Toast(),
    ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.page.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">{{ trans('panel.page.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.page.create') }}</li>
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

                        <x-admin.input identify="title" :title="trans('fields.category.title')" type="text" />

                        <x-admin.textarea identify="description" :title="trans('fields.category.description')" />

                        <select name="templates[]" class="form-control mb-3" multiple>
                            @if($acfTemplates->isNotEmpty())
                                @foreach($acfTemplates as $acfTemplate)
                                    <option value="{{ $acfTemplate->id }}">{{ $acfTemplate->title }}</option>
                                @endforeach
                            @endif
                        </select>

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
