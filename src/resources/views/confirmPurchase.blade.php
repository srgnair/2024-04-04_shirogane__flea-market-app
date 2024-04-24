@extends('commonWithSearchFunction')
@section('title')
<title>商品名-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirmPurchase.css') }}">
@endsection
@section('content')
<div class="confirm-purchase__container">
    <div class="container__left">

        <div class="container__img--wrapper">
            <div class="container__item-img">
                @foreach($itemImages as $itemImage)
                <img src="{{ asset('img/itemImage.png') }}" alt="イメージ画像">
                @endforeach
            </div>

            <div class="container__item-name--wrapper">
                <div class="container__item-name">
                    {{ $item->item_name }}
                </div>

                <div class="container__item-price">
                    ￥{{ number_format($item->price, 0, '.', ',') }}
                </div>
            </div>
        </div>

        <div class="container__payment-method--wrapper">

            <div class="container__payment-method">
                <div class="payment-method__title">
                    支払い方法
                </div>
                <div class="payment-method__selected-button">
                    <!-- ラジオボタンで選択 -->
                    <input type="radio" name="" id="">クレジットカード
                    <input type="radio" name="" id="">銀行振込
                </div>
            </div>

            <div class="payment-method__change-button">
                変更する
            </div>

        </div>

        <div class="container__shipping-address--wrapper">

            <div class="container__shipping-address">

                <div class="container__shipping-address--title">
                    配送先
                </div>

                <div class="container__shipping-address--address">
                    配送先住所
                </div>

            </div>

            <div class="container__shipping-address--change-button">

                <a href="{{ route('shippingChangeView', ['item_id' => $item->id]) }}">
                    変更する
                </a>

            </div>
        </div>

    </div>

    <div class="container__right">

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
        <div class="confirm-purchase__payment-info--button">
            <button>購入する</button>
        </div>
    </div>

</div>
@endsection