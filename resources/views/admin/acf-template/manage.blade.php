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
                                <ul class="acf-ul-header">
                                    <li>مرتب سازی</li>
                                    <li>لیبل</li>
                                    <li>نام</li>
                                    <li>نوع</li>
                                    <li>عملیات</li>
                                </ul>
                            </div>
                            <div id="fields">
                                @if($acfTemplate->fields->isNotEmpty())
                                    @foreach($acfTemplate->fields as $field)
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
                                            @case('Image')
                                            @include('admin.acf-template.field.image',['type'=>'تصویر','field' =>$field,'index'=>$loop->index])
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
            updateSortInput();
        })

        const builder = $('#builder')
        const fields = $('#builder #fields')
        let fieldCount = parseInt('@if ($acfTemplate->fields->count()){{$acfTemplate->fields->count()}}@else{{'0'}}@endif');

        function init() {
            $('.acf-table-container').fadeOut('fast');
            fields.on('click', '.acf-btn-delete', function () {
                const dataOpen = $(this).data('open');
                const self = $(this);
                swal({
                    title: "حذف",
                    text: "آیا مطمئن هستید که میخواهید این مورد را حذف کنید؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ff0f3b",
                    confirmButtonText: "حذف",
                    cancelButtonText: "صرفه نظر",
                    closeOnConfirm: true
                }, function () {
                    if (dataOpen !== '') {
                        window.location.replace(dataOpen);
                    } else {
                        self.closest('.acf-field-item-container').remove();
                        fieldCount--;
                        updateFiledCounter();
                        updateSortInput();
                    }
                });
            });

            fields.on('click', '.f-title', function () {
                const target = $(this).closest('.acf-field-item-container').find('.acf-table-container');
                target.fadeToggle('fast');
            });

            fields.on('change', '.acf-inp-label', function () {
                const target = $(this)
                    .closest('.acf-field-item-container')
                    .find('.acf-ul-field .f-title span')
                    .eq(0);
                target.text($(this).val())
            });

            fields.on('change', '.acf-inp-name', function () {
                const target = $(this)
                    .closest('.acf-field-item-container')
                    .find('.acf-ul-field .f-name span');
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
                    .closest('.acf-field-item-container')
                    .find('.acf-ul-field .f-title span')
                    .eq(1);
                if ($(this).is(':checked')) {
                    target.text('*')
                } else {
                    target.text('')
                }
            });
        }

        function updateFiledCounter() {
            fields.children('.acf-field-item-container').each(function (index, item) {
                $(item).find('.f-counter').text(index + 1);
            })
        }

        function updateSortInput() {
            fields.children('.acf-field-item-container').each(function (index, item) {
                $(item).find('.acf-sort-position').val(index);
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
                updateSortInput();
                sortFieldInit();
            });
        }

        function sortFieldInit() {
            fields.sortable({
                axis: 'y',
                forcePlaceholderSize: true,
                update: function () {
                    updateFiledCounter();
                    updateSortInput();
                }
            });
        }
    </script>
@endsection
