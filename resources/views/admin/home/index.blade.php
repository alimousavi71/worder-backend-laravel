@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.dashboard.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-2">
            @include('admin.partial.message')
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-order">
                        <h2 class="text-end">
                            <i class="fal fa-user icon-size float-start text-danger text-danger-shadow p-3"></i>
                            <span>{{ number_format($data['users_count']) }}</span>
                        </h2>
                        <div class="mb-0 pt-5">
                            <span>{{ trans('panel.dashboard.total_user') }}</span>
                            <span class="float-end">
                                <a class="btn btn-sm btn-light" href="{{ route('admin.user.index') }}">{{ trans('panel.dashboard.show_link') }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-widget">
                        <h2 class="text-end">
                            <i class="fal fa-language icon-size float-start text-warning text-warning-shadow p-3"></i>
                            <span>{{ number_format($data['words_count']) }}</span>
                        </h2>
                        <div class="mb-0 pt-5">
                            <span>{{ trans('panel.dashboard.total_word') }}</span>
                            <span class="float-end">
                                <a class="btn btn-sm btn-light" href="{{ route('admin.word.index') }}">{{ trans('panel.dashboard.show_link') }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-widget">
                        <h2 class="text-end">
                            <i class="icon-size fal fa-phone float-start text-primary text-primary-shadow p-3"></i>
                            <span>{{ number_format($data['contact_count']) }}</span>
                        </h2>
                        <div class="mb-0 pt-5">
                            <span>{{ trans('panel.dashboard.total_contact') }}</span>
                            <span class="float-end">
                                <a class="btn btn-sm btn-light" href="{{ route('admin.contact.index') }}">{{ trans('panel.dashboard.show_link') }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-widget">
                        <h2 class="text-end">
                            <i class="icon-size fal fa-language float-start text-success text-success-shadow p-3"></i>
                            <span>{{ number_format($data['words_pending_count']) }}</span>
                        </h2>
                        <div class="mb-0 pt-5">
                            <span>{{ trans('panel.dashboard.total_queue_word') }}</span>
                            <span class="float-end">
                                <a class="btn btn-sm btn-light" href="{{ route('admin.word.index',['status'=>\App\Enums\Database\Word\WordStatus::Pending]) }}">{{ trans('panel.dashboard.show_link') }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('panel.user.new_users') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap text-md-nowrap table-striped mb-0">
                            <thead>
                            <tr>
                                <th>{{ trans('fields.user.id') }}</th>
                                <th>{{ trans('fields.user.email') }}</th>
                                <th>{{ trans('fields.user.firstname') }}</th>
                                <th>{{ trans('fields.user.lastname') }}</th>
                                <th>{{ trans('fields.user.words_count') }}</th>
                                <th>{{ trans('fields.user.created_at') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data['users']->isNotEmpty())
                                @foreach($data['users'] as $user)
                                    <tr>
                                        <td><a href="{{ route('admin.user.show',$user->id) }}">{{ $user->id }}</a></td>
                                        <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ number_format($user->words_count) }}</td>
                                        <td>{{ $user->created_at->toJalali()->format('y F d H:i') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('panel.word.index') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap text-md-nowrap table-striped mb-0">
                            <thead>
                            <tr>
                                <th>{{ trans('fields.word.id') }}</th>
                                <th>{{ trans('fields.word.word') }}</th>
                                <th>{{ trans('fields.word.translate') }}</th>
                                <th>{{ trans('fields.word.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data['words']->isNotEmpty())
                                @foreach($data['words']->take(20) as $word)
                                    <tr>
                                        <td><a href="{{ route('admin.word.show',$word->id) }}">{{ $word->id }}</a></td>
                                        <td>{{ $word->word }}</td>
                                        <td>{{ $word->translate }}</td>
                                        <td>{!! \App\Helper\Helper::renderWordStatus($word->status) !!}</td>
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
