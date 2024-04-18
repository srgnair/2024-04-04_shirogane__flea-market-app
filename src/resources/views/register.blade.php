@extends('commonOnlyLogo')
@section('title')
<title>会員登録-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')

<div class="register-form">
    <div class="register-form__title">
        会員登録
    </div>
    <div class="register-form__content">
        @if (count($errors) > 0)
        <p>内容を確認してください</p>
        @endif
        <form class="form__wrapper" action="/register" method="POST">
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
                    <button type="submit">登録する</button>
                </div>

                <div class="form__switch">
                    <a href="{{ route('loginView') }}">
                        ログインはこちら
                    </a>
                </div>

            </div>

        </form>
    </div>
</div>

@endsection