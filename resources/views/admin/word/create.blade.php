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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard') }}</a></li>
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

                        <x-admin.input identify="category_id" title="category_id" type="text" placeholder="Enter category_id" />
<x-admin.input identify="description" title="description" type="text" placeholder="Enter description" />
<x-admin.checkbox identify="status" description="status" />
<x-admin.input identify="translate" title="translate" type="text" placeholder="Enter translate" />
<x-admin.input identify="user_id" title="user_id" type="text" placeholder="Enter user_id" />
<x-admin.input identify="word" title="word" type="text" placeholder="Enter word" />


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
