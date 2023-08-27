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
                <li class="breadcrumb-item active">{{ trans('panel.page.builder') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pb-3">
                    <div class="row">
                        <div class="col-12 mb-3">
                            @include('admin.partial.message')
                        </div>
                        @if($acfTemplates->isNotEmpty())
                            @foreach($acfTemplates as $acfTemplate)
                                <div class="col-12 col-md-4 col-lg-3">
                                    <div class="row-acf-template">
                                        <h4>{{ $acfTemplate->title }}</h4>
                                        <div>
                                            @if(in_array($acfTemplate->id,$oldsTemplate))
                                                <a href="{{ route('admin.page.builder.template.remove',[$page->id,$acfTemplate->id]) }}" class="btn btn-danger btn-sm">{{ trans('panel.page.template.remove') }}</a>
                                            @else
                                                <a href="{{ route('admin.page.builder.template.add',[$page->id,$acfTemplate->id]) }}" class="btn btn-success btn-sm">{{ trans('panel.page.template.add') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="request-form forms-sample" method="post" action="{{ $routeUpdate }}">
                        @csrf
                        @method('PATCH')

                        <x-admin.input identify="id" title="id" type="hidden" :old="$page->id" />

                        <div id="builder">
                            @if($page->acfTemplates->isNotEmpty())
                                @foreach($page->acfTemplates as $template)
                                    <div class="acf-template-container">
                                        <h4 class="acf-template-title">{{ $template->title }}</h4>
                                        <div class="acf-template-fields">
                                            @if($template->fields->isNotEmpty())
                                                @foreach($template->fields as $field)
                                                    @include('admin.acf-template.render.render',['field'=>$field,'old'=>$page->acfStores->where('acf_field_id',$field->id)->first()])
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <x-admin.button-submit title="{{ trans('panel.update') }}" class="mt-4"/>

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
            $('.acf-template-fields').fadeOut('fast');
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
