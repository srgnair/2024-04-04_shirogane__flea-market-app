@extends('commonWithSearchFunction')
@section('title')
<title>coachtechフリマ</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
@section('content')

<div class="main__content">
    <div class="search">
        <form action="{{ route('mainSearchRefineView') }}" method="GET">
            @csrf

            <div class="search_button">
                <label for="listedOrSoldout">販売状況</label>
                <select name="listedOrSoldout">
                    <option value="">全て</option>
                    <option value="listed" {{ session('selected_listedOrSoldout') === 'listed' ? 'selected' : '' }}>販売中</option>
                    <option value="sold_out" {{ session('selected_listedOrSoldout') === 'sold_out' ? 'selected' : '' }}>売り切れ</option>
                </select>
            </div>

            <div class="search_button">
                <label for="orderBy">表示順</label>
                <select name="orderBy">
                    <option value="newest" {{ session('selected_orderBy') === 'newest' ? 'selected' : '' }}>新しい順</option>
                    <option value="lowest_price" {{ session('selected_orderBy') === 'lowest_price' ? 'selected' : '' }}>価格の安い順</option>
                    <option value="highest_price" {{ session('selected_orderBy') === 'highest_price' ? 'selected' : '' }}>価格の高い順</option>
                    <option value="most_likes" {{ session('selected_orderBy') === 'most_likes' ? 'selected' : '' }}>いいね！順</option>
                </select>
            </div>

            <div class="search_button">
                <label for="category">カテゴリー</label>
                <select name="category">
                    <option value="">全て</option>
                    <option value="1" {{ session('selected_category') === '1' ? 'selected' : '' }}>ファッション</option>
                    <option value="2" {{ session('selected_category') === '2' ? 'selected' : '' }}>ベビー・キッズ</option>
                    <option value="3" {{ session('selected_category') === '3' ? 'selected' : '' }}>ゲーム・おもちゃ・グッズ</option>
                    <option value="4" {{ session('selected_category') === '4' ? 'selected' : '' }}>メンズ</option>
                    <option value="5" {{ session('selected_category') === '5' ? 'selected' : '' }}>レディース</option>
                </select>
            </div>

            <div class="search_button">
                <label for="condition">コンディション</label>
                <select name="condition">
                    <option value="">全て</option>
                    <option value="1" {{ session('selected_condition') === '1' ? 'selected' : '' }}>新品、未使用</option>
                    <option value="2" {{ session('selected_condition') === '2' ? 'selected' : '' }}>未使用に近い</option>
                    <option value="3" {{ session('selected_condition') === '3' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                    <option value="4" {{ session('selected_condition') === '4' ? 'selected' : '' }}>やや傷や汚れあり</option>
                    <option value="5" {{ session('selected_condition') === '5' ? 'selected' : '' }}>傷や汚れあり</option>
                </select>

            </div>

            <div class="search_button">
                <input type="number" name="minPrice" value="{{ session('search_query.minPrice') }}" placeholder="最低価格">
                ～
                <input type="number" name="maxPrice" value="{{ session('search_query.maxPrice') }}" placeholder="最高価格">
            </div>

            <button type="submit">検索</button>
        </form>

    </div>
    @if($results->isEmpty())
    <p>検索結果がありません。</p>
    @else
    <div class="main__content--cards">
        @foreach($results as $item)
        @foreach($itemImages as $image)
        @if ($image->item_id == $item->id)
        <div @if($item->transaction && $item->transaction->transaction_type === 'listed')
            class="card"
            @else
            class="card__sold"
            @endif
            >
            <a href="{{ route('detailView', ['id' => $item->id]) }}" class="card__link">
                <div class="card__image-container">


                    <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                    <img class="card__item-image" src="{{ asset($image->image) }}" alt="イメージ画像">

                </div>
            </a>
        </div>
        @endif
        @endforeach
        @endforeach
    </div>
    @endif
</div>

@endsection