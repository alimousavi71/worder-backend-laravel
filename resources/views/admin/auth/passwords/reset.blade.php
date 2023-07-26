@extends('admin.auth.master')
@section('title') {{ $title }} @endsection
@section('content')
    <h3 class="text-center">بازنشانی گذرواژه</h3>
    <form action="{{ route('admin.password.request') }}" method="post" class="forms-sample">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">پست الکترونیکی</label>
            <input id="email" readonly="readonly" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">گذرواژه</label>
            <input id="password" type="password" class="form-control text-right @error('password') is-invalid @enderror" placeholder="گذرواژه را وارد کنید" name="password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">تایید گذرواژه</label>
            <input id="password_confirmation" type="password" class="form-control text-right @error('password') is-invalid @enderror" placeholder="تایید گذرواژه را وارد کنید" name="password_confirmation">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-primary me-2 mb-2 mb-md-0 text-white">بازنشانی گذرواژه</button>
        </div>

    </form>
@endsection
