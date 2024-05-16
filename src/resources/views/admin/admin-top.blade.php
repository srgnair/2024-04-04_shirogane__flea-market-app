@extends('commonWithSearchFunction')
@section('title')
<title>管理者ページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
<div class="admin">
    <ul>
        <li>
            <div class="admin__link">
                <a href="{{ route('addNewAdminView') }}">管理者の作成</a>
            </div>
        </li>
        <li>
            <div class="admin__link">
                <a href="{{ route('itemListView') }}">商品一覧の確認</a>
            </div>
        </li>
        <li>
            <div class="admin__link">
                <a href="{{ route('confirmAmountView') }}">出品者への送金額確認</a>
            </div>
        </li>
        <li>
            <div class="admin__link">
                <a href="{{ route('sendEmailView') }}">メール送信</a>
            </div>
        </li>
    </ul>
</div>
@endsection