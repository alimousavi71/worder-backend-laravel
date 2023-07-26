@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[
       \App\Enums\Assets\StyleLoader::Toast(),
       \App\Enums\Assets\StyleLoader::Alert(),
   ]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">Exam</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.exam.index') }}">Exam</a></li>
                <li class="breadcrumb-item active">ویرایش</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-body pb-3">
                    @include('admin.partial.message')
                    <form class="request-form forms-sample" method="post" action="{{ $routeUpdate }}">
                        @csrf
                        @method('PATCH')

                        <x-admin.input identify="deleted_at" title="deleted_at" type="text" placeholder="Enter deleted_at" :old="$exam->deleted_at"/>
<x-admin.input identify="grade" title="grade" type="text" placeholder="Enter grade" :old="$exam->grade"/>
<x-admin.checkbox identify="is_my_words" description="is_my_words" :old="$exam->is_my_words"/>
<x-admin.checkbox identify="is_timer_on" description="is_timer_on" :old="$exam->is_timer_on"/>
<x-admin.checkbox identify="is_word_knew" description="is_word_knew" :old="$exam->is_word_knew"/>
<x-admin.input identify="title" title="title" type="text" placeholder="Enter title" :old="$exam->title"/>
<x-admin.checkbox identify="type" description="type" :old="$exam->type"/>
<x-admin.input identify="user_id" title="user_id" type="text" placeholder="Enter user_id" :old="$exam->user_id"/>


                        <x-admin.button-submit title="ویرایش"/>
                        <x-admin.button-delete/>

                    </form>

                    <form id="deleteItem" action="{{ $routeDestroy }}" method="post" class="form-inline">
                        @csrf
                        @method('DELETE')
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
    <script>
        $(document).ready(function () {

        })
    </script>
@endsection
