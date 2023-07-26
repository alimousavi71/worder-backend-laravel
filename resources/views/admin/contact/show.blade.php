@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')

@endsection
@section('content')
    <div class="page-header">
        <h1 class="page-title">نمایش تماس</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">تماس ها</a></li>
                <li class="breadcrumb-item active">نمایش تماس</li>
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
                                <td width="25%">شناسه</td>
                                <td>{{ $contact->id }}</td>
                            </tr>

                            <tr>
                                <td>ایمیل</td>
                                <td>{{ $contact->email }}</td>
                            </tr>

                            <tr>
                                <td>فیگما</td>
                                <td><a href="{{ $contact->figma_link }}">{{ $contact->figma_link }}</a></td>
                            </tr>

                            <tr>
                                <td>دریبل</td>
                                <td><a href="{{ $contact->dribble_link }}">{{ $contact->dribble_link }}</a></td>
                            </tr>

                            <tr>
                                <td>Agent</td>
                                <td>{{ $contact->agent }}</td>
                            </tr>

                            <tr>
                                <td>تاریخ ایجاد</td>
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
