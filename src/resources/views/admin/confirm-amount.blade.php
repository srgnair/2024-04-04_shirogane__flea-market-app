@extends('commonWithSearchFunction')
@section('title')
<title>管理者ページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')

<div class="confirm-amount">
    <table>
        <tbody>
            <tr>
                <th>取引id</th>
                <th>商品名</th>
                <th>販売者id</th>
                <th>購入者id</th>
                <th>価格</th>
                <th>販売ステータス</th>
                <th>送金額</th>
            </tr>
            @foreach($amounts as $amount)
            @if($amount->transaction && $amount->transaction->transaction_type === 'purchased')
            <tr>
                <td>{{ $amount->id }}</td>
                <td>{{ $amount->item_name }}</td>
                <td>{{ $amount->seller_id }}</td>
                <td>{{ $amount->buyer_id }}</td>
                <td>￥{{ $amount->price }}</td>
                <td>{{ $amount->transaction->transaction_type }}</td>
                <td>￥{{ $amount->transaction->amount }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
</div>
@endsection