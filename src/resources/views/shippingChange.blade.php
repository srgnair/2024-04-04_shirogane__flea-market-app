@extends('commonOnlyLogo')
@section('title')
<title>住所の変更-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/shippingChange.css') }}">
@endsection
@section('content')
<div class="shipping-change">
    <div class="shipping-change__title">
        住所の変更
    </div>
    <div class="shipping-change-form">
        <div class="form__item">
            <label for="post-code">郵便番号</label>
            <input type="text" name="post-code" value="{{ old('post-code') }}" />
        </div>
        <div class="form__item">
            <label for="address">住所</label>
            <input type="text" name="address" value="{{ old('address') }}" />
        </div>
        <div class="form__item">
            <label for="building-name">建物名</label>
            <input type="text" name="building-name" value="{{ old('building-name') }}" />
        </div>
    </div>
    <div class="form__submit">
        <button>更新する</button>
    </div>
</div>
@endsection