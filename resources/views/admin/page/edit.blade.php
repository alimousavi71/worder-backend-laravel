@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[
       \App\Enums\Assets\StyleLoader::Toast(),
       \App\Enums\Assets\StyleLoader::Alert(),
       \App\Enums\Assets\StyleLoader::Acf(),
   ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.page.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">{{ trans('panel.page.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.page.edit') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pb-3">
                    @include('admin.partial.message')
                    <form class="request-form forms-sample" method="post" action="{{ $routeUpdate }}">
                        @csrf
                        @method('PATCH')

                        <x-admin.input identify="id" title="id" type="hidden" :old="$page->id" />

                        <x-admin.input identify="title" :title="trans('fields.category.title')" type="text" :old="$page->title" />

                        <x-admin.textarea identify="description" :title="trans('fields.category.description')" :old="$page->description" />

                        <select name="templates[]" class="form-control mb-3" multiple>
                            @if($acfTemplates->isNotEmpty())
                                @foreach($acfTemplates as $acfTemplate)
                                    <option @if(in_array($acfTemplate->id,$oldsTemplate)) selected="selected" @endif value="{{ $acfTemplate->id }}">{{ $acfTemplate->title }}</option>
                                @endforeach
                            @endif
                        </select>

                        <div id="builder" class="my-5">
                            @if($page->acfTemplates->isNotEmpty())
                                @foreach($page->acfTemplates as $template)
                                    <div class="acf-template-container">
                                        <h4 class="acf-template-title">{{ $template->title }}</h4>
                                        <div class="acf-template-fields">
                                            @if($template->fields->isNotEmpty())
                                                @foreach($template->fields as $field)
                                                    @include('admin.acf-template.render.render',['field'=>$field])
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

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
    <script src="{{ asset('res-admin/assets/plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            init();
            sortFieldInit();
        })

        const builder = $('#builder')
        const fields = $('#builder #fields')

        function init() {
            builder.on('click', '.acf-template-title', function () {
                const target = $(this).closest('.acf-template-container').find('.acf-template-fields');
                target.fadeToggle('fast');
            });
        }

        function sortFieldInit() {
            builder.sortable({
                connectWith: "acf-template-container",
                axis: 'y',
                forcePlaceholderSize: true,
                update: function () {

                }
            });
        }
    </script>
@endsection
