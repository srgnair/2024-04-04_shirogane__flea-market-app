@extends('commonWithSearchFunction')
@section('title')
<title>管理者ページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
<div class="add-new-admin__wrapper">
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="add-new-admin">
        <div class="add-new-admin__title">
            管理者の作成
        </div>
        <div class="add-new-admin__content">
            @error('admin')
            <p>{{$errors->first('admin')}}</p>
            @enderror
            @error('user_name')
            <p>{{$errors->first('user_name')}}</p>
            @enderror
            @error('email')
            <p>{{$errors->first('email')}}</p>
            @enderror
            @error('password')
            <p>{{$errors->first('password')}}</p>
            @enderror
            <form class="form__wrapper" action="{{ route('addNewAdmin') }}" method="POST">
                @csrf
                <div class="add-new-admin__content--form">

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

                    <div class="form__submit">
                        <button type="submit">登録</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

</div>
@endsection