@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
     @include('admin.partial.loader.style',['load'=>[
        \App\Enums\Assets\StyleLoader::Toast(),
    ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">Exam</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.exam.index') }}">Exam</a></li>
                <li class="breadcrumb-item active">Exam - Create</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-4">
                    @include('admin.partial.message')
                    <form class="request-form forms-sample" method="post" action="{{ $routeStore }}">
                        @csrf

                        <x-admin.input identify="deleted_at" title="deleted_at" type="text" placeholder="Enter deleted_at" />
<x-admin.input identify="grade" title="grade" type="text" placeholder="Enter grade" />
<x-admin.checkbox identify="is_my_words" description="is_my_words" />
<x-admin.checkbox identify="is_timer_on" description="is_timer_on" />
<x-admin.checkbox identify="is_word_knew" description="is_word_knew" />
<x-admin.input identify="title" title="title" type="text" placeholder="Enter title" />
<x-admin.checkbox identify="type" description="type" />
<x-admin.input identify="user_id" title="user_id" type="text" placeholder="Enter user_id" />


                        <x-admin.button-submit/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.partial.request')
@endsection
