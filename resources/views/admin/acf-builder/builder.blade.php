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
        <h1 class="page-title">{{ trans('panel.builder.index') }}</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pb-3">
                    <div class="row">
                        <div class="col-12 mb-3">
                            @include('admin.partial.message')
                        </div>
                        @if($allTemplates->isNotEmpty())
                            @foreach($allTemplates as $template)
                                <div class="col-12 col-md-4 col-lg-3">
                                    <div class="row-acf-template">
                                        <h4>{{ $template->title }}</h4>
                                        <div>
                                            @if(in_array($template->id,$selectTemplate))
                                                <a href="{{ route('admin.builder.template.remove',[$model,$modelInstance->id,$template->id]) }}" class="btn btn-danger btn-sm">{{ trans('panel.builder.template.remove') }}</a>
                                            @else
                                                <a href="{{ route('admin.builder.template.add',[$model,$modelInstance->id,$template->id]) }}" class="btn btn-success btn-sm">{{ trans('panel.builder.template.add') }}</a>
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
                    <form class="request-form forms-sample" method="post" action="{{ route('admin.builder.save',[$model,$modelInstance->id]) }}">
                        @csrf
                        @method('PATCH')

                        <x-admin.input identify="id" title="id" type="hidden" :old="$modelInstance->id" />

                        <div id="builder">
                            @if($connectTemplates->isNotEmpty())
                                @foreach($connectTemplates as $template)
                                    <div class="acf-template-container">
                                        <h4 class="acf-template-title">{{ $template->title }}</h4>
                                        <input class="acf-sort-position" type="hidden" name="template[{{ $loop->index }}][sort_position]" value="">
                                        <input type="hidden" name="template[{{ $loop->index }}][connected_id]" value="{{ $template->connected->id }}">
                                        <div class="acf-template-fields">
                                            @if($template->fields->isNotEmpty())
                                                @foreach($template->fields as $field)
                                                    @include('admin.acf-template.render.render',['index'=>$loop->index,'parentIndex'=>$loop->parent->index,'field'=>$field,'old'=>$modelInstance->acfStores->where('acf_field_id',$field->id)->first()])
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <x-admin.button-submit title="{{ trans('panel.update') }}" class="mt-4"/>

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
            updateSortInput();
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

        function updateSortInput() {
            builder.children('.acf-template-container').each(function (index, item) {
                $(item).find('.acf-sort-position').val(index);
            })
        }

        function sortFieldInit() {
            builder.sortable({
                connectWith: "acf-template-container",
                axis: 'y',
                forcePlaceholderSize: true,
                update: function () {
                    updateSortInput();
                }
            });
        }
    </script>
@endsection
