@extends('commonWithSearchFunction')
@section('title')
<title>プロフィール設定-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/profileChange.css') }}">
@endsection
@section('content')
<div class="profile-change">
    <div class="profile-change__title">
        プロフィール設定
    </div>
    <div class="profile-change__form">
        <div class="profile-change__form--img">
            <div class="form__img--img">
                @if (Auth::check() && Auth::user()->img !== null)
                <img src="{{ asset($userProfile->img) }}" alt="イメージ画像">
                @else
                <img src="{{ asset('img/sampleUserImage.png') }}" alt="イメージ画像">
                @endif
            </div>
            <div class="form__img--select-button">
                <button>画像を選択する</button>
            </div>
        </div>
        <div class="form__item">
            <label for="user-name">ユーザー名</label>
            <input type="text" name="user-name" value="{{ $userProfile->user_name }}" />
        </div>
        <div class="form__item">
            <label for="post-code">郵便番号</label>
            <input type="text" name="post-code" value="{{ $userProfile->post_code }}" />
        </div>
        <div class="form__item">
            <label for="address">住所</label>
            <input type="text" name="address" value="{{ $userProfile->address }}" />
        </div>
        <div class="form__item">
            <label for="building-name">建物名</label>
            <input type="text" name="building-name" value="{{ $userProfile->building_name }}" />
        </div>
    </div>
    <div class="form__submit">
        <button>更新する</button>
    </div>
</div>
@endsection