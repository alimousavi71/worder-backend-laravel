@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
     @include('admin.partial.loader.style',['load'=>[
        \App\Enums\Assets\StyleLoader::Toast(),
    ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.word.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.word.index') }}">{{ trans('panel.word.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.word.create') }}</li>
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

                        <x-admin.input identify="category_id" :title="trans('fields.word.category_id')" type="text" />
<x-admin.input identify="description" :title="trans('fields.word.description')" type="text" />
<x-admin.checkbox identify="status" :description="trans('fields.word.status')"  />
<x-admin.input identify="translate" :title="trans('fields.word.translate')" type="text" />
<x-admin.input identify="user_id" :title="trans('fields.word.user_id')" type="text" />
<x-admin.input identify="word" :title="trans('fields.word.word')" type="text" />


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
