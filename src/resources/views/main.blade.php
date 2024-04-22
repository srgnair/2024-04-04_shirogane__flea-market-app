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
        <li class="main__menu--mylist-search">おすすめ</li>
        <li>
            <a href="{{ route('mainMyDisplayItemsView') }}">
                マイリスト
            </a>
        </li>
    </ul>
</div>

<div class="main__content">
    <div class="main__content--cards">
        @foreach($items as $item)
        @foreach($item->itemImages as $itemImage)
        <div class="main__content--card">
            <a href="{{ route('detailView', ['id' => $item->id]) }}" class="card__link">
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