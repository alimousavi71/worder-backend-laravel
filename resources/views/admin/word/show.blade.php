@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.word.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.word.index') }}">{{ trans('panel.word.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.word.show') }}</li>
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
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.total_user') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-secondary img-card box-secondary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalRepeat) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.total_repeat') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-repeat text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card  bg-danger img-card box-danger-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalWrong) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.total_wrong') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-close text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalCorrect) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.total_correct') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-check-circle text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->

        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalIKnow) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.total_i_know') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-hand-o-up text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td width="25%">{{ trans('fields.word.id') }}</td>
                                <td><a href="{{ route('admin.word.edit',$word->id) }}">{{ $word->id }}</a></td>
                            </tr>

                            @if($word->user)
                                <tr>
                                    <td>{{ trans('fields.word.user_id') }}</td>
                                    <td><a href="{{ route('admin.user.show',$word->user_id) }}">{{ $word->user->email }}</a></td>
                                </tr>
                            @endif

                            <tr>
                                <td>{{ trans('fields.word.word') }}</td>
                                <td>{{ $word->word }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.word.translate') }}</td>
                                <td>{{ $word->translate }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.word.description') }}</td>
                                <td>{{ $word->description }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.word.status') }}</td>
                                <td>{!! \App\Helper\Helper::renderWordStatus($word->status) !!}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.word.created_at') }}</td>
                                <td>{{$word->created_at->toJalali()->format('Y-m-d H:i')}}</td>
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
