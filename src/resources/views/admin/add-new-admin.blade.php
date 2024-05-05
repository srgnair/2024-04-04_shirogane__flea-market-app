@extends('commonWithSearchFunction')
@section('title')
<title>管理者ページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
<div class="adminContents">

    <div class="adminContents">
        <div class="adminContents__title">
            管理者の作成
        </div>
        <div class="adminContents__content">

            <form class="form__wrapper" action="{{ route('addNewAdmin') }}" method="POST">
                @csrf
                <div class="form">

                    <div class="form__item">
                        <input class="form__item--control" type="text" name="user_name" value="{{ old('user_name') }}" placeholder="お名前" />
                    </div>

                    <div class="form__item">
                        <input class="form__item--control" type="hidden" name="role" value="admin" />
                    </div>

                    <div class="form__item">
                        <input class="form__item--control" type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス" />
                    </div>

                    <div class="form__item">
                        <input class="form__item--control" type="password" name="password" value="{{ old('password') }}" placeholder="パスワード" />
                    </div>

                    <!-- <input type="hidden" name="email_verified_at" value="{{ now() }}"> -->

                    <!-- @if(session('message'))
                    <div class="form__submit">
                        {{ session('message') }}
                    </div>
                    @else -->
                    <div class="form__submit">
                        <button type="submit">登録</button>
                    </div>
                    <!-- @endif -->

                </div>

            </form>
        </div>
    </div>

</div>
@endsection