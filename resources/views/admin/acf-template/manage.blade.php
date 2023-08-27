@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[
       \App\Enums\Assets\StyleLoader::Toast(),
       \App\Enums\Assets\StyleLoader::Alert(),
       \App\Enums\Assets\StyleLoader::Alert(),
   ]])
    <link rel="stylesheet" href="{{ asset('res-admin/assets/plugins/jquery-ui-1.13.2/jquery-ui.min.css') }}">
    <style>
        .ul-header {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
        }

        .ul-header li {
            width: 30%;
            padding: 10px;
            background-color: #1a1a3c;
            font-weight: bold;
            line-height: 20px;
            color: white;
            border: 1px solid #2b356e;
        }

        .ul-field {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
        }

        .ul-field li {
            width: 30%;
            padding: 10px;
            background-color: #1a1a3c;
            display: flex;
            align-items: center;
        }

        .ul-field li.f-order .f-counter {
            padding: 10px;
            height: 30px;
            width: 30px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            line-height: 15px;
            font-weight: bold;
            border: 1px solid rgba(255, 255, 255, 0.55);
        }

        .ul-field li.f-title {
            padding: 10px;
            line-height: 10px;
            font-weight: bold;
            color: #00baff;
            margin: 0;
            cursor: pointer;
        }

        .ul-field li.f-title .required {
            padding: 3px;
            line-height: 10px;
            font-weight: bold;
            font-size: 24px;
            color: #ff0000;
            margin: 0;
        }

        .field-item-container {
            border-bottom: 1px solid #2b356e;
            border-left: 1px solid #2b356e;
            border-right: 1px solid #2b356e;
        }

        .acf-table-field {
            width: 100%;
        }

        .acf-table-field td {
            padding: 20px;
        }

        .acf-table-field .acf-td-desc {
            width: 40%;
            background-color: rgba(57, 62, 67, 0.49);
            border-left: 1px solid #2b356e;
        }

        .acf-table-field .acf-td-desc h4 {
            font-weight: bold;
            font-size: 18px;
            margin: 0 0 5px 0;
            padding: 0;
        }

        .acf-table-field .acf-td-desc p {
            font-weight: normal;
            font-size: 16px;
            margin: 0 0 0 0;
            padding: 0;
        }

        .acf-table-field .acf-td-field input[type="text"],
        .acf-table-field .acf-td-field input[type="number"],
        .acf-table-field .acf-td-field textarea {
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            background-color: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.6);
            width: 100%;
            resize: none;
        }

        .acf-show {
            display: block;
        }

        .acf-hide {
            display: none;
        }
    </style>
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.acf-template.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                            href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a
                            href="{{ route('admin.acf-template.index') }}">{{ trans('panel.acf-template.title') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('panel.acf-template.edit') }}</li>
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

                        <img class="w-sm-100 w-50" src="{{ asset($acfTemplate->photo) }}"
                             alt="{{ $acfTemplate->title }}">

                        <x-admin.input identify="id" title="id" type="hidden" :old="$acfTemplate->id"/>

                        <x-admin.button-submit title="به روز رسانی"/>

                        <hr>

                        <div class="d-flex gap-3">
                            <select class="form-control" name="type" id="selectFieldType">
                                <option value="Text">متنی</option>
                                <option value="Textarea">متنی بزرگ</option>
                                <option value="Email">ایمیل</option>
                                <option value="Url">لینک</option>
                                <option value="Range">بازه عددی</option>
                                <option value="Select">انتخابی</option>
                                <option value="Image">تصویر</option>
                            </select>

                            <button class="btn btn-success" type="button" onclick="addField()">افرودن فیلد</button>
                        </div>

                        <div id="builder" class="mt-3">
                            <div>
                                <ul class="ul-header">
                                    <li>مرتب سازی</li>
                                    <li>لیبل</li>
                                    <li>نام</li>
                                    <li>نوع</li>
                                    <li>عملیات</li>
                                </ul>
                            </div>
                            <div id="fields">
                                @if($acfTemplate->acfFields->isNotEmpty())
                                    @foreach($acfTemplate->acfFields as $field)
                                        @switch($field->type)
                                            @case('Text')
                                                @include('admin.acf-template.field.text',['type'=>'متنی','field' =>$field,'index'=>$loop->index])
                                            @break
                                            @case('Textarea')
                                                @include('admin.acf-template.field.textarea',['type'=>'متنی بزرگ','field' =>$field,'index'=>$loop->index])
                                            @break
                                            @case('Email')
                                                @include('admin.acf-template.field.email',['type'=>'پست الکترونیکی','field' =>$field,'index'=>$loop->index])
                                            @break
                                            @case('Url')
                                                @include('admin.acf-template.field.url',['type'=>'لینک','field' =>$field,'index'=>$loop->index])
                                            @break
                                            @case('Range')
                                                @include('admin.acf-template.field.range',['type'=>'بازه عددی','field' =>$field,'index'=>$loop->index])
                                            @break
                                            @case('Select')
                                                @include('admin.acf-template.field.select',['type'=>'انتخابی','field' =>$field,'index'=>$loop->index])
                                            @break
                                        @endswitch
                                    @endforeach
                                @endif
                            </div>
                        </div>
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
        let fieldCount = parseInt('@if ($acfTemplate->acfFields->count()){{$acfTemplate->acfFields->count()}}@else{{'0'}}@endif');

        function init() {
            fields.on('click', '.acf-btn-delete', function () {
                const target = $(this).closest('.field-item-container').remove();
                fieldCount--;
                updateFiledCounter();
            });

            fields.on('click', '.f-title', function () {
                const target = $(this).closest('.field-item-container').find('.acf-table-container');
                if (target.hasClass('acf-show')) {
                    target.removeClass('acf-show');
                    target.addClass('acf-hide');
                } else {
                    target.removeClass('acf-hide');
                    target.addClass('acf-show');
                }
            });

            fields.on('change', '.acf-inp-label', function () {
                const target = $(this)
                    .closest('.field-item-container')
                    .find('.ul-field .f-title span')
                    .eq(0);
                target.text($(this).val())
            });

            fields.on('change', '.acf-inp-name', function () {
                const target = $(this)
                    .closest('.field-item-container')
                    .find('.ul-field .f-name span');
                target.text($(this).val())
            });

            fields.on('input', '.acf-inp-name', function () {
                const inputValue = $(this).val();
                let sanitizedValue = inputValue.replace(/[^a-zA-Z0-9_]/g, '');
                sanitizedValue = sanitizedValue.replace(/^[^a-zA-Z]+/, '');
                $(this).val(sanitizedValue);
            });

            fields.on('change', '.acf-inp-required', function () {
                const target = $(this)
                    .closest('.field-item-container')
                    .find('.ul-field .f-title span')
                    .eq(1);
                if ($(this).is(':checked')) {
                    target.text('*')
                } else {
                    target.text('')
                }
            });
        }

        function updateFiledCounter() {
            fields.children('.field-item-container').each(function (index, item) {
                $(item).find('.f-counter').text(index + 1);
            })
        }

        function addField() {
            let url = '';
            switch ($('#selectFieldType').val()) {
                case 'Text': {
                    url = '{{ route('admin.acf-template.render','Text') }}';
                    break;
                }
                case 'Textarea': {
                    url = '{{ route('admin.acf-template.render','Textarea') }}';
                    break;
                }
                case 'Email': {
                    url = '{{ route('admin.acf-template.render','Email') }}';
                    break;
                }
                case 'Url': {
                    url = '{{ route('admin.acf-template.render','Url') }}';
                    break;
                }
                case 'Range': {
                    url = '{{ route('admin.acf-template.render','Range') }}';
                    break;
                }
                case 'Select': {
                    url = '{{ route('admin.acf-template.render','Select') }}';
                    break;
                }
                case 'Image': {
                    url = '{{ route('admin.acf-template.render','Image') }}';
                    break;
                }
            }
            $.get({
                url: url,
                cache: false
            }).then(function (data) {
                let dataResource = data;
                dataResource = dataResource.replace(/__INDEX__/g, fieldCount);
                dataResource = dataResource.replace(/__INDEX__LABEL__/g, fieldCount + 1);
                fields.append(dataResource);
                fieldCount++;
                updateFiledCounter();
                sortFieldInit();
            });
        }

        function sortFieldInit() {
            fields.sortable({
                axis: 'y',
                forcePlaceholderSize: true,
                update: function () {
                    updateFiledCounter();
                }
            });
        }
    </script>
@endsection
