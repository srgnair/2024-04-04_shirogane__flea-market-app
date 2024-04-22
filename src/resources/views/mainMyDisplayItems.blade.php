@extends('commonWithSearchFunction')
@section('title')
<title>coachtechフリマ</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
@section('content')
<div class="main__menu">
    <ul>
        <li>
            <a href="{{ route('mainView') }}">
                おすすめ
            </a>
        </li>
        <li class="main__menu--mylist-search">マイリスト</li>
    </ul>
</div>

<div class="main__content">
    <div class="main__content--cards">
        @foreach($likeItems as $likeItem)
        @foreach($itemImages as $itemImage)
        <!-- <a href="{{ route('detailView', ['id' => $likeItem->id]) }}">
            <img src="{{ $itemImage->image }}" alt="イメージ画像">
        </a> -->
        <div class="main__content--card">
            <a href="{{ route('detailView', ['id' => $likeItem->id]) }}" class="card__link">
                <div class="card__image-container">
                    <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                    <img class="card__item-image" src="{{ $itemImage->image }}" alt="イメージ画像">
                </div>
            </a>
        </div>
        @endforeach
        @endforeach
    </div>
</div>
@endsection