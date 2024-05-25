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
<!-- 
@foreach ($sellersItems as $sellersItem)
@if ($sellersItem->transaction_type == 'waiting_review_buyer' && Auth::id() === $sellersItem->buyer_id && !$review)
<div class="review">
    以下のボタンから出品者の評価を完了させてください。
    <div class="link">
        <a href="{{ route('reviewView', ['id' => $sellersItem->id]) }}">評価をする</a>
    </div>
</div>
@elseif($review && $sellersItem->transaction_type == 'waiting_review_seller' && Auth::id() == $sellersItem->seller_id)
<div class="review">
    以下のボタンから販売者の評価を完了させてください。
    <div class="admin__link">
        <a href="{{ route('reviewView',['id'=>$sellersItem->id]) }}">評価をする</a>
    </div>
</div>
@endif
@endforeach -->

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
    <!-- <div class="mypage__content--cards">
        @foreach($sellersItems as $sellersItem)
        @foreach($itemImages as $itemImage)
        <div class="mypage__content--card">
            <a href="{{ route('detailView', ['id' => $sellersItem->id]) }}" class="card__link">
                <div class="card__image-container">
                    <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                    <img class="card__item-image" src="{{ $itemImage->image }}" alt="イメージ画像">
                </div>
            </a>
        </div>
        @endforeach
        @endforeach
    </div> -->
    <div class="mypage__content--cards">
        @foreach($sellersItems as $index => $sellersItem)
        @if($sellersItem->item->seller_id)
        <!-- <div class="mypage__content--card"> -->
        <div @if($sellersItem->item->transaction->transaction_type === 'listed') class="card" @else class="card__sold" @endif>
            <a href="{{ route('detailView', ['id' => $sellersItem->item->id]) }}" class="card__link">
                <div class="card__image-container">
                    <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                    <!-- 対応する$itemImagesのインデックスを使って画像を表示 -->
                    <img class="card__item-image" src="{{ asset($itemImages[$index]->image) }}" alt="イメージ画像">
                </div>
            </a>
        </div>
        @endif
        @endforeach
    </div>
</div>

</div>
@endsection