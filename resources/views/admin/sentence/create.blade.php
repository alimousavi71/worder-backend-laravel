@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
     @include('admin.partial.loader.style',['load'=>[
        \App\Enums\Assets\StyleLoader::Toast(),
    ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.sentence.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.sentence.index') }}">{{ trans('panel.sentence.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.sentence.create') }}</li>
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

                        <x-admin.input identify="title" :title="trans('fields.sentence.title')" type="text" />

                        <x-admin.select-model identify="category_id" :title="trans('fields.sentence.category_id')" type="text" key="id" value="title" :items="$categories" />

                        <x-admin.textarea identify="sentence" :title="trans('fields.sentence.sentence')" type="text" />

                        <x-admin.textarea identify="translate" :title="trans('fields.sentence.translate')" type="text" />

                        <x-admin.select-enum identify="status" :title="trans('fields.sentence.status')" :enum-class="\App\Enums\Database\Sentence\SentenceStatus::class"  />

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
