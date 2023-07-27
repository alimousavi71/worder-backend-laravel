@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.category.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">{{ trans('panel.category.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.category.show') }}</li>
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
                                <td>{{ trans('fields.category.id') }}</td>
                                <td><a href="{{ route('admin.category.edit',$category->id) }}">{{ $category->id }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.category.title') }}</td>
                                <td>{{ $category->title }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.category.icon') }}</td>
                                <td>{{ $category->icon }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.category.type') }}</td>
                                <td>{!! \App\Helper\Helper::renderCategoryType($category->type) !!}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.category.created_at') }}</td>
                                <td>{{$category->created_at->toJalali()->format('Y-m-d H:i')}}</td>
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
