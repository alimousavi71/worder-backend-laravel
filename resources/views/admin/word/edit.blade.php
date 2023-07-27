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
        <h1 class="page-title">{{ trans('panel.word.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.word.index') }}">{{ trans('panel.word.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.word.edit') }}</li>
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

                        <x-admin.input identify="id" :title="trans('fields.word.id')" type="hidden" :old="$word->id" />

                        <x-admin.select-model identify="category_id" :title="trans('fields.word.category_id')" type="text" key="id" value="title" :items="$categories" :old="$word->category_id" />

                        <x-admin.input identify="word" :title="trans('fields.word.word')" type="text" :old="$word->word" />

                        <x-admin.input identify="translate" :title="trans('fields.word.translate')" type="text" :old="$word->translate" />

                        <x-admin.input identify="description" :title="trans('fields.word.description')" type="text" :old="$word->description" />

                        <x-admin.select-enum identify="status" :title="trans('fields.word.status')" :enum-class="\App\Enums\Database\Word\WordStatus::class" :old="$word->status" />

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
