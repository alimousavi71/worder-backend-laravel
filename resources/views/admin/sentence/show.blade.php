@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.sentence.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.sentence.index') }}">{{ trans('panel.sentence.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.sentence.show') }}</li>
            </ol>
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
                                <td>{{ trans('fields.sentence.id') }}</td>
                                <td><a href="{{ route('admin.sentence.edit',$sentence->id) }}">{{ $sentence->id }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.sentence.title') }}</td>
                                <td>{{ $sentence->title }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.sentence.sentence') }}</td>
                                <td>{{ $sentence->sentence }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.sentence.translate') }}</td>
                                <td>{{ $sentence->translate }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.sentence.status') }}</td>
                                <td>{!! \App\Helper\Helper::renderSentenceStatus($sentence->status) !!}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.sentence.created_at') }}</td>
                                <td>{{$sentence->created_at->toJalali()->format('Y-m-d H:i')}}</td>
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
