@extends('commonWithSearchFunction')
@section('title')
<title>マイページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')

<div class="mypage__user-info">
    <div class="mypage__user-info--img">
        @if (Auth::check() && Auth::user()->img !== null)
        <img src="{{ $user->img }}" alt="イメージ画像">
        @else
        <img src="{{ asset('img/sampleUserImage.png') }}" alt="イメージ画像">
        @endif
    </div>
    <div class="mypage__user-info--user-name">
        @if (Auth::check() && Auth::user()->user_name !== null)
        <p>{{ Auth::user()->user_name }} さん</p>
        @else
        <p>名称未設定さん</p>
        @endif
    </div>
    <div class="mypage__user-info--profile-change-btn">
        <a href="{{ route('profileChangeView') }}">
            <button>プロフィールを編集</button>
        </a>
    </div>
</div>

<div class="mypage__menu">
    <ul>
        <li>出品した商品</li>
        <li>
            <a href="{{ route('mypagePurchasedItemsView') }}">
                購入した商品
            </a>
        </li>
    </ul>
</div>

<div class="mypage__content">
    <div class="mypage__content--img">
        <div class="mypage__content--card">
            @foreach($itemImages as $itemImage)
            <img src="{{ $itemImage->image }}" alt="イメージ画像">
            @endforeach
        </div>
    </div>
</div>
@endsection