@extends('commonWithSearchFunction')
@section('title')
<title>商品名-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirmPurchase.css') }}">
<script src="{{ asset('/js/payment.js') }}"></script>
@endsection
@section('content')
<div class="form__submit">
    {{ session('message') }}
</div>
<div class="form__submit">
    {{ session('error') }}
</div>
<form class="form__wrapper" action="{{ route('purchase', ['item_id' => $item->id] ) }}" method="POST">
    @csrf
    <div class="confirm-purchase__container">

        <div class="container__left">

            <div class="container__img--wrapper">

                <div class="comment__img">
                    @foreach($itemImages as $itemImage)
                    <div class="card__image-container">
                        <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                        <img class="card__item-image" src="{{ asset($itemImage->image) }}" alt="イメージ画像">
                    </div>
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
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="maker" value="food" onclick="formSwitch()" checked>
                            <label class="form-check-label">クレジットカード</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="maker" value="place" onclick="formSwitch()">
                            <label class="form-check-label">銀行振込</label>
                        </div>


                        <ul>
                            <div id="foodList">
                                <li>お寿司</li>
                                <li>アイスクリーム</li>
                                <li>チーズケーキ</li>
                                <li>お団子</li>
                            </div>
                            <div id="placeList">
                                <li>自由が丘</li>
                                <li>下北沢</li>
                                <li>吉祥寺</li>
                                <li>高円寺</li>
                            </div>
                        </ul>
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
                        <!-- if分岐　$user->deliveryAddress()が存在したら -->
                        @if( $user->deliveryAddresses()->exists() )
                        {{ substr($user->deliveryAddresses()->first()->post_code, 0, 3) . '-' . substr($user->deliveryAddresses()->first()->post_code, 3) }}
                        {{ $user->deliveryAddresses()->first()->address }}
                        {{ $user->deliveryAddresses()->first()->building_name }}
                        <!-- 登録されていなければ、[配送先を登録してください]と表示する -->
                        @else
                        配送先を登録してください
                        @endif
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
                @if($transaction == 'listed')
                <button>購入する</button>
                @else
                現在購入できません
                @endif
            </div>
        </div>

    </div>
</form>
@endsection