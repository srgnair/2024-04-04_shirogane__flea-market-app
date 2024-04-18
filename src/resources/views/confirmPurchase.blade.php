@extends('commonWithSearchFunction')
@section('title')
<title>商品名-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirmPurchase.css') }}">
@endsection
@section('content')
<div class="confirm-purchase__shipping-container">
    <div class="shipping-container__item-info">
        <div class="shipping-container__item-info--img">
            @foreach($itemImages as $itemImage)
            <img src="{{ asset('img/itemImage.png') }}" alt="イメージ画像">
            @endforeach
        </div>

        <div class="shipping-container__item-info--item-name">
            {{ $item->item_name }}
        </div>
        <div class="shipping-container__item-info--item-price">
            ￥{{ number_format($item->price, 0, '.', ',') }}
        </div>
    </div>
    <div class="shipping-container__payment-method">
        <div class="shipping-container__payment-method--wrapper">
            <div class="shipping-container__payment-method--title">
                支払い方法
            </div>
            <div class="shipping-container__payment-method--selected-payment">
                <!-- ラジオボタンで選択 -->
                <input type="radio" name="" id="">クレジットカード
                <input type="radio" name="" id="">銀行振込
                <input type="radio" name="" id="">コンビニ払い
            </div>
        </div>
        <div class="shipping-container__payment-method--change-btn">
            変更する
        </div>
    </div>
    <div class="shipping-container__shipping-address">
        <div class="shipping-container__shipping-address--wrapper">
            <div class="shipping-container__shipping-address--title">
                配送先
            </div>
            <div class="shipping-container__shipping-address--selected-payment">
                配送先住所
            </div>
        </div>
        <div class="shipping-container__shipping-address--change-btn">
            変更する
        </div>
    </div>
</div>
<div class="confirm-purchase__payment-info">
    <div class="confirm-purchase__payment-info--table">
        <table>
            <tbody>
                <tr>
                    <th>商品代金</th>
                    <td>￥{{ number_format($item->price, 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <th>支払い金額</th>
                    <td>￥{{ number_format($item->price, 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    <td>コンビニ払い</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="confirm-purchase__payment-info--btn-to-buy">
        <button>購入する</button>
    </div>
</div>
@endsection