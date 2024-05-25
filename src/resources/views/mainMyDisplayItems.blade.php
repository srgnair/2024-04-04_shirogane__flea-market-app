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
        <div class="card">
            <a href="{{ route('detailView', ['id' => $likeItem->item->id]) }}" class="card__link">
                <div class="card__image-container">
                    <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                    @if(isset($itemImages[$likeItem->item->id]))
                    <img class="card__item-image" src="{{ $itemImages[$likeItem->item->id]->image }}" alt="イメージ画像">
                    @else
                    <p>画像が見つかりません</p>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection