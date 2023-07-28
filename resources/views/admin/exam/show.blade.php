@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.exam.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.exam.index') }}">{{ trans('panel.exam.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.exam.show') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalUse) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.exam.analytics.total_word') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fal fa-eye text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalCorrect) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.exam.analytics.total_correct') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fal fa-check-circle text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card  bg-danger img-card box-danger-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalWrong) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.exam.analytics.total_wrong') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fal fa-close text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>{{ trans('fields.exam.id') }}</td>
                                <td><a href="{{ route('admin.exam.edit',$exam->id) }}">{{ $exam->id }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.exam.title') }}</td>
                                <td>{{ $exam->title }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.exam.grade') }}</td>
                                <td>{{ $exam->grade }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.exam.type') }}</td>
                                <td>{!! \App\Helper\Helper::renderExamType($exam->type) !!}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.exam.is_timer_on') }}</td>
                                <td>@include('admin.partial.bool_badge',['value'=>$exam->is_timer_on])</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.exam.is_word_knew') }}</td>
                                <td>@include('admin.partial.bool_badge',['value'=>$exam->is_word_knew])</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.exam.is_my_words') }}</td>
                                <td>@include('admin.partial.bool_badge',['value'=>$exam->is_my_words])</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.exam.created_at') }}</td>
                                <td>{{$exam->created_at->toJalali()->format('Y-m-d H:i')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
