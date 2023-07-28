@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.user.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">{{ trans('panel.user.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.user.show') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($user->logins->count()) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.login_count') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fal fa-sign-in text-white fs-30 me-2 mt-2"></i> </div>
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
                            <h2 class="mb-0 number-font">{{ number_format($user->words->count()) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.word_count') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fal fa-language text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-warning img-card box-warning-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalRepeat) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.total_repeat') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fal fa-repeat text-white fs-30 me-2 mt-2"></i> </div>
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
                        <div class="ms-auto"> <i class="fal fa-close text-white fs-30 me-2 mt-2"></i> </div>
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
                        <div class="ms-auto"> <i class="fal fa-check-circle text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->

        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info img-card box-info-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ number_format($totalIKnow) }}</h2>
                            <p class="text-white mb-0">{{ trans('panel.word.analytics.total_i_know') }}</p>
                        </div>
                        <div class="ms-auto"> <i class="fal fa-brain text-white fs-30 me-2 mt-2"></i> </div>
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
                                <td>{{ trans('fields.admin.avatar') }}</td>
                                <td>
                                    @if($user->avatar)
                                        <img class="admin-avatar" src="{{ asset($user->avatar) }}" alt="{{ $user->first_name }} {{ $user->last_name }}">
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.user.id') }}</td>
                                <td><a href="{{ route('admin.user.edit',$user->id) }}">{{ $user->id }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.user.email') }}</td>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.user.firstname') }}</td>
                                <td>{{ $user->firstname }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.user.lastname') }}</td>
                                <td>{{ $user->lastname }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.user.words_count') }}</td>
                                <td>{{ number_format($user->words->count()) }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.user.created_at') }}</td>
                                <td>{{$user->created_at->toJalali()->format('Y-m-d H:i')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('fields.user.login_at') }}</th>
                                <th>{{ trans('fields.user.ip') }}</th>
                                <th>{{ trans('fields.user.agent') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($user->logins->isNotEmpty())
                                @foreach($user->logins->take(7) as $login)
                                    <tr>
                                        <td>{{ verta($login->login_at)->format('y/F/d') }}</td>
                                        <td>{{ $login->ip }}</td>
                                        <td>{{ $login->agent }}</td>
                                    </tr>
                                @endforeach
                            @endif
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
