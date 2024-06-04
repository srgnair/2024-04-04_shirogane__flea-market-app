@extends('commonOnlyLogo')
@section('title')
<title>住所の変更-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/shippingChange.css') }}">
@endsection
@section('content')
<div class="shipping-change">
    <form action="{{ route('shippingChange', ['item_id' => $item_id]) }}" method="POST">
        @csrf
        <div class="shipping-change__title">
            住所の変更
        </div>
        @error('post_code')
        <p>{{$errors->first('post_code')}}</p>
        @enderror
        @error('address')
        <p>{{$errors->first('address')}}</p>
        @enderror
        @error('building_name')
        <p>{{$errors->first('building_name')}}</p>
        @enderror
        <div class="shipping-change__form">
            <div class="shipping-change__form-item">
                <label for="post_code">郵便番号</label>
                <input type="text" name="post_code" value="{{ old('post_code') }}" />
            </div>
            <div class="shipping-change__form-item">
                <label for="address">住所</label>
                <input type="text" name="address" value="{{ old('address') }}" />
            </div>
            <div class="shipping-change__form-item">
                <label for="building_name">建物名</label>
                <input type="text" name="building_name" value="{{ old('building_name') }}" />
            </div>
        </div>
        <div class="shipping-change__form-submit">
            <button>更新する</button>
        </div>
    </form>
</div>
@endsection