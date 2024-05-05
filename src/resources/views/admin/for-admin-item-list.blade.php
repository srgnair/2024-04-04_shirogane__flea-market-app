@extends('commonWithSearchFunction')
@section('title')
<title>管理者ページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
<div class="admin">
    <table>
        <tbody>
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
            @foreach($items as $item)
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
        </tbody>
</div>
@endsection