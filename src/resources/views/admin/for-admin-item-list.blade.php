@extends('commonWithSearchFunction')
@section('title')
<title>管理者ページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
<div class="admin">

    <div class="admin__search-form">
        <form action="{{ route('itemListView') }}" method="GET">
            @csrf

            <div class="search_button">
                <label for="sellerId">販売者id</label>
                <input type="number" name="sellerId">
            </div>

            <button type="submit">検索</button>
            <a href="{{ route('itemListView', ['reset' => true]) }}">検索条件をリセット</a>
        </form>
    </div>

    <div class="admin_data-table">
        <table>
            <tbody>
                @if($results->isEmpty())
                <p>検索結果がありません。</p>
                @else
                <tr>
                    <th>商品id</th>
                    <th>商品名</th>
                    <th>販売者id</th>
                    <th>購入者id</th>
                    <th>ブランド名</th>
                    <th>価格</th>
                    <th>コンディション</th>
                    <th>販売ステータス</th>
                </tr>
                @foreach($results as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->seller_id }}</td>
                    <td>{{ $item->buyer_id }}</td>
                    <td>{{ $item->brand_name }}</td>
                    <td>￥{{ $item->price }}</td>
                    <td>{{ $item->condition }}</td>
                    <td>{{ $item->transaction->transaction_type }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
    </div>
</div>
@endsection