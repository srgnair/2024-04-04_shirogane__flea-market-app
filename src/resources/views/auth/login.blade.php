@extends('commonOnlyLogo')
@section('title')
<title>ログイン-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')

<div class="login-form">
    @if(session('message'))
    <div class="message">
        {{ session('message') }}
    </div>
    @endif
    <div class="login-form__title">
        ログイン
    </div>
    <div class="login-form__content">
        @error('email')
        <p>{{$errors->first('email')}}</p>
        @enderror
        @error('password')
        <p>{{$errors->first('password')}}</p>
        @enderror
        <form class="form__wrapper" action="{{ route('loginStore') }}" method="POST">
            @csrf
            <div class="form">
                <div class="form__item">
                    <label for="email">メールアドレス</label>
                    <input class="form__item--control" type="text" name="email" value="{{ old('email') }}" />
                </div>
                <div class="form__item">
                    <label for="email">パスワード</label>
                    <input class="form__item--control" type="password" name="password" value="{{ old('password') }}" />
                </div>

                <div class="form__submit">
                    <button type="submit">ログインする</button>
                </div>

                <div class="form__before-google">
                    または
                </div>

                <div class="form__google">
                    <a href="{{ route('login.google') }}">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                    </a>
                </div>

                <!-- <div class="form__line">
                    <a href="{{ route('login.line') }}">
                        <img src="{{ asset('img/btn_login_base.png') }}">
                    </a>
                </div> -->

                <div class="form__switch">
                    <a href="{{ route('registerView') }}">
                        会員登録はこちら
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection