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
    <div class="main__content--card">
        @foreach($items as $item)
        @foreach($item->itemImages as $itemImage)
        <a href="{{ route('detailView', ['id' => $item->id]) }}">
            <img src="{{ $itemImage->image }}" alt="イメージ画像">
        </a>
        @endforeach
        @endforeach

    </div>
</div>
@endsection