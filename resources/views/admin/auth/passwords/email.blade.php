@extends('admin.auth.master')
@section('title') {{ $title }} @endsection
@section('content')
    <h3 class="text-center">فراموشی رمز عبور</h3>
    <form action="{{ route('admin.password.email') }}" method="post" class="forms-sample">
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

        <div class="mb-3">
            <button class="btn btn-primary me-2 mb-2 mb-md-0 text-white">ارسال لینک بازنشانی گذرواژه</button>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </form>
@endsection
