@extends('commonOnlyLogo')
@section('title')
<title>ログイン-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')

<div class="login-form">
    <div class="login-form__title">
        ログイン
    </div>
    <div class="login-form__content">
        @if (count($errors) > 0)
        <p>内容を確認してください</p>
        @endif
        <form class="form__wrapper" action="/login" method="POST">
            @csrf
            <div class="form">
                @error('email')
                <p>{{$errors->first('email')}}</p>
                @enderror
                <div class="form__item">
                    <label for="email">メールアドレス</label>
                    <input class="form__item--control" type="text" name="email" value="{{ old('email') }}" />
                </div>
                @error('password')
                <p>{{$errors->first('password')}}</p>
                @enderror
                <div class="form__item">
                    <label for="email">パスワード</label>
                    <input class="form__item--control" type="password" name="password" value="{{ old('password') }}" />
                </div>

                <div class="form__submit">
                    <button type="submit">ログインする</button>
                </div>

                <div class="form__switch">
                    会員登録はこちら
                </div>

            </div>

        </form>
    </div>
</div>

@endsection