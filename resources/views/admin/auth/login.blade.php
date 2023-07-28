@extends('admin.auth.master')
@section('title') {{ $title }} @endsection
@section('content')

    <form action="{{ route('admin.login') }}" method="post" class="forms-sample">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">پست الکترونیکی</label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="پست الکترونیکی را وارد کنید" name="email" value="{{ old('email') }}"  autofocus>
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

        <div class="form-group mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <i class="la la-code form-icon"></i>
                        <label for="captcha" class="form-label">کد امنیتی</label>
                        <input class="form-control @error('captcha') is-invalid @enderror" type="text"  name="captcha" id="captcha" placeholder="کد امنیتی را وارد کنید" value="{{ old('captcha') }}">

                        @error('captcha')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-center pt-3">
                        {!! captcha_img('auth-admin') !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember"  {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                <span>مرا به خاطر بسپار</span>
            </label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-success btn-md">ورود</button>
            <a href="{{ route('admin.password.request') }}">گذرواژه را فراموش کردم</a>
        </div>
    </form>
@endsection
