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
        <img src="{{ asset($user->img ) }}" alt="イメージ画像">
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
        <li>
            <a href="{{ route('mypageView') }}">
                出品した商品
            </a>
        </li>
        <li class="mypage__menu--search">購入した商品</li>
    </ul>
</div>

<div class="mypage__content">

    <!-- 確認が必要な商品一覧リスト -->

    <div class="mypage__content--cards">
        <div class="mypage__content--cards">
            @foreach($purchasedItems as $index => $purchasedItem)
            <!-- <div class="mypage__content--card"> -->
            <div @if($purchasedItem->item->transaction->transaction_type === 'listed') class="card" @else class="card__sold" @endif>
                <a href="{{ route('detailView', ['id' => $purchasedItem->item->id]) }}" class="card__link">
                    <div class="card__image-container">
                        <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                        <!-- 対応する$itemImagesのインデックスを使って画像を表示 -->
                        <img class="card__item-image" src="{{ asset($itemImages[$index]->image) }}" alt="イメージ画像">
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- 

        @foreach($purchasedItems as $purchasedItem)
        @foreach($itemImages as $itemImage)
        <div class="mypage__content--card">
            <a href="{{ route('detailView', ['id' => $purchasedItem->id]) }}" class="card__link">
                <div class="card__image-container">
                    <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                    <img class="card__item-image" src="{{ asset($itemImage->image) }}" alt="イメージ画像">
                </div>
            </a>
        </div>
        @endforeach
        @endforeach -->
    </div>
</div>
@endsection