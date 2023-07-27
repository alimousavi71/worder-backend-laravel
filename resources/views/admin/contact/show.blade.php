@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.contact.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.contact.index') }}">{{ trans('panel.contact.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.contact.show') }}</li>
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
                                <td width="25%">{{ trans('fields.contact.id') }}</td>
                                <td>{{ $contact->id }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.contact.email') }}</td>
                                <td><a href="mailto:{{ $contact->user->email }}">{{ $contact->user->email }}</a></td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.contact.is_seen') }}</td>
                                <td>@include('admin.partial.bool_badge',['value'=>$contact->is_seen])</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.contact.is_public') }}</td>
                                <td>@include('admin.partial.bool_badge',['value'=>$contact->is_public])</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.contact.is_collaboration') }}</td>
                                <td>@include('admin.partial.bool_badge',['value'=>$contact->is_collaboration])</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.contact.comment') }}</td>
                                <td>{{ $contact->comment }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.contact.agent') }}</td>
                                <td>{{ $contact->agent }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('fields.contact.created_at') }}</td>
                                <td>{{$contact->created_at->toJalali()->format('Y-m-d H:i')}}</td>
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
